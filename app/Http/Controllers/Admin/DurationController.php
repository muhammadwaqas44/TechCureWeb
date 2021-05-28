<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Duration;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class DurationController extends Controller
{
    public function index()
    {
        $durations = Duration::orderBy('id', 'DESC')->get();

        return view('admin.duration.index', ['durations' => $durations, 'title' => 'Durations']);
    }


    public function create()
    {
        return view('admin.duration.create', ['title' => 'Create Duration']);
    }


    public function store(Request $request)
    {
        $rules = [
            'duration' => 'required|unique:durations|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $durationData = [
            'duration' => $request->duration,
            'status' => $request->status,
        ];

        $duration = Duration::create($durationData);


        return redirect()->route('durationList')->with('success-message', 'Record Added Successfully.');
    }


    public function edit($id)
    {
        $duration = Duration::find($id);
        return view('admin.duration.edit', ['title' => 'Edit Duration', 'duration' => $duration]);
    }


    public function update(Request $request)
    {
        $duration = Duration::find($request->duration_id);

        $rules = [
            'duration' => 'required|max:191|unique:durations,duration,'.$duration->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $durationData = [
            'duration' => $request->duration,
            'status' => $request->status,
        ];

        $duration->update($durationData);


        return redirect()->route('durationList')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request){

        $duration = Duration::find($request->id);

        if ($duration == null) {
            return response()->json(['status' => 0 ]);
        }

        $duration->delete();

        return response()->json(['status' => 1 ]);
    }
}

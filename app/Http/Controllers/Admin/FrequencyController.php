<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frequency;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class FrequencyController extends Controller
{
    public function index()
    {
        $frequencies = Frequency::orderBy('id', 'DESC')->get();

        return view('admin.frequency.index', ['frequencies' => $frequencies, 'title' => 'Frequencies']);
    }


    public function create()
    {
        return view('admin.frequency.create', ['title' => 'Create Frequency']);
    }


    public function store(Request $request)
    {
        $rules = [
            'frequency' => 'required|unique:frequencies|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $frequencyData = [
            'frequency' => $request->frequency,
            'status' => $request->status,
        ];

        $frequency = Frequency::create($frequencyData);


        return redirect()->route('frequencyList')->with('success-message', 'Record Added Successfully.');
    }


    public function edit($id)
    {
        $frequency = Frequency::find($id);
        return view('admin.frequency.edit', ['title' => 'Edit Frequency', 'frequency' => $frequency]);
    }


    public function update(Request $request)
    {
        $frequency = Frequency::find($request->frequency_id);

        $rules = [
            'frequency' => 'required|max:191|unique:frequencies,frequency,'.$frequency->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $frequencyData = [
            'frequency' => $request->frequency,
            'status' => $request->status,
        ];

        $frequency->update($frequencyData);


        return redirect()->route('frequencyList')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request){

        $frequency = Frequency::find($request->id);

        if ($frequency == null) {
            return response()->json(['status' => 0 ]);
        }

        $frequency->delete();

        return response()->json(['status' => 1 ]);
    }
}

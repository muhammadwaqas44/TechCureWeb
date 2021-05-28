<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dose;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class DoseController extends Controller
{
    public function index()
    {
        $doses = Dose::orderBy('id', 'DESC')->get();

        return view('admin.dose.index', ['doses' => $doses, 'title' => 'Doses']);
    }


    public function create()
    {
        return view('admin.dose.create', ['title' => 'Create Doses']);
    }


    public function store(Request $request)
    {
        $rules = [
            'dose' => 'required|unique:doses|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $doseData = [
            'dose' => $request->dose,
            'status' => $request->status,
        ];

        $dose = Dose::create($doseData);


        return redirect()->route('doseList')->with('success-message', 'Record Added Successfully.');
    }


    public function edit($id)
    {
        $dose = Dose::find($id);
        return view('admin.dose.edit', ['title' => 'Edit Dose', 'dose' => $dose]);
    }


    public function update(Request $request)
    {
        $dose = Dose::find($request->dose_id);

        $rules = [
            'dose' => 'required|max:191|unique:doses,dose,'.$dose->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $doseData = [
            'dose' => $request->dose,
            'status' => $request->status,
        ];

        $dose->update($doseData);


        return redirect()->route('doseList')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request){

        $dose = Dose::find($request->id);

        if ($dose == null) {
            return response()->json(['status' => 0 ]);
        }

        $dose->delete();

        return response()->json(['status' => 1 ]);
    }
}

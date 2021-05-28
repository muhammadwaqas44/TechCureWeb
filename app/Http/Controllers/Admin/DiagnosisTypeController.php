<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiagnosisType;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class DiagnosisTypeController extends Controller
{
    public function index()
    {
        $diagnosisTypes = DiagnosisType::orderBy('id', 'DESC')->get();

        return view('admin.diagnosisType.index', ['diagnosisTypes' => $diagnosisTypes, 'title' => 'Diagnosis Types']);
    }


    public function create()
    {
        return view('admin.diagnosisType.create', ['title' => 'Create Diagnosis Type']);
    }


    public function store(Request $request)
    {
        $rules = [
            'type' => 'required|unique:diagnosis_types|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $diagnosisTypeData = [
            'type' => $request->type,
            'status' => $request->status,
        ];

        $diagnosisType = DiagnosisType::create($diagnosisTypeData);


        return redirect()->route('diagnosisTypeList')->with('success-message', 'Record Added Successfully.');
    }


    public function edit($id)
    {
        $diagnosisType = DiagnosisType::find($id);
        return view('admin.diagnosisType.edit', ['title' => 'Edit Diagnosis Type', 'diagnosisType' => $diagnosisType]);
    }


    public function update(Request $request)
    {
        $diagnosisType = DiagnosisType::find($request->diagnosis_type_id);

        $rules = [
            'type' => 'required|max:191|unique:diagnosis_types,type,'.$diagnosisType->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $diagnosisTypeData = [
            'type' => $request->type,
            'status' => $request->status,
        ];

        $diagnosisType->update($diagnosisTypeData);


        return redirect()->route('diagnosisTypeList')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request){

        $diagnosisType = DiagnosisType::find($request->id);

        if ($diagnosisType == null) {
            return response()->json(['status' => 0 ]);
        }

        $diagnosisType->delete();

        return response()->json(['status' => 1 ]);
    }
}

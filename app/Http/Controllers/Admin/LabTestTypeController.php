<?php

namespace App\Http\Controllers\Admin;

use App\Models\LabTestType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class LabTestTypeController extends Controller
{
    // show list of all LabTestType
    public function index()
    {
        $labTestTypes = LabTestType::orderBy('id', 'DESC')
            ->get();

        return view('admin.labTestType.index', ['labTestTypes' => $labTestTypes, 'title' => 'Lab Test Type']);
    }


    // create new LabTestType
    public function create()
    {
        return view('admin.labTestType.create', ['title' => 'Create Lab Test']);
    }


    // store new LabTestType
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:lab_tests|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $labTestData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $labTest = LabTestType::create($labTestData);


        return redirect()->route('labTestTypeList')->with('success-message', 'Record Added Successfully.');
    }


    //edit LabTestType
    public function edit($id)
    {
        $labTestType = LabTestType::find($id);
        return view('admin.labTestType.edit', ['title' => 'Edit Lab Test', 'labTestType' => $labTestType]);
    }


    // update LabTestType
    public function update(Request $request)
    {
        $labTestType = LabTestType::find($request->labTest_id);

        $rules = [
            'title' => 'required|max:191|unique:lab_test_types,title,' . $labTestType->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $labTestData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];
        $labTestType->update($labTestData);

        return redirect()->route('labTestTypeList')->with('success-message', 'Record Updated Successfully.');
    }


    // delete LabTestType
    public function delete(Request $request)
    {

        $labTestType = LabTestType::find($request->id);

        if ($labTestType == null) {
            return response()->json(['status' => 0]);
        }

        $labTestType->delete();

        return response()->json(['status' => 1]);
    }

}

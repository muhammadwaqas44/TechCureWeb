<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lab;
use App\Models\LabTest;
use App\Models\LabTestType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use Illuminate\Support\Str;

class LabTestController extends Controller
{
    // show list of all LabTests
    public function index()
    {
        $labTests = LabTest::orderBy('id', 'DESC')
            ->get();

        return view('admin.labTest.index', ['labTests' => $labTests, 'title' => 'Lab Tests']);
    }


    // create new LabTest
    public function create()
    {
        $labs = Lab::orderBy('title')->where(['status' => 1])->get();
        $labTestTypes = LabTestType::orderBy('title')->where(['status' => 1])->get();
        return view('admin.labTest.create', ['title' => 'Create Lab Test','labs'=> $labs,'labTestTypes'=> $labTestTypes]);
    }


    // store new LabTest
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:lab_tests|max:191',
            // 'lab_id' => 'required|integer',
            'type_id' => 'required',
            'fasting' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $labTestData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'lab_id' => $request->lab_id,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'fasting' => $request->fasting,
            'instructions' => $request->instructions,
            'status' => $request->status,
        ];

        $labTest = LabTest::create($labTestData);


        return redirect()->route('labTestList')->with('success-message', 'Record Added Successfully.');
    }


    //edit LabTest
    public function edit($id)
    {
        $labTest = LabTest::find($id);
        $labs = Lab::orderBy('title')->where(['status' => 1])->get();
        $labTestTypes = LabTestType::orderBy('title')->where(['status' => 1])->get();
        return view('admin.labTest.edit', ['title' => 'Edit Lab Test', 'labTest' => $labTest,'labs'=>$labs,'labTestTypes'=>$labTestTypes]);
    }


    // update LabTest
    public function update(Request $request)
    {
        $labTest = LabTest::find($request->labTest_id);

        $rules = [
            'title' => 'required|max:191|unique:lab_tests,title,'.$labTest->id,
            // 'lab_id' => 'required|integer',
            'type_id' => 'required',
            'fasting' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $labTestData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'lab_id' => $request->lab_id,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'fasting' => $request->fasting,
            'instructions' => $request->instructions,
            'status' => $request->status,
        ];
        $labTest->update($labTestData);

        return redirect()->route('labTestList')->with('success-message', 'Record Updated Successfully.');
    }


    // delete LabTest
    public function delete(Request $request)
    {

        $labTest = LabTest::find($request->id);

        if ($labTest == null) {
            return response()->json(['status' => 0]);
        }

        $labTest->delete();

        return response()->json(['status' => 1]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhysicalExamination;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class PhysicalExaminationController extends Controller
{
    // Show list of all Physical Examination
    public function index()
    {
        $physicalExaminations = PhysicalExamination::orderBy('id', 'DESC')->get();

        return view('admin.physicalExamination.index', ['physicalExaminations' => $physicalExaminations, 'title' => 'Physical Examinations']);
    }

    // Create new Physical Examination
    public function create()
    {
        return view('admin.physicalExamination.create', ['title' => 'Create Physical Examination']);
    }

    // Store new Physical Examination
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:physical_exams|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $physicalExaminationData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $physicalExamination= PhysicalExamination::create($physicalExaminationData);

        return redirect()->route('physicalExaminationList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Physical Examination
    public function edit($id)
    {
        $physicalExamination = PhysicalExamination::find($id);

        return view('admin.physicalExamination.edit', ['title' => 'Edit Physical Examination', 'physicalExamination' => $physicalExamination]);
    }

    // Update Physical Examination
    public function update(Request $request)
    {
        $physicalExamination = PhysicalExamination::find($request->physical_examination_id);
        
        $rules = [
            'title' => 'required|max:191|unique:physical_exams,title,'.$physicalExamination->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $physicalExaminationData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $physicalExamination->update($physicalExaminationData);

        return redirect()->route('physicalExaminationList')->with('success-message', 'Record Updated Successfully.');
    }

    // Delete Physical Examination
    public function delete(Request $request)
    {
        $physicalExamination = PhysicalExamination::find($request->id);

        if ($physicalExamination == null) {
            return response()->json(['status' => 0]);
        }

        $physicalExamination->delete();

        return response()->json(['status' => 1]);
    }
}

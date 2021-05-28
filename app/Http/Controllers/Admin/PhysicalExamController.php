<?php

namespace App\Http\Controllers\Admin;

use App\Models\PhysicalExam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class PhysicalExamController extends Controller
{
    // Show list of all Physical Examination
    public function index()
    {
        $physicalExams = PhysicalExam::orderBy('id', 'DESC')->get();

        return view('admin.physicalExam.index', ['physicalExams' => $physicalExams, 'title' => 'Physical Exams']);
    }

    // Create new Physical Examination
    public function create()
    {
        return view('admin.physicalExam.create', ['title' => 'Create Physical Exam']);
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

        $physicalExamData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $physicalExam= PhysicalExam::create($physicalExamData);

        return redirect()->route('physicalExamList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Physical Examination
    public function edit($id)
    {
        $physicalExam = PhysicalExam::find($id);

        return view('admin.physicalExam.edit', ['title' => 'Edit Physical Exam', 'physicalExam' => $physicalExam]);
    }

    // Update Physical Examination
    public function update(Request $request)
    {
        $physicalExam = PhysicalExam::find($request->physical_examination_id);

        $rules = [
            'title' => 'required|max:191|unique:physical_exams,title,'.$physicalExam->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $physicalExamData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $physicalExam->update($physicalExamData);

        return redirect()->route('physicalExamList')->with('success-message', 'Record Updated Successfully.');
    }

    // Delete Physical Examination
    public function delete(Request $request)
    {
        $physicalExam = PhysicalExam::find($request->id);

        if ($physicalExam == null) {
            return response()->json(['status' => 0]);
        }

        $physicalExam->delete();

        return response()->json(['status' => 1]);
    }
}

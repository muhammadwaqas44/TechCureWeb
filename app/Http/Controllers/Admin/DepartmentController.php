<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'DESC')
            ->get();

        return view('admin.department.index', ['departments' => $departments, 'title' => 'Departments']);
    }


    public function create()
    {
        return view('admin.department.create', ['title' => 'Create Department']);
    }


    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:departments|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $departmentData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $department= Department::create($departmentData);


        return redirect()->route('departmentList')->with('success-message', 'Record Added Successfully.');
    }


    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.department.edit', ['title' => 'Edit Department', 'department' => $department]);
    }


    public function update(Request $request)
    {
        $department = Department::find($request->department_id);

        $rules = [
            'title' => 'required|max:191|unique:departments,title,'.$department->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $departmentData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $department->update($departmentData);


        return redirect()->route('departmentList')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request){

        $department = Department::find($request->id);

        if ($department == null) {
            return response()->json(['status' => 0 ]);
        }

        $department->delete();

        return response()->json(['status' => 1 ]);
    }
}

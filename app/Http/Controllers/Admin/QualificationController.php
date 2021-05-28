<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class QualificationController extends Controller
{
     // show list of all Qualifications
     public function index()
     {
         $qualifications = Qualification::orderBy('id', 'DESC')
         ->get();
 
         return view('admin.qualification.index', ['qualifications' => $qualifications, 'title' => 'Qualifications']);
     }
 
 
     // create new Qualification
     public function create()
     {
         return view('admin.qualification.create', ['title' => 'Create Qualification']);
     }
 
 
     // store new qualification
     public function store(Request $request)
     { 
         $rules = [
             'title' => 'required|unique:qualifications|max:191',
             'status' => 'required',
         ];
 
         $validator = Validator::make($request->all(), $rules);
 
         if ($validator->fails()) {
             return Redirect::back()->withErrors($validator)->withInput(Input::all());
         }
 
         $qualificationData = [
             'title' => $request->title,
             'slug' => Str::slug($request->input('title'), '-'),
             'status' => $request->status,
         ];
 
         $qualification= Qualification::create($qualificationData);
 
         return redirect()->route('qualificationList')->with('success-message', 'Record Added Successfully.');
     }
 
 
     //edit qualification
     public function edit($id)
     {
         $qualification = Qualification::find($id);
         return view('admin.qualification.edit', ['title' => 'Edit Qualification', 'qualification' => $qualification]);
     }
 
 
     // update qualification
     public function update(Request $request)
     {
         $qualification = Qualification::find($request->qualification_id);
         
         $rules = [
             'title' => 'required|max:191|unique:qualifications,title,'.$qualification->id,
             'status' => 'required',
         ];
 
         $validator = Validator::make($request->all(), $rules);
 
         if ($validator->fails()) {
             return Redirect::back()->withErrors($validator)->withInput(Input::all());
         }
 
         $qualificationData = [
             'title' => $request->title,
             'slug' => Str::slug($request->input('title'), '-'),
             'status' => $request->status,
         ];
 
         $qualification->update($qualificationData);
 
         return redirect()->route('qualificationList')->with('success-message', 'Record Updated Successfully.');
     }
 
 
     // delete qualification
     public function delete(Request $request)
     {
 
         $qualification = Qualification::find($request->id);
 
         if ($qualification == null) {
             return response()->json(['status' => 0 ]);
         }
 
         $qualification->delete();
 
         return response()->json(['status' => 1 ]);
     }
}

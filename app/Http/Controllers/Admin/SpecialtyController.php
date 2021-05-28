<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class SpecialtyController extends Controller
{

    // show list of all Specialties
    public function index()
    {
        $specialties = Specialty::orderBy('id', 'DESC')
        ->get();

        return view('admin.specialty.index', ['specialties' => $specialties, 'title' => 'Specialties']);
    }


    // create new specialty
    public function create()
    {
        return view('admin.specialty.create', ['title' => 'Create Specialty']);
    }


    // store new specialty
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:specialties|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $specialtyData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $specialty = Specialty::create($specialtyData);

        return redirect()->route('specialtyList')->with('success-message', 'Record Added Successfully.');
    }


    //edit specialty
    public function edit($id)
    {
        $specialty = Specialty::find($id);
        return view('admin.specialty.edit', ['title' => 'Edit Specialty', 'specialty' => $specialty]);
    }


    // update new specialty
    public function update(Request $request)
    {
        $specialty = Specialty::find($request->specialty_id);
        
        $rules = [
            'title' => 'required|max:191|unique:specialties,title,'.$specialty->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $specialtyData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $specialty->update($specialtyData);

        return redirect()->route('specialtyList')->with('success-message', 'Record Updated Successfully.');
    }


    // delete  specialty
    public function delete(Request $request){

        $specialty = Specialty::find($request->id);

        if ($specialty == null) {
            return response()->json(['status' => 0 ]);
        }

        $specialty->delete();

        return response()->json(['status' => 1 ]);
    }

}

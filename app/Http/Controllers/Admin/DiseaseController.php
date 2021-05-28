<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Disease;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class DiseaseController extends Controller
{
    // Show list of all Disease
    public function index()
    {
        $diseases = Disease::orderBy('id', 'DESC')->get();

        return view('admin.disease.index', ['diseases' => $diseases, 'title' => 'Diseases']);
    }


    // Create new Disease
    public function create()
    {
        return view('admin.disease.create', ['title' => 'Create Disease']);
    }


    // Store new Disease
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:diseases|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $diseaseData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $disease= Disease::create($diseaseData);

        return redirect()->route('diseaseList')->with('success-message', 'Record Added Successfully.');
    }


    // Edit Disease
    public function edit($id)
    {
        $disease = Disease::find($id);
        return view('admin.disease.edit', ['title' => 'Edit Disease', 'disease' => $disease]);
    }


    // Update Disease
    public function update(Request $request)
    {
        $disease = Disease::find($request->disease_id);
        
        $rules = [
            'title' => 'required|max:191|unique:diseases,title,'.$disease->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $diseaseData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $disease->update($diseaseData);

        return redirect()->route('diseaseList')->with('success-message', 'Record Updated Successfully.');
    }


    // Delete Disease
    public function delete(Request $request)
    {
        $disease = Disease::find($request->id);

        if ($disease == null) {
            return response()->json(['status' => 0 ]);
        }

        $disease->delete();

        return response()->json(['status' => 1 ]);
    }
}

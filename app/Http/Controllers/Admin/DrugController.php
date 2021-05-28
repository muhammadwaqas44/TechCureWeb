<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Drug;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class DrugController extends Controller
{
    // Show list of all Drug
    public function index()
    {
        $drugs = Drug::orderBy('id', 'DESC')->get();

        return view('admin.drug.index', ['drugs' => $drugs, 'title' => 'Drugs']);
    }

    // Create new Drug
    public function create()
    {
        return view('admin.drug.create', ['title' => 'Create Drug']);
    }

    // Store new Drug
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:drugs|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $drugData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $drug= Drug::create($drugData);

        return redirect()->route('drugList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Drug
    public function edit($id)
    {
        $drug = Drug::find($id);
        return view('admin.drug.edit', ['title' => 'Edit Drug', 'drug' => $drug]);
    }

    // Update Drug
    public function update(Request $request)
    {
        $drug = Drug::find($request->drug_id);
        
        $rules = [
            'title' => 'required|max:191|unique:drugs,title,'.$drug->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $drugData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $drug->update($drugData);

        return redirect()->route('drugList')->with('success-message', 'Record Updated Successfully.');
    }

    // Delete Drug
    public function delete(Request $request)
    {
        $drug = Drug::find($request->id);

        if ($drug == null) {
            return response()->json(['status' => 0]);
        }

        $drug->delete();

        return response()->json(['status' => 1]);
    }
}

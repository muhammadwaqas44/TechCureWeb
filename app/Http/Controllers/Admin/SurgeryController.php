<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Surgery;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class SurgeryController extends Controller
{
    // Show list of all Surgery
    public function index()
    {
        $surgeries = Surgery::orderBy('id', 'DESC')->get();

        return view('admin.surgery.index', ['surgeries' => $surgeries, 'title' => 'Surgeries']);
    }


    // Create new Surgery
    public function create()
    {
        return view('admin.surgery.create', ['title' => 'Create Surgery']);
    }


    // Store new Surgery
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:surgeries|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $surgeryData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $surgery= Surgery::create($surgeryData);

        return redirect()->route('surgeryList')->with('success-message', 'Record Added Successfully.');
    }


    // Edit Surgery
    public function edit($id)
    {
        $surgery = Surgery::find($id);
        return view('admin.surgery.edit', ['title' => 'Edit Surgery', 'surgery' => $surgery]);
    }


    // Update Surgery
    public function update(Request $request)
    {
        $surgery = Surgery::find($request->surgery_id);
        
        $rules = [
            'title' => 'required|max:191|unique:surgeries,title,'.$surgery->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $surgeryData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $surgery->update($surgeryData);

        return redirect()->route('surgeryList')->with('success-message', 'Record Updated Successfully.');
    }


    // Delete Surgery
    public function delete(Request $request)
    {
        $surgery = Surgery::find($request->id);

        if ($surgery == null) {
            return response()->json(['status' => 0 ]);
        }

        $surgery->delete();

        return response()->json(['status' => 1 ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class LabController extends Controller
{
    // show list of all Labs
    public function index()
    {
        $labs = Lab::orderBy('id', 'DESC')
            ->get();

        return view('admin.lab.index', ['labs' => $labs, 'title' => 'Labs']);
    }


    // create new Lab
    public function create()
    {
        return view('admin.lab.create', ['title' => 'Create Lab']);
    }


    // store new Lab
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:labs|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $labData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->description,
            'status' => $request->status,
        ];

        $lab = Lab::create($labData);


        return redirect()->route('labList')->with('success-message', 'Record Added Successfully.');
    }


    //edit Lab
    public function edit($id)
    {
        $lab = Lab::find($id);
        return view('admin.lab.edit', ['title' => 'Edit Lab', 'lab' => $lab]);
    }


    // update Lab
    public function update(Request $request)
    {
        $lab = Lab::find($request->lab_id);

        $rules = [
            'title' => 'required|max:191|unique:labs,title,' . $lab->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $labData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->description,
            'status' => $request->status,
        ];

        $lab->update($labData);


        return redirect()->route('labList')->with('success-message', 'Record Updated Successfully.');
    }


    // delete Lab
    public function delete(Request $request)
    {

        $lab = Lab::find($request->id);

        if ($lab == null) {
            return response()->json(['status' => 0]);
        }

        $lab->delete();

        return response()->json(['status' => 1]);
    }
}

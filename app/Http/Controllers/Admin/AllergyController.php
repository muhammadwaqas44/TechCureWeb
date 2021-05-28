<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Allergy;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class AllergyController extends Controller
{
    // show list of all allergies
    public function index()
    {
        $allergies = Allergy::orderBy('id', 'DESC')
        ->get();

        return view('admin.allergy.index', ['allergies' => $allergies, 'title' => 'Allergies']);
    }


    // create new allergy
    public function create()
    {
        return view('admin.allergy.create', ['title' => 'Create Allergy']);
    }


    // store new allergy
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:allergies|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $allergyData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $allergy= Allergy::create($allergyData);

        return redirect()->route('allergyList')->with('success-message', 'Record Added Successfully.');
    }


    //edit allergies
    public function edit($id)
    {
        $allergy = Allergy::find($id);
        return view('admin.allergy.edit', ['title' => 'Edit Allergy', 'allergy' => $allergy]);
    }


    // update allergy
    public function update(Request $request)
    {
        $allergy = Allergy::find($request->allergy_id);
        
        $rules = [
            'title' => 'required|max:191|unique:allergies,title,'.$allergy->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $allergyData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'status' => $request->status,
        ];

        $allergy->update($allergyData);

        return redirect()->route('allergyList')->with('success-message', 'Record Updated Successfully.');
    }


    // delete allergy
    public function delete(Request $request){

        $allergy = Allergy::find($request->id);

        if ($allergy == null) {
            return response()->json(['status' => 0 ]);
        }

        $allergy->delete();

        return response()->json(['status' => 1 ]);
    }
}

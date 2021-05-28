<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Relation;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;

class RelationController extends Controller
{
    // Show list of all Relation
    public function index()
    {
        $relations = Relation::orderBy('id', 'DESC')->get();

        return view('admin.relation.index', ['relations' => $relations, 'title' => 'Relations']);
    }

    // Create new Relation
    public function create()
    {
        return view('admin.relation.create', ['title' => 'Create Relation']);
    }

    // Store new Relation
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:relations|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $relationData = [
            'title' => $request->title,
            'status' => $request->status,
        ];

        $relation= Relation::create($relationData);

        return redirect()->route('relationList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Relation
    public function edit($id)
    {
        $relation = Relation::find($id);
        return view('admin.relation.edit', ['title' => 'Edit Relation', 'relation' => $relation]);
    }

    // Update Relation
    public function update(Request $request)
    {
        $relation = Relation::find($request->relation_id);
        
        $rules = [
            'title' => 'required|max:191|unique:relations,title,'.$relation->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $relationData = [
            'title' => $request->title,
            'status' => $request->status,
        ];

        $relation->update($relationData);

        return redirect()->route('relationList')->with('success-message', 'Record Updated Successfully.');
    }

    // Delete Relation
    public function delete(Request $request)
    {
        $relation = Relation::find($request->id);

        if ($relation == null) {
            return response()->json(['status' => 0]);
        }

        $relation->delete();

        return response()->json(['status' => 1]);
    }
}

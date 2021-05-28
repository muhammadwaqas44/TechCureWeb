<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reaction;
use App\Models\Drug;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class ReactionController extends Controller
{
    // Show list of all Reaction
    public function index()
    {
        $reactions = Reaction::orderBy('id', 'DESC')->get();

        return view('admin.reaction.index', ['reactions' => $reactions, 'title' => 'Reactions']);
    }

    // Create new Reaction
    public function create()
    {
        $drugs = Drug::select('id', 'title')->where('status', 1)->get();
        return view('admin.reaction.create', ['title' => 'Create Reaction', 'drugs' => $drugs]);
    }

    // Store new Reaction
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:reactions|max:191',
            'drug_id' => 'required|numeric',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $drug = Drug::select('title')->where('id', $request->drug_id)->first();

        $reactionData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'drug_id' => $request->drug_id,
            'drug_title' => $drug->title,
            'status' => $request->status,
        ];

        $reaction= Reaction::create($reactionData);

        return redirect()->route('reactionList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Reaction
    public function edit($id)
    {
        $reaction = Reaction::find($id);
        $drugs = Drug::select('id', 'title')->where('status', 1)->get();

        return view('admin.reaction.edit', ['title' => 'Edit Reaction', 'reaction' => $reaction, 'drugs' => $drugs]);
    }

    // Update Reaction
    public function update(Request $request)
    {
        $reaction = Reaction::find($request->reaction_id);
        
        $rules = [
            'title' => 'required|max:191|unique:reactions,title,'.$reaction->id,
            'drug_id' => 'required|numeric',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $drug = Drug::select('title')->where('id', $request->drug_id)->first();

        $reactionData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'drug_id' => $request->drug_id,
            'drug_title' => $drug->title,
            'status' => $request->status,
        ];

        $reaction->update($reactionData);

        return redirect()->route('reactionList')->with('success-message', 'Record Updated Successfully.');
    }

    // Delete Reaction
    public function delete(Request $request)
    {
        $reaction = Reaction::find($request->id);

        if ($reaction == null) {
            return response()->json(['status' => 0]);
        }

        $reaction->delete();

        return response()->json(['status' => 1]);
    }
}

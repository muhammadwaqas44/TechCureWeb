<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'DESC')->get();

        return view('admin.unit.index', ['units' => $units, 'title' => 'Units']);
    }


    public function create()
    {
        return view('admin.unit.create', ['title' => 'Create Units']);
    }


    public function store(Request $request)
    {
        $rules = [
            'unit' => 'required|unique:units|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $unitData = [
            'unit' => $request->unit,
            'status' => $request->status,
        ];

        $unit = Unit::create($unitData);


        return redirect()->route('unitList')->with('success-message', 'Record Added Successfully.');
    }


    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('admin.unit.edit', ['title' => 'Edit Unit', 'unit' => $unit]);
    }


    public function update(Request $request)
    {
        $unit = Unit::find($request->unit_id);

        $rules = [
            'unit' => 'required|max:191|unique:units,unit,'.$unit->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $unitData = [
            'unit' => $request->unit,
            'status' => $request->status,
        ];

        $unit->update($unitData);


        return redirect()->route('unitList')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request){

        $unit = Unit::find($request->id);

        if ($unit == null) {
            return response()->json(['status' => 0 ]);
        }

        $unit->delete();

        return response()->json(['status' => 1 ]);
    }
}

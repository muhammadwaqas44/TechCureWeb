<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PatientType;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PatientTypeController extends Controller
{
    // Show list of all Patient Type
    public function index()
    {
        $patientTypes = PatientType::orderBy('id', 'DESC')->get();

        return view('admin.patientType.index', ['patientTypes' => $patientTypes, 'title' => 'Patient Types']);
    }

    // Create new Patient Type
    public function create()
    {
        return view('admin.patientType.create', ['title' => 'Create Patient Type']);
    }

    // Store new Patient Type
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:patient_types|max:191',
            'discount_percentage' => 'required|integer|between:0,100',
            'status' => 'required',
        ];

        if($request->start_date != null && $request->end_date != null)
        {
            $rules['start_date'] = 'date';
            $rules['end_date'] = 'date|after_or_equal:start_date';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $patientTypeData = [
            'title' => $request->title,
            'discount_percentage' => $request->discount_percentage,
            'status' => $request->status,
        ];

        if($request->start_date != null && $request->end_date != null)
        {
            $patientTypeData['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
            $patientTypeData['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
        }

        $patientType= PatientType::create($patientTypeData);

        return redirect()->route('patientTypeList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Patient Type
    public function edit($id)
    {
        $patientType = PatientType::find($id);
        return view('admin.patientType.edit', ['title' => 'Edit Patient Type', 'patientType' => $patientType]);
    }

    // Update Patient Type
    public function update(Request $request)
    {
        $patientType = PatientType::find($request->patient_type_id);
        
        $rules = [
            'title' => 'required|max:191|unique:patient_types,title,'.$patientType->id,
            'discount_percentage' => 'required|integer|between:0,100',
            'status' => 'required',
        ];

        if($request->start_date != null && $request->end_date != null)
        {
            $rules['start_date'] = 'date';
            $rules['end_date'] = 'date|after_or_equal:start_date';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $patientTypeData = [
            'title' => $request->title,
            'discount_percentage' => $request->discount_percentage,
            'status' => $request->status,
        ];

        if($request->start_date != null && $request->end_date != null)
        {
            $patientTypeData['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
            $patientTypeData['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
        }
        else
        {
            $patientTypeData['start_date'] = null;
            $patientTypeData['end_date'] = null;
        }

        $patientType->update($patientTypeData);

        return redirect()->route('patientTypeList')->with('success-message', 'Record Updated Successfully.');
    }

    // Delete Patient Type
    public function delete(Request $request)
    {
        $patientType = PatientType::find($request->id);

        if ($patientType == null) {
            return response()->json(['status' => 0]);
        }

        $patientType->delete();

        return response()->json(['status' => 1]);
    }
}

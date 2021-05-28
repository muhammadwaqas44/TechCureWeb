<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Medication;
use App\Models\Dose;
use App\Models\Unit;
use App\Models\Frequency;
use App\Models\Duration;
use App\Models\DiagnosisType;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class MedicationController extends Controller
{
    
    // show list of all medications
    public function index()
    {
        $medications = Medication::orderBy('id', 'DESC')
        ->get();

        return view('admin.medication.index', ['medications' => $medications, 'title' => 'Medicines']);
    }


    // create new medication
    public function create()
    {
        $doses = Dose::select('id', 'dose')->where('status', 1)->get();
        $units = Unit::select('id', 'unit')->where('status', 1)->get();
        $frequencies = Frequency::select('id', 'frequency')->where('status', 1)->get();
        $durations = Duration::select('id', 'duration')->where('status', 1)->get();
        $diagnosisTypes = DiagnosisType::select('id', 'type')->where('status', 1)->get();

        return view('admin.medication.create', ['title' => 'Create Medicine', 'doses' => $doses, 'units' => $units, 'frequencies' => $frequencies, 'durations' => $durations, 'diagnosisTypes' => $diagnosisTypes]);
    }


    // store new medication
    public function store(Request $request)
    { 
        // dd($request->all());
        $rules = [
            'title' => 'required|unique:medications|max:191',
            'dose_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'frequency_id' => 'required|numeric',
            'duration_id' => 'required|numeric',
            'diagnosis_type_id' => 'required|numeric',
            'status' => 'required',
        ];

        if($request->generic_name != null)
        {
            $rules['generic_name'] = 'required|max:191';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $dose = Dose::select('dose')->where('id', $request->dose_id)->first();
        $unit = Unit::select('unit')->where('id', $request->unit_id)->first();
        $frequency = Frequency::select('frequency')->where('id', $request->frequency_id)->first();
        $duration = Duration::select('duration')->where('id', $request->duration_id)->first();
        $diagnosisType = DiagnosisType::select('type')->where('id', $request->diagnosis_type_id)->first();

        $medicationData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'dose_id' => $request->dose_id,
            'dose' => $dose->dose,
            'unit_id' => $request->unit_id,
            'unit' => $unit->unit,
            'frequency_id' => $request->frequency_id,
            'frequency' => $frequency->frequency,
            'duration_id' => $request->duration_id,
            'duration' => $duration->duration,
            'diagnosis_type_id' => $request->diagnosis_type_id,
            'diagnosis_type' => $diagnosisType->type,
            'status' => $request->status,
        ];

        if($request->generic_name != null)
        {
            $medicationData['generic_name'] = $request->generic_name;
        }

        $medication= Medication::create($medicationData);

        return redirect()->route('medicationList')->with('success-message', 'Record Added Successfully.');
    }


    //edit medication
    public function edit($id)
    {
        $medication = Medication::find($id);
        $doses = Dose::select('id', 'dose')->where('status', 1)->get();
        $units = Unit::select('id', 'unit')->where('status', 1)->get();
        $frequencies = Frequency::select('id', 'frequency')->where('status', 1)->get();
        $durations = Duration::select('id', 'duration')->where('status', 1)->get();
        $diagnosisTypes = DiagnosisType::select('id', 'type')->where('status', 1)->get();

        return view('admin.medication.edit', ['title' => 'Edit Medicine', 'medication' => $medication, 'doses' => $doses, 'units' => $units, 'frequencies' => $frequencies, 'durations' => $durations, 'diagnosisTypes' => $diagnosisTypes]);
    }


    // update medication
    public function update(Request $request)
    {
        $medication = Medication::find($request->medication_id);
        
        $rules = [
            'title' => 'required|max:191|unique:medications,title,'.$medication->id,
            'dose_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'frequency_id' => 'required|numeric',
            'duration_id' => 'required|numeric',
            'diagnosis_type_id' => 'required|numeric',
            'status' => 'required',
        ];

        if($request->generic_name != null)
        {
            $rules['generic_name'] = 'required|max:191';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $dose = Dose::select('dose')->where('id', $request->dose_id)->first();
        $unit = Unit::select('unit')->where('id', $request->unit_id)->first();
        $frequency = Frequency::select('frequency')->where('id', $request->frequency_id)->first();
        $duration = Duration::select('duration')->where('id', $request->duration_id)->first();
        $diagnosisType = DiagnosisType::select('type')->where('id', $request->diagnosis_type_id)->first();

        $medicationData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'dose_id' => $request->dose_id,
            'dose' => $dose->dose,
            'unit_id' => $request->unit_id,
            'unit' => $unit->unit,
            'frequency_id' => $request->frequency_id,
            'frequency' => $frequency->frequency,
            'duration_id' => $request->duration_id,
            'duration' => $duration->duration,
            'diagnosis_type_id' => $request->diagnosis_type_id,
            'diagnosis_type' => $diagnosisType->type,
            'status' => $request->status,
        ];

        if($request->generic_name != null)
        {
            $medicationData['generic_name'] = $request->generic_name;
        }
        else
        {
            $medicationData['generic_name'] = null;
        }

        $medication->update($medicationData);

        return redirect()->route('medicationList')->with('success-message', 'Record Updated Successfully.');
    }


    // delete medication
    public function delete(Request $request){

        $medication = Medication::find($request->id);

        if ($medication == null) {
            return response()->json(['status' => 0 ]);
        }

        $medication->delete();

        return response()->json(['status' => 1 ]);
    }
}

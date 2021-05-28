<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PatientPrescription;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Medication;
use App\Models\Allergy;

use Storage;
use Mail;
use Auth;
use URL;
use Illuminate\Http\File;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PrescriptionController extends Controller
{
    // show list of all patient prescriptions
    public function index($id)
    {
        $patient = Patient::find($id);

        $prescriptions = PatientPrescription::where('patient_id', $patient->id)
        ->get();

        return view('admin.prescription.index', ['prescriptions' => $prescriptions, 'patient' => $patient, 'title' => 'Patient Prescriptions']);
    }

    // create new patient prescription
    public function create($id)
    {

        $patient = Patient::find($id);

        $practitioners = Practitioner::where('status', 1)
        ->get();

        $medications = Medication::where('status', 1)
        ->get();

        $allergies = Allergy::where('status', 1)
        ->get();

        return view('admin.prescription.create', ['allergies' => $allergies, 'medications' => $medications, 'practitioners' => $practitioners, 'patient' => $patient, 'title' => 'Create Prescription']);
    }

    // store new patient Prescription
    public function store(Request $request)
    {
        // return $request->all();
        $rules = [
            "medications"    => "required|array|min:1",
            "allergies"    => "required|array|min:1",
            'clinical_examinations' => 'required',
            'practitioner_id' => 'required',
            'clinic_id' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $prescriptionData = [
            'illness_history' => $request->illness_history,
            'vital_assessments' => $request->vital_assessments,
            'clinical_examinations' => $request->clinical_examinations,
            'presenting_complaints' => $request->presenting_complaints,
            'diagnosis' => $request->diagnosis,
            'investigations' => $request->investigations,
            'family_history' => $request->family_history,
            'referral' => $request->referral,
            'patient_id' => $request->patient_id,
            'practitioner_id' => $request->practitioner_id,
            'clinic_id' => $request->clinic_id,

        ];

        if(!empty($request->follow_up)) {
            $prescriptionData['follow_up'] = Carbon::parse($request->follow_up)->format('Y-m-d');
        }

        $prescription = PatientPrescription::create($prescriptionData);

        $prescription->medications()->sync($request->medications);

        $prescription->allergies()->sync($request->allergies);

        return redirect()->route('prescriptionList', $prescription->patient_id)->with('success-message', 'Record Added Successfully.');
    }

    //edit patient Prescription
    public function edit($id)
    {
        $prescription = PatientPrescription::find($id);

        $practitioners = Practitioner::where('status', 1)
        ->get();

        $medications = Medication::where('status', 1)
        ->get();

        $allergies = Allergy::where('status', 1)
        ->get();

        $practitioner = Practitioner::find($prescription->practitioner_id);

        $clinics = $practitioner->getClinics;

        return view('admin.prescription.edit', ['title' => 'Edit Patient Prescription','practitioners' => $practitioners, 'prescription' => $prescription, 'medications' => $medications, 'clinics' => $clinics, 'allergies' => $allergies]);
    }


    // update patient Prescription
    public function update(Request $request)
    {
        // return $request->all();
        $prescription = PatientPrescription::where('id', $request->prescription_id)
        ->first();

        $rules = [
            "medications"    => "required|array|min:1",
            "allergies"    => "required|array|min:1",
            'clinical_examinations' => 'required',
            'practitioner_id' => 'required',
            'clinic_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $prescriptionData = [
            'illness_history' => $request->illness_history,
            'vital_assessments' => $request->vital_assessments,
            'clinical_examinations' => $request->clinical_examinations,
            'presenting_complaints' => $request->presenting_complaints,
            'diagnosis' => $request->diagnosis,
            'investigations' => $request->investigations,
            'family_history' => $request->family_history,
            'referral' => $request->referral,
            'practitioner_id' => $request->practitioner_id,
            'clinic_id' => $request->clinic_id,

        ];

        if(!empty($request->follow_up)) {
            $prescriptionData['follow_up'] = Carbon::parse($request->follow_up)->format('Y-m-d');
        }

        $prescription->update($prescriptionData);

        $prescription->medications()->sync($request->medications);

        $prescription->allergies()->sync($request->allergies);


        return redirect()->route('prescriptionList', $prescription->patient_id)->with('success-message', 'Record Updated Successfully.');
    }

    // Get list of clinics by practitioner id for dropdowns
    public function getClinics(Request $request)
    {
        $practitioner = Practitioner::find($request->practitioner_id);

        $clinics = $practitioner->getClinics;
        
        return ['clinics' => $clinics];
    }
}

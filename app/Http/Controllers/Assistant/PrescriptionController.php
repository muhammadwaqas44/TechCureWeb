<?php

namespace App\Http\Controllers\Assistant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PatientPrescription;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Medication;
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
use App\Models\Allergy;


class PrescriptionController extends Controller
{

    // show list of all patient prescriptions
    public function index($id)
    {
        $patient = Patient::find($id);

        $prescriptions = PatientPrescription::where('patient_id', $patient->id)
        ->where('practitioner_id', Auth::guard('practitioner')->user()->id)
        ->get();

        return view('practitioner.prescription.index', ['prescriptions' => $prescriptions, 'patient' => $patient, 'title' => 'Patient Prescriptions']);
    }

    // create new patient prescription
    public function create($id)
    {

        $patient = Patient::find($id);

        $medications = Medication::where('status', 1)
        ->get();

        $practitioner = Practitioner::find(Auth::guard('practitioner')->user()->id);

        $clinics = $practitioner->getClinics;

        $allergies = Allergy::where('status', 1)
        ->get();

        return view('practitioner.prescription.create', ['allergies' => $allergies, 'medications' => $medications, 'clinics' => $clinics, 'patient' => $patient, 'title' => 'Create Prescription']);
    }

    // store new patient Prescription
    public function store(Request $request)
    {
        // return $request->all();
        $rules = [
            "medications"    => "required|array|min:1",
            "allergies"    => "required|array|min:1",
            'clinical_examinations' => 'required',
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
            'practitioner_id' => Auth::guard('practitioner')->user()->id,
            'clinic_id' => $request->clinic_id,

        ];

        if(!empty($request->follow_up)) {
            $prescriptionData['follow_up'] = Carbon::parse($request->follow_up)->format('Y-m-d');
        }

        $prescription = PatientPrescription::create($prescriptionData);

        $prescription->medications()->sync($request->medications);

        $prescription->allergies()->sync($request->allergies);


        return redirect()->route('practitionerPrescriptionList', $prescription->patient_id)->with('success-message', 'Record Added Successfully.');
    }

    //edit patient Prescription
    public function edit($id)
    {
        $prescription = PatientPrescription::find($id);

        $medications = Medication::where('status', 1)
        ->get();

        $practitioner = Practitioner::find(Auth::guard('practitioner')->user()->id);

        $allergies = Allergy::where('status', 1)
        ->get();

        $clinics = $practitioner->getClinics;

        return view('practitioner.prescription.edit', ['title' => 'Edit Patient Prescription', 'prescription' => $prescription, 'medications' => $medications, 'clinics' => $clinics, 'allergies' => $allergies]);
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
            'clinic_id' => $request->clinic_id,
        ];

        if(!empty($request->follow_up)) {
            $prescriptionData['follow_up'] = Carbon::parse($request->follow_up)->format('Y-m-d');
        }

        $prescription->update($prescriptionData);

        $prescription->medications()->sync($request->medications);

        $prescription->allergies()->sync($request->allergies);


        return redirect()->route('practitionerPrescriptionList', $prescription->patient_id)->with('success-message', 'Record Updated Successfully.');
    }
}

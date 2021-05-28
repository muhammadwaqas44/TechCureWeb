<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\PatientPrescription;
use App\Models\Medication;
use App\Models\Appointment;
use App\Models\Allergy;
use App\Models\Specialty;
use App\Models\PatientReport;
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
use App\Models\Notification;
use App\Models\Drug;
use App\Models\PatientAllergy;
use App\Models\PatientDrug;
use App\Models\PatientVisit;
use App\Models\PatientVital;
use App\Models\PatientReferralPractitioner;
use App\Models\PatientSugarChart;
use App\Models\PatientVisitPrescription;
use App\Models\PatientType;
use App\Models\PhysicalExamination;
use App\Models\PastMedicalHistory;
use App\Models\PastSurgicalHistory;
use App\Models\FamilyMedicalHistory;
use App\Models\Adr;
use App\Models\RXMedicine;
use App\Models\SmokingHistory;
use App\Models\PatientLabTest;
use App\Models\ReviewSystem;
use App\Models\History;

class PatientController extends Controller
{
    
    // Dashboard
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $id = Auth::guard('patient')->user()->id;

        $patient =  Patient::find($id);

        $practitionerCount = Practitioner::where('status', 1)
        ->count();

        $todayAppointmentCount = Appointment::where('patient_id', $patient->id)
        ->where('date', $today)
        ->whereNotIn('status', [2,4])
        ->count();

        $allAppointmentCount = Appointment::where('patient_id', Auth::guard('patient')->user()->id)
        ->count();

        return view('patient.dashboard.dashboard', compact('practitionerCount','allAppointmentCount', 'todayAppointmentCount'));
    }

    // Profile Edit View
    public function editProfile(){
        return view('patient.profile.edit');
    }

    // Profile Update
    public function updateProfile(Request $request){

        $rules['patient_name'] = 'required';
        $rules['old_password'] = 'required';

        if($request->new_password!=null){
            $rules['new_password'] = 'min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $patient = Patient::find(Auth::guard('patient')->user()->id);

        if (Hash::check($request->old_password, $patient->password)) { 
            $patient->name=$request->patient_name;

            if($request->new_password!=null){
                $patient->password = Hash::make($request->new_password);
            }

            $patient->update();
            Auth::guard('patient')->logout();
            return redirect()->route('patientLoginForm')->with('success-message','Successfully Updated, Login again!');
        } 
        else {
            return redirect()->back()->with('error-message','Old Password is not matched, try again!');
        }
    }

    // Practitioner List
    public function practitionerList()
    {

        $practitioners = Practitioner::where('status', 1)
        ->orderBy('id', 'DESC')
        ->get();

        $specialties = Specialty::where('status', 1)
        ->get();

        return view('patient.practitioner.index', ['specialties' => $specialties, 'practitioners' => $practitioners, 'title' => 'Practitioners']);
    }

    public function practitionerListSearch(Request $request){

        $rules = [
            'specialty_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $specialtySelected = Specialty::find($request->specialty_id);

        $practitioners = $specialtySelected->getPractitioners;

        $specialties = Specialty::where('status', 1)
        ->get();

        return view('patient.practitioner.index', ['specialtySelected' => $specialtySelected, 'specialties' => $specialties, 'practitioners' => $practitioners, 'title' => 'Practitioners']);
    }

    // Practitioner Profile
    public function practitionerProfile($id){

        $practitioner = Practitioner::find($id);

        return view('patient.practitioner.profile', ['practitioner' => $practitioner, 'title' => 'Profile']);
    }

    // Data Edit View
    public function editData(){
        $id = Auth::guard('patient')->user()->id;

        $patient =  Patient::find($id);
        $allergies = Allergy::where('status', 1)->get();
        $drugs = Drug::where('status', 1)->get();

        return view('patient.data.index', ['title' => 'Edit Patient', 'patient' => $patient, 'allergies' => $allergies, 'drugs' => $drugs]);
    }

    // Data Update
    public function updateData(Request $request)
    {

        $patient = Patient::where('id', $request->patient_id)
        ->first();

        $rules = [
            'phone' => 'required|min:12|unique:patients,phone,'.$patient->id,
            'dob' => 'required',
            'gender' => 'required',
            'age' => 'required|gt:0',
        ];

        if($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if($request->has('currently_on_drug') && $request->get('currently_on_drug') == 1) {
            $rules['drugs.*'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $patientWeightKgs = null;
        $patientWeightLbs = null;
        $patientHeightFt = null;
        $patientHeightIn = null;
        $patientHeightCms = null;
        if($request->weight_kgs != null)
        {
            $patientWeightKgs = number_format($request->weight_kgs, 2);
        }
        else
        {
            $patientWeightKgs == null;
        }

        if($request->weight_lbs != null)
        {
            $patientWeightLbs = number_format($request->weight_lbs, 2);
        }
        else
        {
            $patientWeightLbs == null;
        }

        if($request->height_ft != null)
        {
            $patientHeightFt = number_format($request->height_ft, 2);
        }
        else
        {
            $patientHeightFt == null;
        }

        if($request->height_in != null)
        {
            $patientHeightIn = number_format($request->height_in, 2);
        }
        else
        {
            $patientHeightIn == null;
        }

        if($request->height_cms != null)
        {
            $patientHeightCms = number_format($request->height_cms, 2);
        }
        else
        {
            $patientHeightCms == null;
        }

        $patientData = [
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'dob' => Carbon::parse($request->dob)->format('Y-m-d'),
            'age' => $request->age,
            'weight_kgs' => $patientWeightKgs,
            'weight_lbs' => $patientWeightLbs,
            'height_ft' => $patientHeightFt,
            'height_in' => $patientHeightIn,
            'height_cms' => $patientHeightCms,
            'marital_status' => $request->marital_status,
            'hospitalization' => $request->hospitalization,
            'currently_on_drug' => $request->currently_on_drug,
        ];

        $patient->update($patientData);

        if($request->hasFile('image')) {
            $patientFolder = 'patientImage';

            if (!Storage::exists($patientFolder)) {
                Storage::makeDirectory($patientFolder);
            }

            $imageUrl = Storage::putFile($patientFolder, new File($request->file('image')));
            $patient->update(['image'=> $imageUrl]);
        }

        if($request->has('allergies') && count($request->allergies) > 0 && $request->allergies != null)
        {
            $delAllergies = PatientAllergy::where('patient_id', $patient->id)->delete();

            foreach($request->allergies as $allergy)
            {
                $allergyTitle = Allergy::select('title')->where('id', $allergy)->first();
                $allergyData = [
                    'patient_id' => $patient->id,
                    'allergy_id' => $allergy,
                    'allergy_title' => $allergyTitle->title,
                ];
                PatientAllergy::create($allergyData);
            }
        }
        else
        {
            $delAllergies = PatientAllergy::where('patient_id', $patient->id)->delete();
        }

        if($patient->currently_on_drug == 1)
        {
            $delDrugs = PatientDrug::where('patient_id', $patient->id)->delete();

            if($request->has('drugs') && count($request->drugs) > 0 && $request->drugs != null)
            {
                foreach($request->drugs as $drug)
                {
                    $drugTitle = Drug::select('title')->where('id', $drug)->first();
                    $drugData = [
                        'patient_id' => $patient->id,
                        'drug_id' => $drug,
                        'drug_title' => $drugTitle->title,
                    ];
                    PatientDrug::create($drugData);
                }
            }
            else
            {
                $delDrugs = PatientDrug::where('patient_id', $patient->id)->delete();
            }
        }
        else
        {
            $delDrugs = PatientDrug::where('patient_id', $patient->id)->delete();
        }

        if($request->patient_reports){
            for ($i = 0; $i < count($request->patient_reports); $i++) {

                if($request->patient_reports[$i]['image_url']){

                    $report = new PatientReport();
                    $report->patient_id = $patient->id;
                    $report->title = $request->patient_reports[$i]['title'];
                    $report->type = $request->patient_reports[$i]['type'];

                    $reportFolder = 'reportImages';

                    if (!Storage::exists($reportFolder)) {
                        Storage::makeDirectory($reportFolder);
                    }
                    
                    $imageUrl = Storage::putFile($reportFolder, new File($request->patient_reports[$i]['image_url']));

                    $report->image_url = $imageUrl;

                    $report->save();
                }
                
            }
        }

        return redirect()->route('patientEditData')->with('success-message', 'Record Updated Successfully.');
    }

    // delete patient report
    public function deleteReport(Request $request){

        $report = PatientReport::find($request->id);

        if ($report == null) {
            return response()->json(['status' => 0 ]);
        }

        if(Storage::exists($report->image_url)){
            Storage::delete($report->image_url);
        }

        $report->delete();

        return response()->json(['status' => 1 ]);
    }

    // Show List of Patient Previous Visits
    public function patientPreviousVisits()
    {
        $patientVisits = PatientVisit::select('id', 'status', 'created_at')->where('patient_id', Auth::guard('patient')->user()->id)->orderBy('id', 'DESC')->get();

        return view('patient.prescription.index', ['patientVisits' => $patientVisits, 'title' => 'Patients Visits']);
    }

    // Show List of Patient Previous Visit Detail
    public function patientPreviousVisitDetail($id)
    {
        $patientVitals = PatientVital::where('patient_visit_id', $id)->first();

        $patientReferTo = PatientReferralPractitioner::select('referral_practitioner_name')->where('patient_visit_id', $id)->first();

        $patientVisit = PatientVisit::where('id', $id)->first();

        $practitioner = Practitioner::where('id', $patientVisit->practitioner_id)->first();

        $patientReports = PatientReport::select('id', 'title', 'type', 'image_url')->where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();

        $patient = Patient::where('id', $patientVisit->patient_id)->first();

        $patientSugarChart = PatientSugarChart::where('patient_visit_id', $id)->first();

        $patientAppointment = Appointment::where('id', $patientVisit->appointment_id)->first();

        $patientPrescriptions = PatientVisitPrescription::select('prescription')->where('patient_visit_id', $id)->get();

        $patientPhysicalExaminations = PhysicalExamination::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();

        $patientPastMedicalHistories = PastMedicalHistory::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $patientPastSurgicalHistories = PastSurgicalHistory::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $patientFamilyMedicalHistories = FamilyMedicalHistory::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $adrs = Adr::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $rxMedicines = RXMedicine::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();

        $smokingHistory = SmokingHistory::where('patient_id', $patientVisit->patient_id)->first();

        $patientLabTests = PatientLabTest::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $ros = ReviewSystem::where(['patient_id' =>$patientVisit->patient_id])->first();
        $history = History::where(['patient_id' => $patientVisit->patient_id])->first();
        return view('patient.prescription.detail', ['practitioner' => $practitioner, 'ros' => $ros,
            'history' => $history,'patient' => $patient, 'patientVitals' => $patientVitals, 'patientReferTo' => $patientReferTo, 'patientVisit' => $patientVisit, 'patientReports' => $patientReports, 'patientSugarChart' => $patientSugarChart, 'patientAppointment' => $patientAppointment, 'patientPrescriptions' => $patientPrescriptions, 'patientPhysicalExaminations' => $patientPhysicalExaminations, 'patientPastMedicalHistories' => $patientPastMedicalHistories, 'patientPastSurgicalHistories' => $patientPastSurgicalHistories, 'patientFamilyMedicalHistories' => $patientFamilyMedicalHistories, 'adrs' => $adrs, 'rxMedicines' => $rxMedicines, 'smokingHistory' => $smokingHistory, 'patientLabTests' => $patientLabTests, 'title' => 'Patient Visit Detail']);
    }

    // show list of all patient prescriptions
    // public function prescriptionList()
    // {
    //     $id = Auth::guard('patient')->user()->id;

    //     $patient =  Patient::find($id);

    //     $prescriptions = PatientPrescription::where('patient_id', $patient->id)
    //     ->get();

    //     return view('patient.prescription.index', ['prescriptions' => $prescriptions, 'patient' => $patient, 'title' => 'Patient Prescriptions']);
    // }

    // detail patient Prescription
    // public function prescriptionDetail($id)
    // {
    //     $prescription = PatientPrescription::find($id);

    //     $medications = Medication::where('status', 1)
    //     ->get();

    //     $allergies = Allergy::where('status', 1)
    //     ->get();

    //     return view('patient.prescription.detail', ['title' => 'Detail Patient Prescription', 'prescription' => $prescription, 'medications' => $medications , 'allergies' => $allergies]);
    // }

    public function notificationDetail($id){
        $notification = Notification::find($id);

        if(empty($notification)){
            return redirect()->back()->with('error-message','Not Found !');
        }

        $notification->is_read = 1;

        $notification->update();

        return view('patient.notification.detail', compact('notification'));
    }

}

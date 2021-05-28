<?php

namespace App\Http\Controllers\Admin;

use App\Models\History;
use App\Models\ReviewSystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientReport;
use App\Models\Allergy;
use App\Models\Drug;
use App\Models\PatientAllergy;
use App\Models\PatientDrug;
use App\Models\PatientVisit;
use App\Models\PatientVital;
use App\Models\PatientReferralPractitioner;
use App\Models\PatientSugarChart;
use App\Models\Appointment;
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
use App\Rules\EmailMustHaveTLD;


class PatientController extends Controller
{
    // show list of all patients
    public function index()
    {
        $patients = Patient::orderBy('id', 'DESC')
        ->get();

        return view('admin.patient.index', ['patients' => $patients, 'title' => 'Patients']);
    }

    // create new patient
    public function create()
    {
        $allergies = Allergy::where('status', 1)->get();
        $drugs = Drug::where('status', 1)->get();
        // $patientTypes = PatientType::where('status', 1)->get();
        return view('admin.patient.create', ['title' => 'Create Patient', 'allergies' => $allergies, 'drugs' => $drugs]);
    }

    // store new patient
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            // 'patient_type_id' => 'required',
            'name' => 'required|max:191',
            'email' => ['required', 'email', 'unique:patients' , new EmailMustHaveTLD],
            'phone' => 'required|min:12|unique:patients',
            'status' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'age' => 'required|gt:0',
            'marital_status' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
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

        $randomNumber = rand(10000000, 99999999);

        if($request->currently_on_drug == null)
        {
            $currentlyOnDrug = 0;
        }
        else
        {
            $currentlyOnDrug = $request->currently_on_drug;
        }

        // $patientType = PatientType::select('title')->where('id', $request->patient_type_id)->first();
        $patientData = [
            // 'patient_type_id' => $request->patient_type_id,
            // 'patient_type_title' => $patientType->title,
            'mr_number' => $randomNumber,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'dob' => Carbon::parse($request->dob)->format('Y-m-d'),
            'age' => $request->age,
            'weight_kgs' => $request->weight_kgs,
            'height' => $request->height,
            'marital_status' => $request->marital_status,
            'hospitalization' => $request->hospitalization,
            'currently_on_drug' => $currentlyOnDrug,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ];


        if($request->weight_kgs != null)
        {
            $patientData['weight_kgs'] = number_format($request->weight_kgs, 2);
        }

        if($request->weight_lbs != null)
        {
            $patientData['weight_lbs'] = number_format($request->weight_lbs, 2);
        }

        if($request->height_ft != null)
        {
            $patientData['height_ft'] = number_format($request->height_ft, 2);
        }

        if($request->height_in != null)
        {
            $patientData['height_in'] = number_format($request->height_in, 2);
        }

        if($request->height_cms != null)
        {
            $patientData['height_cms'] = number_format($request->height_cms, 2);
        }

        $patient = Patient::create($patientData);

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

        if($patient->currently_on_drug == 1)
        {
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

        // $data = array(
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password,
        // );

        // try{
        //     Mail::send('admin.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
        //         $message->to($data['email'])->subject("Account Creation");
        //     });
        // } catch (\Exception $e) {

        // }

        return redirect()->route('patientList')->with('success-message', 'Record Added Successfully.');
    }

    //edit patient
    public function edit($id)
    {
        $patient = Patient::find($id);
        $allergies = Allergy::where('status', 1)->get();
        $drugs = Drug::where('status', 1)->get();
        // $patientTypes = PatientType::where('status', 1)->get();

        return view('admin.patient.edit', ['title' => 'Edit Patient', 'patient' => $patient, 'allergies' => $allergies, 'drugs' => $drugs]);
    }

    // update patient
    public function update(Request $request)
    {
        $patient = Patient::where('id', $request->patient_id)
        ->first();

        $rules = [
            // 'patient_type_id' => 'required',
            'name' => 'required|max:191',
            'email' => 'email',
            'phone' => 'required|min:12|unique:patients,phone,'.$patient->id,
            'status' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'age' => 'required|gt:0',
            'marital_status' => 'required',
        ];


        if($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if($request->has('currently_on_drug') && $request->get('currently_on_drug') == 1) {
            $rules['drugs.*'] = 'required';
        }

        if (!empty($request->password)) {
            $rules['password'] = 'required_with:confirm_password|same:confirm_password|min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        // $patientType = PatientType::select('title')->where('id', $request->patient_type_id)->first();

        if (!empty($request->password) && !empty($request->confirm_password)) {
            $patientData['password'] = Hash::make($request->password);
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
            // 'patient_type_id' => $request->patient_type_id,
            // 'patient_type_title' => $patientType->title,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
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

        return redirect()->route('patientList')->with('success-message', 'Record Updated Successfully.');
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

    // Patient Detail
    public function detail($id)
    {
        $patient = Patient::where('id', $id)->first();

        if ($patient == null) {
            return redirect()->route('patientList')->with('error', 'No Record Found.');
        }

        return view('admin.patient.detail', ['title' => 'Patient Detail', 'patient' => $patient]);
    }

    // Show List of Patient Previous Visits
    public function patientPreviousVisits($id)
    {
        $patientVisits = PatientVisit::select('id', 'status', 'created_at')->where('patient_id', $id)->orderBy('id', 'DESC')->get();

        return view('admin.patient.patientVisits', ['patientVisits' => $patientVisits, 'title' => 'Patients Visits']);
    }

    // Show List of Patient Previous Visit Detail
    public function patientPreviousVisitDetail($id)
    {
        $patientVitals = PatientVital::where('patient_visit_id', $id)->first();

        $patientReferTo = PatientReferralPractitioner::select('referral_practitioner_name')->where('patient_visit_id', $id)->first();

        $patientVisit = PatientVisit::where('id', $id)->first();

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
        return view('admin.patient.patientPreviousVisitDetail', ['ros' => $ros,
            'history' => $history,'patient' => $patient, 'patientVitals' => $patientVitals, 'patientReferTo' => $patientReferTo, 'patientVisit' => $patientVisit, 'patientReports' => $patientReports, 'patientSugarChart' => $patientSugarChart, 'patientAppointment' => $patientAppointment, 'patientPrescriptions' => $patientPrescriptions, 'patientPhysicalExaminations' => $patientPhysicalExaminations, 'patientPastMedicalHistories' => $patientPastMedicalHistories, 'patientPastSurgicalHistories' => $patientPastSurgicalHistories, 'patientFamilyMedicalHistories' => $patientFamilyMedicalHistories, 'adrs' => $adrs, 'rxMedicines' => $rxMedicines, 'smokingHistory' => $smokingHistory, 'patientLabTests' => $patientLabTests, 'title' => 'Patient Visit Detail']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Practitioner;
use App\Models\Appointment;
use App\Models\Specialty;
use App\Models\Qualification;
use App\Models\Patient;
use App\Models\PractitionerAssistant;
use App\Models\Assistant;
use App\Models\Clinic;
use App\Models\PractitionerClinics;
use App\Models\PractitionerClinicDay;
use Storage;
use Mail;
use Auth;
use URL;
use Illuminate\Http\File;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Rules\EmailMustHaveTLD;

class PractitionerController extends Controller
{
    // show list of all practitioners
    public function index()
    {
        $practitioners = Practitioner::orderBy('id', 'DESC')
        ->get();

        return view('admin.practitioner.index', ['practitioners' => $practitioners, 'title' => 'Practitioners']);
    }

    // create new practitioner
    public function create()
    {
        $specialties = Specialty::where('status', 1)
        ->get();

        $clinics = Clinic::where('status', 1)
        ->get();

        $qualifications = Qualification::where('status', 1)
        ->get();

        return view('admin.practitioner.create', ['specialties' => $specialties, 'clinics' => $clinics, 'qualifications' => $qualifications, 'title' => 'Create Practitioner']);
    }

    // store new practitioner
    public function store(Request $request)
    {
//        dd($request->all());
        $rules = [
            'name' => 'required|max:191',
            'email' => ['required', 'email', 'unique:practitioners' , new EmailMustHaveTLD],
            'phone' => 'required|min:12|unique:practitioners',
            'status' => 'required',
            'qualification_id' => 'required',
            'license_no' => 'required',
            'license_image' => 'required|mimes:jpeg,jpg,png,gif',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
        ];

        if($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        // if($request->has('address')) {
        //     $rules['address'] = 'required|max:250';
        // }

        // if($request->has('description')) {
        //     $rules['description'] = 'required|max:5000';
        // }

        $validator = Validator::make($request->all(), $rules);

        $old_practitioner_clinics = $request->practitioner_clinics;

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all());
        }

        $allClinics = array();

//        // check if clinic match
//        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
//            $allClinics[$i] = $request->practitioner_clinics[$i]['clinic'];
//        }
//
//        if(count($allClinics) != count(array_unique($allClinics))){
//            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same clinics.');
//        }

        // check if clinic time interval is correct
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
            $startTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['from_time'] ));
            $endTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['to_time'] ));

            if($startTime < $endTime){

            }
            else{
                return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'Opening Time and Closing Time interval error.');
            }
        }

        // check if clinics day time match
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {

            $firstFromTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['from_time'] ));
            $firstToTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['to_time'] ));

            $days = array();

            for($j = 0 ; $j < count($request->practitioner_clinics[$i]['days']) ; $j++){
                $days[$j] = $request->practitioner_clinics[$i]['days'][$j];
            }

            for ($k = $i+1 ; $k < count($request->practitioner_clinics); $k++) {

                $secondFromTime = date("H:i", strtotime( $request->practitioner_clinics[$k]['from_time'] ));
                $secondToTime = date("H:i", strtotime( $request->practitioner_clinics[$k]['to_time'] ));

                for($l = 0 ; $l < count($request->practitioner_clinics[$k]['days']) ; $l++){
                    if (in_array($request->practitioner_clinics[$k]['days'][$l], $days, true)) {
                        if(($secondFromTime <= $firstFromTime && $secondToTime > $firstFromTime)
                        || ($secondFromTime >= $firstFromTime && $secondFromTime < $firstToTime)){
                            // return "overlap";
                            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same time for same day in different Clinics.');
                        }
                        else{
                            // return "dont overlap";
                        }
                    }
                }
            }
        }

        $practitionerData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'qualification_id' => $request->qualification_id,
            'license_no' => $request->license_no,
            'agora_app_id' => $request->agora_app_id,
            'agora_app_certificate' => $request->agora_app_certificate,
            'agora_app_channel' => $request->agora_app_channel,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ];

        $practitioner = Practitioner::create($practitionerData);

        $practitioner->specialties()->sync($request->specialties);

        if($request->hasFile('image')) {
            $practitionerFolder = 'practitionerImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('image')));
            $practitioner->update(['image'=> $imageUrl]);
        }

        if($request->hasFile('license_image')) {
            $practitionerLicenseImage = 'practitionerLicenseImage';

            if (!Storage::exists($practitionerLicenseImage)) {
                Storage::makeDirectory($practitionerLicenseImage);
            }

            $imageUrl = Storage::putFile($practitionerLicenseImage, new File($request->file('license_image')));
            $practitioner->update(['license_image'=> $imageUrl]);
        }

        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {

            $practitionerClinicData = [
                'clinic_id' => $request->practitioner_clinics[$i]['clinic'],
                'practitioner_id' => $practitioner->id,
                'physical_fee' => $request->practitioner_clinics[$i]['physical_fee'],
                'online_fee' => $request->practitioner_clinics[$i]['online_fee'],
                'from_time' => date("H:i:s", strtotime( $request->practitioner_clinics[$i]['from_time'] )),
                'to_time' => date("H:i:s", strtotime( $request->practitioner_clinics[$i]['to_time'] )),
            ];

            $practitionerClinic = PractitionerClinics::create($practitionerClinicData);

            for ($j=0; $j < count($request->practitioner_clinics[$i]['days']) ; $j++) {
                $practitionerClinicDaysData = [
                    'practitioner_clinic_id' => $practitionerClinic->id,
                    'day' => $request->practitioner_clinics[$i]['days'][$j]
                ];

                $practitionerClinicDay = PractitionerClinicDay::create($practitionerClinicDaysData);
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

        return redirect()->route('practitionerList')->with('success-message', 'Record Added Successfully.');
    }

    //edit practitioner
    public function edit($id)
    {
        $practitioner = Practitioner::find($id);

        $specialties = Specialty::where('status', 1)
        ->get();

        $clinics = Clinic::where('status', 1)
        ->get();

        $qualifications = Qualification::where('status', 1)
        ->get();

        return view('admin.practitioner.edit', ['title' => 'Edit Practitioner', 'practitioner' => $practitioner, 'qualifications' => $qualifications, 'specialties' => $specialties, 'clinics' => $clinics]);
    }

    // update practitioner
    public function update(Request $request)
    {
        $practitioner = Practitioner::where('id', $request->practitioner_id)
        ->first();

        $rules = [
            'name' => 'required|max:191',
            'email' => 'email',
            'phone' => 'required|min:12|unique:practitioners,phone,'.$practitioner->id,
            'status' => 'required',
            'qualification_id' => 'required',
            'license_no' => 'required',
        ];

        if($request->hasFile('license_image')) {
            $rules['license_image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        // if($request->has('address')) {
        //     $rules['address'] = 'required|max:250';
        // }

        // if($request->has('description')) {
        //     $rules['description'] = 'required|max:5000';
        // }

        if (!empty($request->password)) {
            $rules['password'] = 'required_with:confirm_password|same:confirm_password|min:8';
        }

        $old_practitioner_clinics = $request->practitioner_clinics;

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all());
        }

        $allClinics = array();
//
////        // check if clinic match
//        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
//            $allClinics[$i] = $request->practitioner_clinics[$i]['clinic'];
//        }
//
//        if(count($allClinics) != count(array_unique($allClinics))){
//            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same clinics.');
//        }

        // check if clinic time interval is correct
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
            $startTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['from_time'] ));
            $endTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['to_time'] ));

            if($startTime < $endTime){

            }
            else{
                return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'Opening Time and Closing Time interval error.');
            }
        }

        // check if clinics day time match
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {

            $firstFromTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['from_time'] ));
            $firstToTime = date("H:i", strtotime( $request->practitioner_clinics[$i]['to_time'] ));

            $days = array();

            for($j = 0 ; $j < count($request->practitioner_clinics[$i]['days']) ; $j++){
                $days[$j] = $request->practitioner_clinics[$i]['days'][$j];
            }

            for ($k = $i+1 ; $k < count($request->practitioner_clinics); $k++) {

                $secondFromTime = date("H:i", strtotime( $request->practitioner_clinics[$k]['from_time'] ));
                $secondToTime = date("H:i", strtotime( $request->practitioner_clinics[$k]['to_time'] ));

                for($l = 0 ; $l < count($request->practitioner_clinics[$k]['days']) ; $l++){
                    if (in_array($request->practitioner_clinics[$k]['days'][$l], $days, true)) {
                        if(($secondFromTime <= $firstFromTime && $secondToTime > $firstFromTime)
                        || ($secondFromTime >= $firstFromTime && $secondFromTime < $firstToTime)){
                            // return "overlap";
                            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same time for same day in different Clinics.');
                        }
                        else{
                            // return "dont overlap";
                        }
                    }
                }
            }
        }

        $practitionerData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'license_no' => $request->license_no,
            'agora_app_id' => $request->agora_app_id,
            'agora_app_certificate' => $request->agora_app_certificate,
            'agora_app_channel' => $request->agora_app_channel,
            'status' => $request->status,
            'qualification_id' => $request->qualification_id,
        ];


        if (!empty($request->password) && !empty($request->confirm_password)) {
            $practitionerData['password'] = Hash::make($request->password);
        }

        $practitioner->update($practitionerData);

        if ($request->hasFile('image')) {
            $practitionerFolder = 'practitionerImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            if(Storage::exists($practitioner->image)){
                Storage::delete($practitioner->image);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('image')));
            $practitioner->update(['image'=> $imageUrl]);
        }

        if($request->hasFile('license_image')) {
            $practitionerLicenseImage = 'practitionerLicenseImage';

            if (!Storage::exists($practitionerLicenseImage)) {
                Storage::makeDirectory($practitionerLicenseImage);
            }


            if(Storage::exists($practitioner->license_image)){
                Storage::delete($practitioner->license_image);
            }

            $imageUrl = Storage::putFile($practitionerLicenseImage, new File($request->file('license_image')));
            $practitioner->update(['license_image'=> $imageUrl]);
        }

        $practitioner->specialties()->sync($request->specialties);

        PractitionerClinics::where('practitioner_id', $practitioner->id)
        ->delete();


        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {

            $practitionerClinicData = [
                'clinic_id' => $request->practitioner_clinics[$i]['clinic'],
                'practitioner_id' => $practitioner->id,
                'physical_fee' => $request->practitioner_clinics[$i]['physical_fee'],
                'online_fee' => $request->practitioner_clinics[$i]['online_fee'],
                'from_time' => date("H:i:s", strtotime( $request->practitioner_clinics[$i]['from_time'] )),
                'to_time' => date("H:i:s", strtotime( $request->practitioner_clinics[$i]['to_time'] )),
            ];

            $practitionerClinic = PractitionerClinics::create($practitionerClinicData);

            for ($j=0; $j < count($request->practitioner_clinics[$i]['days']) ; $j++) {
                $practitionerClinicDaysData = [
                    'practitioner_clinic_id' => $practitionerClinic->id,
                    'day' => $request->practitioner_clinics[$i]['days'][$j]
                ];

                $practitionerClinicDay = PractitionerClinicDay::create($practitionerClinicDaysData);
            }
        }

        return redirect()->route('practitionerList')->with('success-message', 'Record Updated Successfully.');
    }

    // Practitioner Detail
    public function detail($id)
    {
        $practitioner = Practitioner::where('id', $id)->first();

        if ($practitioner == null) {
            return redirect()->route('practitionerList')->with('error', 'No Record Found.');
        }

        return view('admin.practitioner.detail', ['title' => 'Practitioner Detail', 'practitioner' => $practitioner]);
    }

    // Change Status of the Practitioner
    public function changePractitionerStatus(Request $request)
    {
        $practitioner = Practitioner::find($request->id);

        if($practitioner == null) {
            return response()->json(['status' => 0]);
        }

        $practitioner->update(['status' => $request->status]);

        return response()->json(['status' => 1]);
    }

    // Get Practitioner Appointments
    public function practitionerAppointments($id)
    {
        if($id == null)
        {
            return redirect()->route('practitionerList')->with('error', 'No Record Found.');
        }

        $appointments = Appointment::where('practitioner_id', $id)->orderBy('id', 'DESC')
        ->get();

        return view('admin.practitioner.appointments', ['appointments' => $appointments, 'title' => 'Practitioner Appointments']);
    }

    // Get Practitioner Patients
    public function practitionerPatients($id)
    {
        if($id == null)
        {
            return redirect()->route('practitionerList')->with('error', 'No Record Found.');
        }

        $patientIds = Appointment::where('practitioner_id', $id)->orderBy('id', 'DESC')->pluck('patient_id')->toArray();
        $patientUniqueIds = array_unique($patientIds);
        $patients = Patient::whereIn('id', $patientUniqueIds)->get();

        return view('admin.practitioner.patients', ['patients' => $patients, 'title' => 'Practitioner Patients']);
    }

    // Get Practitioner Assistants
    public function practitionerAssistants($id)
    {
        if($id == null)
        {
            return redirect()->route('practitionerList')->with('error', 'No Record Found.');
        }

        $practitionerAssistantsIds = PractitionerAssistant::where('practitioner_id', $id)->pluck('assistant_id')->toArray();

        $assistants = Assistant::whereIn('id', $practitionerAssistantsIds)->orderBy('id', 'DESC')->get();

        return view('admin.practitioner.assistants', ['assistants' => $assistants, 'title' => 'Practitioner Assistants']);
    }

}

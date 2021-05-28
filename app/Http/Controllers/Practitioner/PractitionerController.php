<?php

namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\AgoraToken;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\PractitionerAssistant;
use App\Models\PractitionerClinicDay;
use App\Models\PractitionerClinics;
use App\Models\PractitionerLabTest;
use App\Models\PrescriptionTemplate;
use App\Models\Qualification;
use App\Models\Specialty;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Validator;


class PractitionerController extends Controller
{
    // Dashboard
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $id = Auth::guard('practitioner')->user()->id;

        $practitioner = Practitioner::find($id);

        $todayAppointmentsCount = Appointment::where('practitioner_id', $practitioner->id)->where('date', $today)->count();
        $todayOpenAppointmentsCount = Appointment::where('practitioner_id', $practitioner->id)->whereIn('status', [0, 1, 2, 4])->where('date', $today)->count();
        $todayClosedAppointmentsCount = Appointment::where('practitioner_id', $practitioner->id)->where('status', 5)->where('date', $today)->count();

        $assistantsCount = PractitionerAssistant::where('practitioner_id', $practitioner->id)->count();

        $patientAppointmentsIds = Appointment::where('practitioner_id', $practitioner->id)->pluck('patient_id')->toArray();

        $patientUniqueIds = array_unique($patientAppointmentsIds);

        $patientsCount = Patient::whereIn('id', $patientUniqueIds)->count();

        $prescriptionTemplatesCount = PrescriptionTemplate::where('practitioner_id', $practitioner->id)->count();

        $practitionerLabTestsCount = PractitionerLabTest::where('practitioner_id', $practitioner->id)->count();

        return view('practitioner.dashboard.dashboard', compact('todayOpenAppointmentsCount', 'todayAppointmentsCount', 'todayClosedAppointmentsCount', 'assistantsCount', 'patientsCount', 'prescriptionTemplatesCount', 'practitionerLabTestsCount'));
    }

    // Profile Edit View
    public function editProfile()
    {
        $specialties = Specialty::where('status', 1)
            ->get();

        $clinics = Clinic::where('status', 1)
            ->get();

        $qualifications = Qualification::where('status', 1)
            ->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('practitioner.profile.profile', ['title' => 'Edit Practitioner', 'days' => $days, 'qualifications' => $qualifications, 'specialties' => $specialties, 'clinics' => $clinics]);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $practitioner = Practitioner::where('id', $request->practitioner_id)
            ->first();

        $rules = [
            'name' => 'required|max:191',
//            'email' => 'email',
            'phone' => 'required|min:12|unique:practitioners,phone,' . $practitioner->id,
            'qualification_id' => 'required',
            'license_no' => 'required',
            'agora_app_id' => 'required',
        ];

        if ($request->hasFile('license_image')) {
            $rules['license_image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if ($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if ($request->hasFile('prescription_pad_header_image')) {
            $rules['prescription_pad_header_image'] = 'required|mimes:jpeg,jpg,png';
        }

        if ($request->hasFile('prescription_pad_footer_image')) {
            $rules['prescription_pad_footer_image'] = 'required|mimes:jpeg,jpg,png';
        }

        if ($request->hasFile('prescription_pad_sidebar_image')) {
            $rules['prescription_pad_sidebar_image'] = 'required|mimes:jpeg,jpg,png';
        }

        if ($request->hasFile('prescription_pad_other_image')) {
            $rules['prescription_pad_other_image'] = 'required|mimes:jpeg,jpg,png';
        }

        // if ($request->has('address')) {
        //     $rules['address'] = 'required|max:250';
        // }

        // if ($request->has('description')) {
        //     $rules['description'] = 'required|max:5000';
        // }

        $old_practitioner_clinics = $request->practitioner_clinics;


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all());
        }

        $allClinics = array();

//        // check if clinic match
//        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
//            $allClinics[$i] = $request->practitioner_clinics[$i]['clinic'];
//        }
//
//        if (count($allClinics) != count(array_unique($allClinics))) {
//            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same clinics.');
//        }
        // check if clinic time interval is correct
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
            $startTime = date("H:i", strtotime($request->practitioner_clinics[$i]['from_time']));
            $endTime = date("H:i", strtotime($request->practitioner_clinics[$i]['to_time']));

            if ($startTime < $endTime) {

            } else {
                return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'Opening Time and Closing Time interval error.');
            }
        }

        // check if clinics day time match
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {

            $firstFromTime = date("H:i", strtotime($request->practitioner_clinics[$i]['from_time']));
            $firstToTime = date("H:i", strtotime($request->practitioner_clinics[$i]['to_time']));

            $days = array();

            for ($j = 0; $j < count($request->practitioner_clinics[$i]['days']); $j++) {
                $days[$j] = $request->practitioner_clinics[$i]['days'][$j];
            }

            for ($k = $i + 1; $k < count($request->practitioner_clinics); $k++) {

                $secondFromTime = date("H:i", strtotime($request->practitioner_clinics[$k]['from_time']));
                $secondToTime = date("H:i", strtotime($request->practitioner_clinics[$k]['to_time']));

                for ($l = 0; $l < count($request->practitioner_clinics[$k]['days']); $l++) {
                    if (in_array($request->practitioner_clinics[$k]['days'][$l], $days, true)) {
                        if (($secondFromTime <= $firstFromTime && $secondToTime > $firstFromTime)
                            || ($secondFromTime >= $firstFromTime && $secondFromTime < $firstToTime)) {
                            // return "overlap";
//                            dd('inside');

                            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same time for same day in different Clinics.');
                        } else {
                            // return "dont overlap";
                        }
                    }
                }
            }
        }
//        dd('out');

        $practitionerData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'license_no' => $request->license_no,
            'agora_app_id' => $request->agora_app_id,
            'agora_app_certificate' => $request->agora_app_certificate,
            'agora_app_channel' => $request->agora_app_channel,
            'status' => 1,
            'qualification_id' => $request->qualification_id,
        ];
        $practitioner->update($practitionerData);

        if ($request->hasFile('license_image')) {
            $practitionerLicenseImage = 'practitionerLicenseImage';

            if (!Storage::exists($practitionerLicenseImage)) {
                Storage::makeDirectory($practitionerLicenseImage);
            }


            if (Storage::exists($practitioner->license_image)) {
                Storage::delete($practitioner->license_image);
            }

            $imageUrl = Storage::putFile($practitionerLicenseImage, new File($request->file('license_image')));
            $practitioner->update(['license_image' => $imageUrl]);
        }
        if ($request->hasFile('image')) {
            $practitionerFolder = 'practitionerImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            if (Storage::exists($practitioner->image)) {
                Storage::delete($practitioner->image);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('image')));
            $practitioner->update(['image' => $imageUrl]);
        }
        if ($request->hasFile('prescription_pad_header_image')) {
            $practitionerFolder = 'practitionerLetterPadImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            if (Storage::exists($practitioner->prescription_pad_header_image)) {
                Storage::delete($practitioner->prescription_pad_header_image);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('prescription_pad_header_image')));
            $practitioner->update(['prescription_pad_header_image' => $imageUrl]);
        }

        if ($request->hasFile('prescription_pad_footer_image')) {
            $practitionerFolder = 'practitionerLetterPadImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            if (Storage::exists($practitioner->prescription_pad_footer_image)) {
                Storage::delete($practitioner->prescription_pad_footer_image);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('prescription_pad_footer_image')));
            $practitioner->update(['prescription_pad_footer_image' => $imageUrl]);
        }

        if ($request->hasFile('prescription_pad_sidebar_image')) {
            $practitionerFolder = 'practitionerLetterPadImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            if (Storage::exists($practitioner->prescription_pad_sidebar_image)) {
                Storage::delete($practitioner->prescription_pad_sidebar_image);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('prescription_pad_sidebar_image')));
            $practitioner->update(['prescription_pad_sidebar_image' => $imageUrl]);
        }

        if ($request->hasFile('prescription_pad_other_image')) {
            $practitionerFolder = 'practitionerLetterPadImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            if (Storage::exists($practitioner->prescription_pad_other_image)) {
                Storage::delete($practitioner->prescription_pad_other_image);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('prescription_pad_other_image')));
            $practitioner->update(['prescription_pad_other_image' => $imageUrl]);
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
                'from_time' => date("H:i:s", strtotime($request->practitioner_clinics[$i]['from_time'])),
                'to_time' => date("H:i:s", strtotime($request->practitioner_clinics[$i]['to_time'])),
            ];

            $practitionerClinic = PractitionerClinics::create($practitionerClinicData);

            for ($j = 0; $j < count($request->practitioner_clinics[$i]['days']); $j++) {
                $practitionerClinicDaysData = [
                    'practitioner_clinic_id' => $practitionerClinic->id,
                    'day' => $request->practitioner_clinics[$i]['days'][$j]
                ];

                $practitionerClinicDay = PractitionerClinicDay::create($practitionerClinicDaysData);
            }
        }

        return redirect()->route('practitionerDashboard')->with('success-message', 'Profile Updated Successfully!');

    }

    public function removeFilePractitioner(Request $request)
    {
//        dd($request->all());
        $practitioner = practitioner::find(Auth::guard('practitioner')->user()->id);

        if ($practitioner == null) {
            return response()->json(['status' => 0]);
        }

        if ($request->has('file_name') && $request->file_name == 'license_image') {

            if (Storage::exists($practitioner->license_image)) {
                Storage::delete($practitioner->license_image);
            }

            $practitioner->update(['license_image' => null]);
        }
        if ($request->has('file_name') && $request->file_name == 'image') {

            if (Storage::exists($practitioner->image)) {
                Storage::delete($practitioner->image);
            }

            $practitioner->update(['image' => null]);
        }
        if ($request->has('file_name') && $request->file_name == 'prescription_pad_header_image') {

            if (Storage::exists($practitioner->prescription_pad_header_image)) {
                Storage::delete($practitioner->prescription_pad_header_image);
            }

            $practitioner->update(['prescription_pad_header_image' => null]);
        }

        if ($request->has('file_name') && $request->file_name == 'prescription_pad_footer_image') {

            if (Storage::exists($practitioner->prescription_pad_footer_image)) {
                Storage::delete($practitioner->prescription_pad_footer_image);
            }

            $practitioner->update(['prescription_pad_footer_image' => null]);
        }

        if ($request->has('file_name') && $request->file_name == 'prescription_pad_sidebar_image') {

            if (Storage::exists($practitioner->prescription_pad_sidebar_image)) {
                Storage::delete($practitioner->prescription_pad_sidebar_image);
            }
            $practitioner->update(['prescription_pad_sidebar_image' => null]);
        }

        if ($request->has('file_name') && $request->file_name == 'prescription_pad_other_image') {

            if (Storage::exists($practitioner->prescription_pad_other_image)) {
                Storage::delete($practitioner->prescription_pad_other_image);
            }

            $practitioner->update(['prescription_pad_other_image' => null]);
        }


        return response()->json(['status' => 1]);

    }

    // Change Password View
    public function changePassword()
    {
        return view('practitioner.profile.changePassword');
    }

    // Change Password
    public function updateChangePassword(Request $request)
    {
        $rules['old_password'] = 'required';

        if ($request->new_password != null) {
            $rules['new_password'] = 'required_with:confirm_new_password|same:confirm_new_password|min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = practitioner::find(Auth::guard('practitioner')->user()->id);

        if (Hash::check($request->old_password, $practitioner->password)) {

            if ($request->new_password != null) {
                $practitioner->password = Hash::make($request->new_password);
            }

            $practitioner->update();
            Auth::guard('practitioner')->logout();
            return redirect()->route('practitionerLoginForm')->with('success-message', 'Successfully Changed Password, Login Again!');
        } else {
            return redirect()->back()->with('error-message', 'Old Password is not Matched, Try Again!');
        }
    }

    // clinic List
    public function clinicList()
    {

        $id = Auth::guard('practitioner')->user()->id;

        $practitioner = Practitioner::find($id);

        $clinics = $practitioner->getClinics;

        return view('practitioner.clinic.index', ['clinics' => $clinics, 'title' => 'Clinics']);
    }

    // clinic Profile
    public function clinicProfile($id)
    {

        $clinic = Clinic::find($id);

        return view('practitioner.clinic.profile', ['clinic' => $clinic, 'title' => 'Profile']);
    }


    //edit practitioner
    public function editData()
    {
        $id = Auth::guard('practitioner')->user()->id;

        $practitioner = Practitioner::find($id);

        $specialties = Specialty::where('status', 1)
            ->get();

        $clinics = Clinic::where('status', 1)
            ->get();

        $qualifications = Qualification::where('status', 1)
            ->get();


        return view('practitioner.data.index', ['title' => 'Edit Practitioner', 'practitioner' => $practitioner, 'specialties' => $specialties, 'clinics' => $clinics, 'qualifications' => $qualifications]);
    }

    // update practitioner data
    public function updateData(Request $request)
    {

        $practitioner = Practitioner::where('id', $request->practitioner_id)
            ->first();

        $rules = [
            'phone' => 'required|min:12|unique:practitioners,phone,' . $practitioner->id,
            'qualification_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        $old_practitioner_clinics = $request->practitioner_clinics;

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all());
        }

        $allClinics = array();

        // check if clinic match
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
            $allClinics[$i] = $request->practitioner_clinics[$i]['clinic'];
        }

        if (count($allClinics) != count(array_unique($allClinics))) {
            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same clinics.');
        }

        // check if clinic time interval is correct
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {
            $startTime = date("H:i", strtotime($request->practitioner_clinics[$i]['from_time']));
            $endTime = date("H:i", strtotime($request->practitioner_clinics[$i]['to_time']));

            if ($startTime < $endTime) {

            } else {
                return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'Clinic Opening Time and Closing Time interval error.');
            }
        }

        // check if clinics day time match
        for ($i = 0; $i < count($request->practitioner_clinics); $i++) {

            $firstFromTime = date("H:i", strtotime($request->practitioner_clinics[$i]['from_time']));
            $firstToTime = date("H:i", strtotime($request->practitioner_clinics[$i]['to_time']));

            $days = array();

            for ($j = 0; $j < count($request->practitioner_clinics[$i]['days']); $j++) {
                $days[$j] = $request->practitioner_clinics[$i]['days'][$j];
            }

            for ($k = $i + 1; $k < count($request->practitioner_clinics); $k++) {

                $secondFromTime = date("H:i", strtotime($request->practitioner_clinics[$k]['from_time']));
                $secondToTime = date("H:i", strtotime($request->practitioner_clinics[$k]['to_time']));

                for ($l = 0; $l < count($request->practitioner_clinics[$k]['days']); $l++) {
                    if (in_array($request->practitioner_clinics[$k]['days'][$l], $days, true)) {
                        if (($secondFromTime <= $firstFromTime && $secondToTime > $firstFromTime)
                            || ($secondFromTime >= $firstFromTime && $secondFromTime < $firstToTime)) {
                            // return "overlap";
                            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same time for same day in different Clinics.');
                        } else {
                            // return "dont overlap";
                        }
                    }
                }
            }
        }

        $practitionerData = [
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'qualification_id' => $request->qualification_id,
        ];

        $practitioner->update($practitionerData);

        if ($request->hasFile('image')) {
            $practitionerFolder = 'practitionerImage';

            if (!Storage::exists($practitionerFolder)) {
                Storage::makeDirectory($practitionerFolder);
            }

            if (Storage::exists($practitioner->image)) {
                Storage::delete($practitioner->image);
            }

            $imageUrl = Storage::putFile($practitionerFolder, new File($request->file('image')));
            $practitioner->update(['image' => $imageUrl]);
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
                'from_time' => date("H:i:s", strtotime($request->practitioner_clinics[$i]['from_time'])),
                'to_time' => date("H:i:s", strtotime($request->practitioner_clinics[$i]['to_time'])),
            ];

            $practitionerClinic = PractitionerClinics::create($practitionerClinicData);

            for ($j = 0; $j < count($request->practitioner_clinics[$i]['days']); $j++) {
                $practitionerClinicDaysData = [
                    'practitioner_clinic_id' => $practitionerClinic->id,
                    'day' => $request->practitioner_clinics[$i]['days'][$j]
                ];

                $practitionerClinicDay = PractitionerClinicDay::create($practitionerClinicDaysData);
            }
        }

        return redirect()->route('practitionerEditData')->with('success-message', 'Profile Updated Successfully.');
    }

    public function notificationDetail($id)
    {
        $notification = Notification::find($id);

        if (empty($notification)) {
            return redirect()->back()->with('error-message', 'Not Found !');
        }

        $notification->is_read = 1;

        $notification->update();

        return view('practitioner.notification.detail', compact('notification'));
    }

    public function patientVisit()
    {
        return view('practitioner.patient.patientVisit');
    }

    public function joinAppointment($id)
    {
        $practitioner = Auth::guard('practitioner')->user();
        if ($practitioner == null) {
            return redirect()->route('practitionerLoginForm');
        }
        $appointment = Appointment::where('id', $id)->where('practitioner_id', $practitioner->id)->with(['patient', 'practitioner'])->first();
        $agoraToken = AgoraToken::where('status', 1)->first();
        $token = $agoraToken->token;
        if ($appointment != null) {
            if (empty($appointment->practitioner->agora_app_id) || empty($appointment->practitioner->agora_app_token) || empty($appointment->practitioner->agora_app_channel)) {
                return redirect()->route('indexPage')->with('error-message', 'Please Add Video Calling App Information.');
            }
            $appointment->update([
                'practitioner_start' => 1,
                'appointment_complete' => 0,
            ]);
            return view('practitioner.practitionerAppointment', ['appointment' => $appointment, 'token' => $token]);

            // $currentDate = Carbon::now()->format('Y-m-d');
            // $currentTime = Carbon::now()->format('h:i:s');
            // $slotEndTime = Carbon::parse($appointment->time_slot)->addMinutes(15)->format('h:i:s');

            // $appointmentTime = Carbon::parse($appointment->time_slot)->format('h:i:s');

            // if($currentDate == $appointment->date && $currentTime >= $appointmentTime && $currentTime <= $slotEndTime){
            //     return view('practitioner.practitionerAppointment',['appointment'=>$appointment]);
            // }else{
            //     if(!($currentDate == $appointment->date) && !($currentTime > $slotEndTime)) {
            //         return redirect()->route('indexPage')->with('error-message', 'Appointment is schedule for '.$appointment->date);
            //     }
            //     if(!($currentTime < $appointmentTime)) {
            //         return redirect()->route('indexPage')->with('error-message', 'Appointment is schedule for '.$appointmentTime .' - '. $slotEndTime);
            //     }
            //     // if(!($currentTime > $slotEndTime)) {
            //     //     return redirect()->route('indexPage')->with('error-message', 'Appointment is schedule for '.$slotEndTime);
            //     // }
            // }

        } else {
            return redirect()->route('indexPage')->with('error-message', 'Appointment is not schedule.');
        }
    }
}

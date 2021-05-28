<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\AgoraToken;
use App\Models\Appointment;
use App\Models\Assistant;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Practitioner;
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

class AssistantController extends Controller
{
    // Dashboard
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        if (count($practitionersID) > 0) {
            $todayAppointmentsCount = Appointment::whereIn('practitioner_id', $practitionersID)->where('date', $today)->count();
            $todayOpenAppointmentsCount = Appointment::whereIn('practitioner_id', $practitionersID)->whereIn('status', [0, 1, 2, 4])->where('date', $today)->count();
            $todayClosedAppointmentsCount = Appointment::where('practitioner_id', $practitionersID)->where('status', 5)->where('date', $today)->count();
            $practitionersCount = $assistant->practitioners()->count();
            $practitionerLabTestsCount = PractitionerLabTest::whereIn('practitioner_id', $practitionersID)->count();
            $patientAppointmentsIds = Appointment::whereIn('practitioner_id', $practitionersID)->pluck('patient_id')->toArray();
            $patientUniqueIds = array_unique($patientAppointmentsIds);
            $patientsCount = Patient::whereIn('id', $patientUniqueIds)->count();
            $prescriptionTemplatesCount = PrescriptionTemplate::whereIn('practitioner_id', $practitionersID)->count();
        } else {
            $todayAppointmentsCount = 0;
            $todayOpenAppointmentsCount = 0;
            $todayClosedAppointmentsCount = 0;
            $practitionersCount = 0;
            $practitionerLabTestsCount = 0;
            $patientsCount = 0;
            $prescriptionTemplatesCount = 0;
        }

        return view('assistant.dashboard.dashboard', compact('todayOpenAppointmentsCount', 'todayAppointmentsCount', 'todayClosedAppointmentsCount', 'practitionersCount', 'patientsCount', 'prescriptionTemplatesCount', 'practitionerLabTestsCount'));
    }

    // Profile Edit View
    public function editProfile()
    {
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $specialties = Specialty::where('status', 1)
            ->get();
        $qualifications = Qualification::where('status', 1)
            ->get();
        $practitioners = Practitioner::where('status', 1)
            ->get();
        return view('assistant.profile.profile', ['title' => 'Edit Assistant', 'assistant' => $assistant, 'qualifications' => $qualifications, 'specialties' => $specialties, 'practitioners' => $practitioners]);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $assistant = Assistant::where('id', $request->assistant_id)
            ->first();

        $rules = [
            'name' => 'required|max:191',
            'email' => 'email',
            'phone' => 'required|min:12|unique:assistants,phone,' . $assistant->id,
            'qualification_id' => 'required',
            'practitioners.*' => 'required',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if ($request->has('address')) {
            $rules['address'] = 'required|max:250';
        }

        if ($request->has('description')) {
            $rules['description'] = 'required|max:5000';
        }

        if (!empty($request->password)) {
            $rules['password'] = 'required_with:confirm_password|same:confirm_password|min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $assistantData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'qualification_id' => $request->qualification_id,
        ];

        $assistant->update($assistantData);

        if ($request->hasFile('image')) {
            $assistantFolder = 'assistantImage';

            if (!Storage::exists($assistantFolder)) {
                Storage::makeDirectory($assistantFolder);
            }

            if (Storage::exists($assistant->image)) {
                Storage::delete($assistant->image);
            }

            $imageUrl = Storage::putFile($assistantFolder, new File($request->file('image')));
            $assistant->update(['image' => $imageUrl]);
        }

        $assistant->specialties()->sync($request->specialties);
        $assistant->practitioners()->sync($request->practitioners);

        return redirect()->route('assistantDashboard')->with('success-message', 'Profile Updated Successfully!');

    }

    // Change Password View
    public function changePassword()
    {
        return view('assistant.profile.changePassword');
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

        $assistant = Assistant::find(Auth::guard('assistant')->user()->id);

        if (Hash::check($request->old_password, $assistant->password)) {

            if ($request->new_password != null) {
                $assistant->password = Hash::make($request->new_password);
            }

            $assistant->update();
            Auth::guard('assistant')->logout();
            return redirect()->route('assistantLoginForm')->with('success-message', 'Successfully Changed Password, Login Again!');
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

    public function notificationDetail($id)
    {
        $notification = Notification::find($id);

        if (empty($notification)) {
            return redirect()->back()->with('error-message', 'Not Found !');
        }

        $notification->is_read = 1;

        $notification->update();

        return view('assistant.notification.detail', compact('notification'));
    }

    public function patientVisit()
    {
        return view('assistant.patient.patientVisit');
    }

    public function joinAppointment($id)
    {
        $practitioner = Auth::guard('assistant')->user();
        if ($practitioner == null) {
            return redirect()->route('assistantLoginForm');
        }
        $appointment = Appointment::where('id', $id)->with(['patient', 'practitioner'])->first();
        $agoraToken = AgoraToken::where('status', 1)->first();
        $token = $agoraToken->token;

        if ($appointment != null) {

            if (empty($appointment->practitioner->agora_App_id) || empty($appointment->practitioner->agora_App_token) || empty($appointment->practitioner->agora_App_channel)) {
                return redirect()->route('indexPage')->with('error-message', 'Please Add Video Calling App Information.');
            }
            $appointment->update([
                'practitioner_start' => 1,
                'appointment_complete' => 0,
            ]);
            return view('assistant.assistantAppointment', ['appointment' => $appointment, 'token' => $token]);

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

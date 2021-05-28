<?php

namespace App\Http\Controllers\Practitioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Practitioner;
use App\Models\PractitionerClinics;
use App\Models\PractitionerClinicDay;


use App\Models\Clinic;
use Storage;
use Mail;
use Illuminate\Support\Facades\Auth;
use URL;
use Illuminate\Http\File;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;
use App\Models\Qualification;
use App\Rules\EmailMustHaveTLD;

use App\Events\Notify;

class LoginController extends Controller
{
    // practitioner Login Form
    public function loginForm()
    {
        if (Auth::guard('practitioner')->check()) {
            return redirect()->route('practitionerDashboard');
        }
        return view('practitioner.login.loginForm');
    }

    // login clinic
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $rememberMe = $request->has('remember') ? true : false;
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->email, 'password' => $request->password, 'status' => 1];

        } else {
            $credentials = ['phone' => $request->email, 'password' => $request->password, 'status' => 1];
        }
        if (Auth::guard('practitioner')->attempt($credentials, $rememberMe)) {
            return redirect()->route('practitionerDashboard')->with('success-message', 'Succesfully Logged in!');
        } else {
            return redirect()->route('practitionerLoginForm')->withInput(Input::all())->with('error-message', 'Invalid Credentials / Not Approved By Admin');
        }
    }

    // practitioner Register Form
    public function registerForm()
    {
        if (Auth::guard('practitioner')->check()) {
            return redirect()->route('practitionerDashboard');
        }

        $clinics = Clinic::where('status', 1)
            ->get();

        $qualifications = Qualification::where('status', 1)
            ->get();

        return view('practitioner.login.registerForm', ['clinics' => $clinics, 'qualifications' => $qualifications]);
    }

    // register practitioner
    public function register(Request $request)
    {

        $rules = [
            'practitioner_clinics' => 'required|array|min:1',
            'name' => 'required|max:191',
//            'email' => ['required', 'email', 'unique:practitioners', new EmailMustHaveTLD],
            'phone' => 'required|min:12|unique:practitioners',
            'qualification_id' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
        ];


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
//        if (count($allClinics) != count(array_unique($allClinics))) {
//            return Redirect::back()->with('old_practitioner_clinics', [$old_practitioner_clinics])->withInput(Input::all())->with('error-message', 'You can not select same clinics.');
//        }

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
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'qualification_id' => $request->qualification_id,
            'status' => 0,
            'password' => Hash::make($request->password),
        ];

        $practitioner = Practitioner::create($practitionerData);

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


        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        );

        try {
            Mail::send('practitioner.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject("Account Creation");
            });
        } catch (\Exception $e) {

        }

        $notificationData = [
            'user_type' => 2,
            'user_id' => 0,
            'is_read' => 0,
            'title' => 'Practitioner Account Request',
            'message' => 'Please check out practitioner list to approve the request for ' . $practitioner->email
        ];

        $notification = Notification::create($notificationData);

        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));

        return redirect()->route('practitionerLoginForm')->with('success-message', 'Succesfully Registered! Wait for admin approval to login.');
    }

    public function practitionerLogout()
    {
        Auth::guard('practitioner')->logout();
        return redirect()->route('practitionerLoginForm');
    }

    // Get Password forgot Form
    public function passwordForgotForm()
    {
        return view('auth.passwords.practitionerForgotForm');
    }

    // Send Email Link
    public function passwordForgotEmail(Request $request)
    {
        $practitioner = Practitioner::where('email', $request->email)
            ->first();

        if (empty($practitioner)) {
            return ['status' => 1, 'error' => 'Email does not exist in record.'];
        }

        $response = app('App\Http\Controllers\Auth\PractitionerForgotPasswordController')->sendResetLinkEmail($request);

        return $response;
    }
}

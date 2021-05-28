<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Patient;
use App\Models\Notification;
use App\Events\Notify;

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
use App\Rules\EmailMustHaveTLD;


class LoginController extends Controller
{

    // patient Login Form
    public function loginForm()
    {
        if (Auth::guard('patient')->check()) {
            return redirect()->route('patientDashboard');
        }
        return view('patient.login.loginForm');
    }

    // login patient
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
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->email, 'password' => $request->password, 'status' => 1];
        } else {
            $credentials = ['phone' => $request->email, 'password' => $request->password, 'status' => 1];
        }
        if (Auth::guard('patient')->attempt($credentials)) {
            return redirect()->route('patientDashboard')->with('success-message', 'Succesfully Logged in!');
        }
        else {
            return redirect()->route('patientLoginForm')->withInput(Input::all())->with('error-message', 'Invalid Credentials / Not Approved By Admin');
        }
    }

    // patient Register Form
    public function registerForm()
    {
        if (Auth::guard('patient')->check()) {
            return redirect()->route('patientDashboard');
        }
        return view('patient.login.registerForm');
    }

    // register patient
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:191',
//            'email' => ['required', 'email', 'unique:patients' , new EmailMustHaveTLD],
            'phone' => 'required|min:12|unique:patients',
            'dob' => 'required',
            'age' => 'required|gt:0',
            'gender' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $randomNumber = rand(10000000, 99999999);

        $patientData = [
            'mr_number' => $randomNumber,
            'patient_type_id' => 3,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => Carbon::parse($request->dob)->format('Y-m-d'),
            'age' => $request->age,
            'status' => 1,
            'password' => Hash::make($request->password),
        ];

        $patient = Patient::create($patientData);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        );

        try{
            Mail::send('patient.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject("Account Creation");
            });
        } catch (\Exception $e) {

        }

        $notificationData = [
            'user_type' => 1,
            'user_id' =>  0,
            'is_read' => 0,
            'title' => 'Patient Account Request',
            'message' => 'Please check out patient list to approve the request for '. $patient->email
        ];

        $notification = Notification::create($notificationData);

        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime ,$notification->user_type, $notification->user_id));

        return redirect()->route('patientLoginForm')->with('success-message', 'Succesfully Registered! Wait for admin approval to login.');
    }

    public function patientLogout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('patientLoginForm');
    }

    // Get Password forgot Form
    public function passwordForgotForm()
    {
        return view('auth.passwords.patientForgotForm');
    }

    // Send Email Link
    public function passwordForgotEmail(Request $request)
    {
        $patient = Patient::where('email', $request->email)
        ->first();

        if(empty($patient)){
            return ['status' => 1, 'error' => 'Email does not exist in record.'];
        }

        $response = app('App\Http\Controllers\Auth\PatientForgotPasswordController')->sendResetLinkEmail($request);

        return $response;
    }

}

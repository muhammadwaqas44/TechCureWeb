<?php

namespace App\Http\Controllers\Clinic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use App\Events\Notify;
use App\Rules\EmailMustHaveTLD;


class LoginController extends Controller
{

    // clinic Login Form
    public function loginForm()
    {
        if (Auth::guard('clinic')->check()) {
            return redirect()->route('clinicDashboard');
        }
        return view('clinic.login.loginForm');
    }

    // login clinic
    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        if (Auth::guard('clinic')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return redirect()->route('clinicDashboard')->with('success-message', 'Succesfully Logged in!');
        } 
        else {
            return redirect()->route('clinicLoginForm')->withInput(Input::all())->with('error-message', 'Invalid Credentials / Not Approved By Admin');
        }
    }

    // clinic Register Form
    public function registerForm()
    {
        if (Auth::guard('clinic')->check()) {
            return redirect()->route('clinicDashboard');
        }
        return view('clinic.login.registerForm');
    }

    // register clinic
    public function register(Request $request)
    {

        $rules = [
            'name' => 'required|max:191',
            'email' => ['required', 'email', 'unique:clinics' , new EmailMustHaveTLD],
            'phone' => 'required|min:12',
            'all_day' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
        ];

        if($request->all_day==0){
            $rules['from_day'] = 'required';
            $rules['to_day'] = 'required';
            $rules['opening_time'] = 'required';
            $rules['closing_time'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $clinicData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 0,
            'all_day' => $request->all_day,
            'password' => Hash::make($request->password),
        ];

        if($request->all_day==0){
            $clinicData['from_day'] = $request->from_day;
            $clinicData['to_day'] = $request->to_day;
            $clinicData['opening_time'] = date("H:i:s", strtotime( $request->opening_time));
            $clinicData['closing_time'] = date("H:i:s", strtotime( $request->closing_time));
        }


        $clinic = Clinic::create($clinicData);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        );

        try{
            Mail::send('clinic.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject("Account Creation");
            });
        } catch (\Exception $e) {

        }

        $notificationData = [
            'user_type' => 4, 
            'user_id' =>  0,
            'is_read' => 0,
            'title' => 'Clinic Account Request',
            'message' => 'Please check out clinic list to approve the request for '. $clinic->email 
        ];

        $notification = Notification::create($notificationData);
        
        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime ,$notification->user_type, $notification->user_id));

        return redirect()->route('clinicLoginForm')->with('success-message', 'Succesfully Registered! Wait for admin approval to login.');
    }

    public function clinicLogout()
    {
        Auth::guard('clinic')->logout();
        return redirect()->route('clinicLoginForm');
    }

    // Get Password forgot Form
    public function passwordForgotForm()
    {
        return view('auth.passwords.clinicForgotForm');
    }

    // Send Email Link
    public function passwordForgotEmail(Request $request)
    {
        $clinic = Clinic::where('email', $request->email)
        ->first();

        if(empty($clinic)){
            return ['status' => 1, 'error' => 'Email does not exist in record.'];
        }

        $response = app('App\Http\Controllers\Auth\ClinicForgotPasswordController')->sendResetLinkEmail($request);
        
        return $response;
    }
}

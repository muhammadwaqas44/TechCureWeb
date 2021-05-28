<?php

namespace App\Http\Controllers\Assistant;

use App\Events\Notify;
use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\Notification;
use App\Models\Practitioner;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Storage;
use URL;
use Validator;

class LoginController extends Controller
{
    // assistant Login Form
    public function loginForm()
    {
        if (Auth::guard('assistant')->check()) {
            return redirect()->route('assistantDashboard');
        }
        return view('assistant.login.loginForm');
    }

    // login assistant
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
        if (Auth::guard('assistant')->attempt($credentials, $rememberMe)) {
            return redirect()->route('assistantDashboard')->with('success-message', 'Succesfully Logged in!');
        } else {
            return redirect()->route('assistantLoginForm')->withInput(Input::all())->with('error-message', 'Invalid Credentials / Not Approved By Admin');
        }
    }

    // assistant Register Form
    public function registerForm()
    {
        if (Auth::guard('assistant')->check()) {
            return redirect()->route('assistantDashboard');
        }

        $qualifications = Qualification::where('status', 1)->get();
        $practitioners = Practitioner::where('status', 1)->get();

        return view('assistant.login.registerForm', ['qualifications' => $qualifications, 'practitioners' => $practitioners]);
    }

    // register assistant
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:191',
//            'email' => ['required', 'email', 'unique:assistants', new EmailMustHaveTLD],
            'phone' => 'required|min:12|unique:assistants',
            'qualification_id' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
        ];


        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $assistantData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'qualification_id' => $request->qualification_id,
            'status' => 0,
            'password' => Hash::make($request->password),
        ];

        $assistant = Assistant::create($assistantData);

        $assistant->practitioners()->sync($request->practitioners);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        );

        try {
            Mail::send('assistant.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject("Account Creation");
            });
        } catch (\Exception $e) {

        }

        $notificationData = [
            'user_type' => 4,
            'user_id' => 0,
            'is_read' => 0,
            'title' => 'Assistant Account Request',
            'message' => 'Please check out assistant list to approve the request for ' . $assistant->email
        ];

        $notification = Notification::create($notificationData);

        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));

        return redirect()->route('assistantLoginForm')->with('success-message', 'Succesfully Registered! Wait for admin approval to login.');
    }

    public function assistantLogout()
    {
        Auth::guard('assistant')->logout();
        return redirect()->route('assistantLoginForm');
    }

    // Get Password forgot Form
    public function passwordForgotForm()
    {
        return view('auth.passwords.assistantForgotForm');
    }

    // Send Email Link
    public function passwordForgotEmail(Request $request)
    {
        $practitioner = Assistant::where('email', $request->email)
            ->first();

        if (empty($practitioner)) {
            return ['status' => 1, 'error' => 'Email does not exist in record.'];
        }

        $response = app('App\Http\Controllers\Auth\AssistantForgotPasswordController')->sendResetLinkEmail($request);

        return $response;
    }

}

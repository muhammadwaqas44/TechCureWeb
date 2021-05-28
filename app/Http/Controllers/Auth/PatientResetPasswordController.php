<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;

class PatientResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:patient');
    }

    public function showResetForm(Request $request, $token = null) {
        return view('auth.passwords.patientResetForm')
            ->with(['token' => $token, 'email' => $request->email]
            );
    }


    //defining which guard to use in our case, it's the patient guard
    protected function guard()
    {
        return Auth::guard('patient');
    }

    //defining our password broker function
    protected function broker() {
        return Password::broker('patients');
    }
}

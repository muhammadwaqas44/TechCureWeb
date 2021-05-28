<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;

class ClinicResetPasswordController extends Controller
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
        $this->middleware('guest:clinic');
    }

    public function showResetForm(Request $request, $token = null) {
        return view('auth.passwords.clinicResetForm')
            ->with(['token' => $token, 'email' => $request->email]
            );
    }


    //defining which guard to use in our case, it's the clinic guard
    protected function guard()
    {
        return Auth::guard('clinic');
    }

    //defining our password broker function
    protected function broker() {
        return Password::broker('clinics');
    }
}

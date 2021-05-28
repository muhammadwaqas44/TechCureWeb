<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class ClinicForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:clinic');
    }
    
    protected function sendResetLinkResponse($response)
    {
        return response()->json(['status' => 0, 'message' => trans($response)]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return  response()->json(['status' => 1, 'error' => trans($response)]);
    }

    protected function broker() {
        return Password::broker('clinics');
    }
}

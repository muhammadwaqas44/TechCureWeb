<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Auth;


class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::where('patient_id', Auth::guard('patient')->user()->id)->get();

        return view('patient.payment.index', ['payments' => $payments, 'title' => 'Payments']);
    }
}

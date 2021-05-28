<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;


class PaymentController extends Controller
{
    // Show list of all Patients Payments
    public function index()
    {
        $payments = Payment::orderBy('id', 'DESC')->get();

        return view('admin.payment.index', ['payments' => $payments, 'title' => 'Payments']);
    }


    public function edit($id)
    {
        $payment = Payment::find($id);
        if (empty($payment)) {
            return redirect()->route('paymentList')->with('error-message', 'No record Found.');
        }
        return view('admin.payment.edit', ['payment' => $payment, 'title' => 'Edit Payment']);
    }

    public function update(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        if (empty($payment)) {
            return redirect()->route('paymentList')->with('error-message', 'No record Found.');
        }
        $payment->payment_status = $request->payment_status;
        $payment->save();
        return redirect()->route('paymentList')->with('success-message', 'Status Updated Successfully.');
    }
}

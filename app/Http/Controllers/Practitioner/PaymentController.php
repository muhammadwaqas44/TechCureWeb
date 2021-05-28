<?php

namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    // List all Practitioner Payments
    public function index()
    {
        $payments = Payment::where('practitioner_id', Auth::guard('practitioner')->user()->id)->orderBy('id', 'DESC')->get();
        return view('practitioner.payment.index', ['payments' => $payments, 'title' => 'Payments']);
    }

    // Edit Practitioner Payment
    public function edit($id)
    {
        $payment = Payment::find($id);
        if (empty($payment)) {
            return redirect()->route('practitionerPaymentList')->with('error-message', 'No Record Found.');
        }

        return view('practitioner.payment.edit', ['payment' => $payment, 'title' => 'Edit Payment']);
    }

    // Update Practitioner Payments
    public function update(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        if (empty($payment)) {
            return redirect()->route('practitionerPaymentList')->with('error-message', 'No Record Found.');
        }

        $payment->payment_method = $request->payment_method;
        $payment->payment_status = $request->payment_status;
        $payment->save();

        return redirect()->route('practitionerPaymentList')->with('success-message', 'Payment Status Updated Successfully.');
    }

    public function dailyReport(Request $request)
    {
        $payments = Payment::whereDate('created_at', Carbon::now())->with('appointment', 'patient', 'practitioner')->get()->toArray();
//        $payments = [];

        if ($payments != null) {

            $to = Auth::guard('practitioner')->user()->email;
            $name = Auth::guard('practitioner')->user()->name;

            Mail::send('mails.dailyPaymentReport',compact('payments'), function ($message) use ($to, $name) {
//                $message->from('info@myeonhealth.com', 'My EON Health');
                $message->to($to, $name)->subject
                ('Payment Daily Report');
            });

            return redirect()->route('practitionerPaymentList')->with('success-message', 'Mail Sent To Your Mail Account.');
        } else {
            return redirect()->route('practitionerPaymentList')->with('error-message', 'No Entry Found.');
        }
    }
}

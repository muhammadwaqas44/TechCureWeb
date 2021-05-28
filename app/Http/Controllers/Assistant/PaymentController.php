<?php

namespace App\Http\Controllers\Assistant;

use App\Models\Assistant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    // List all Practitioner Payments
    public function index()
    {

        $id = Auth::guard('assistant')->user()->id;

        $assistant = Assistant::find($id);

        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $payments = Payment::whereIn('practitioner_id', $practitionersID)->orderBy('id','DESC')->get();
        return view('assistant.payment.index', ['payments' => $payments, 'title' => 'Payments']);
    }

    // Edit Practitioner Payment
    public function edit($id)
    {
        $payment = Payment::find($id);
        if (empty($payment)) {
            return redirect()->route('assistantPaymentList')->with('error-message', 'No Record Found.');
        }

        return view('assistant.payment.edit', ['payment' => $payment, 'title' => 'Edit Payment']);
    }

    // Update Practitioner Payments
    public function update(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        if (empty($payment)) {
            return redirect()->route('assistantPaymentList')->with('error-message', 'No Record Found.');
        }

        $payment->payment_method = $request->payment_method;
        $payment->payment_status = $request->payment_status;
        $payment->save();

        return redirect()->route('assistantPaymentList')->with('success-message', 'Payment Status Updated Successfully.');
    }

    public function dailyReport(Request $request)
    {
        $payments = Payment::whereDate('created_at', Carbon::now())->with('appointment', 'patient', 'practitioner')->get()->toArray();
//        $payments = [];

        if ($payments != null) {

            $to = Auth::guard('assistant')->user()->email;
            $name = Auth::guard('assistant')->user()->name;

            Mail::send('mails.dailyPaymentReport',compact('payments'), function ($message) use ($to, $name) {
                $message->to($to, $name)->subject
                ('Payment Daily Report');
            });

            return redirect()->route('assistantPaymentList')->with('success-message', 'Mail Sent To Your Mail Account.');
        } else {
            return redirect()->route('assistantPaymentList')->with('error-message', 'No Entry Found.');
        }
    }
}

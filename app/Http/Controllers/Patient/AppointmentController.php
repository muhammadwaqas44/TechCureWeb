<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientType;
use App\Models\Payment;
use App\Models\Practitioner;
use App\Models\PractitionerClinicDay;
use App\Models\PractitionerClinics;
use Auth;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Session;
use Storage;
use URL;
use Validator;


class AppointmentController extends Controller
{

    // show list of today appointments
    public function todayAppointment()
    {
        $today = Carbon::now()->format('Y-m-d');
        $appointments = Appointment::where('patient_id', Auth::guard('patient')->user()->id)
            ->where('date', $today)
            ->whereNotIn('status', [2, 4])
            ->orderBy('id', 'DESC')
            ->get();

        return view('patient.appointment.index', ['appointments' => $appointments, 'title' => 'Appointments']);
    }

    // show list of all appointments
    public function index()
    {
        $patient = Patient::find(Auth::guard('patient')->user()->id);
        $appointments = Appointment::orderBy('id', 'DESC')->where('patient_id', Auth::guard('patient')->user()->id);

        $appointments = $appointments->with(['patient', 'practitioner', 'payment', 'patientType'])->get();
        $appointments = $appointments->toArray();

//        usort($appointments, function ($first, $second) {
//            return (strtotime($first['date'] . ' ' . $first['time_slot']) > strtotime($second['date'] . ' ' . $second['time_slot']));
//        });

//        $paymentParameter = [];
//        foreach ($appointments as $appointment) {
//            $currentTime = Carbon::now()->timezone('Asia/Karachi')->format('Y-m-d\TH:i:s');
//            $emailAddress = $patient->email;
//            $mobileNum = str_replace('-', '', $patient->phone);
//            $storeId = env('EASYPIASA_STORE_ID');
//            $paymentMethod = 'InitialRequest';
//            $postBackURL = route('backPayment');
//            $orderRefNum = (string)$appointment['id'];
//            $expiryDate = Carbon::parse($appointment['date'])->addDay()->format('Ymd Hms');
//            $amount = $appointment['payment']['amount'];
//            $hashKey = env('EASYPIASA_HASH_KEY');
//            $paramMap = array();
//            $paramMap['amount'] = $amount;
//            $paramMap['emailAddress'] = $emailAddress;
//            $paramMap['expiryDate'] = $expiryDate;
//            $paramMap['mobileNum'] = $mobileNum;
//            $paramMap['orderRefNum'] = $orderRefNum;
//            $paramMap['paymentMethod'] = $paymentMethod;
//            $paramMap['postBackURL'] = $postBackURL;
//            $paramMap['storeId'] = $storeId;
//            $paramMap['timeStamp'] = $currentTime;
//            $mapString = '';
//            foreach ($paramMap as $key => $val) {
//                $mapString .= $key . '=' . $val . '&';
//            }
//            $mapString = substr($mapString, 0, -1);
//            $cipher = "aes-128-ecb";
//            $crypttext = openssl_encrypt($mapString, $cipher, $hashKey, OPENSSL_RAW_DATA);
//            $hashRequest = base64_encode($crypttext);
//            $paramMap['hashRequest'] = $hashRequest;
//            $paymentParameter[$appointment['id']] = $paramMap;
//        }

        return view('patient.appointment.index', ['appointments' => $appointments, 'title' => 'Appointments']);
    }

    // create new appointment
    public function create()
    {
        $practitioners = Practitioner::where('status', 1)
            ->get();

        return view('patient.appointment.create', ['practitioners' => $practitioners, 'title' => 'Create Appointment']);
    }

    // store new Appointment
    public function store(Request $request)
    {
        $patient = Patient::find(Auth::guard('patient')->user()->id);
        // return $request->all();
        $rules = [
            'practitioner_id' => 'required',
            'clinic_id' => 'required',
            'date' => 'required',
            'time_slot' => 'required',
            'type' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Practitioner::find($request->practitioner_id);

        // $clinic = Clinic::find($request->clinic_id);

        // $practitionerClinic = PractitionerClinics::where('clinic_id', $clinic->id)
        // ->first();

        $patientAppointmentExist = Appointment::where('patient_id', $patient->id)
            ->where('date', Carbon::parse($request->date)->format('Y-m-d'))
            ->where('time_slot', $request->time_slot)
            ->whereNotIn('status', [2, 4])
            ->first();

        if (!empty($patientAppointmentExist)) {
            return Redirect::back()->with('error-message', 'Patient already have meeting with someone on selected Date and Time.');
        }

        $practitionerAppointmentExist = Appointment::where('practitioner_id', $practitioner->id)
            ->where('date', Carbon::parse($request->date)->format('Y-m-d'))
            ->where('time_slot', $request->time_slot)
            ->whereNotIn('status', [2, 4])
            ->first();

        if (!empty($practitionerAppointmentExist)) {
            return Redirect::back()->with('error-message', 'Practitioner already have meeting with someone on selected Date and Time.');
        }

        // if($request->type == 0){
        //     $price = $practitionerClinic->physical_fee;
        // }
        // else{
        //     $price = $practitionerClinic->online_fee;
        // }

        // session_start();
        // $transaction_id = str_random(8);


        // $_SESSION['patient_id'] = $patient->id;
        // $_SESSION['patient_name'] = $patient->name;
        // $_SESSION['patient_email'] = $patient->email;
        // $_SESSION['patient_phone'] = $patient->phone;

        // $_SESSION['practitioner_id'] = $practitioner->id;
        // $_SESSION['practitioner_name'] = $practitioner->name;
        // $_SESSION['practitioner_email'] = $practitioner->email;
        // $_SESSION['practitioner_phone'] = $practitioner->phone;

        // $_SESSION['clinic_id'] = $clinic->id;
        // $_SESSION['clinic_name'] = $clinic->name;

        // $_SESSION['time_slot'] =  $request->time_slot;
        // $_SESSION['date'] =  Carbon::parse($request->date)->format('Y-m-d');
        // $_SESSION['type'] =  $request->type;
        // $_SESSION['status'] =  0;
        // $_SESSION['price'] =  $price;
        // $_SESSION['transactionId'] = $transaction_id;

        // date_default_timezone_set("Asia/karachi");


        // $MerchantID = "MC21002"; //Your Merchant from transaction Credentials
        // $Password = "830y2s5y32"; //Your Password from transaction Credentials
        // $ReturnURL = "http://airizo.com/demo/tesjo/responseJazzCash.php"; //Your Return URL
        // $HashKey = "0c051h646w";//Your HashKey integrity salt from transaction Credentials
        // $PostURL = "https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform";

        // $Amount = $price."00"; //Last two digits will be considered as Decimal
        // $BillReference = $transaction_id;
        // $Description = "Thankyou for using Jazz Cash";
        // $Language = "EN";
        // $TxnCurrency = "PKR";
        // $TxnDateTime = date('YmdHis') ;
        // $TxnExpiryDateTime = "";
        // $TxnRefNumber = $transaction_id;
        // $TxnType = "MWALLET";
        // $Version = '1.1';
        // $SubMerchantID = "";
        // $DiscountedAmount = "";
        // $DiscountedBank = "";
        // $ppmpf_1="Web";
        // $ppmpf_2="";
        // $ppmpf_3="";
        // $ppmpf_4="";
        // $ppmpf_5="";

        // $HashArray=[$Amount,$BillReference,$Description,$DiscountedAmount,$DiscountedBank,$Language,$MerchantID,$Password,$ReturnURL,$TxnCurrency,$TxnDateTime,$TxnExpiryDateTime,$TxnRefNumber,$TxnType,$Version,$ppmpf_1,$ppmpf_2,$ppmpf_3,$ppmpf_4,$ppmpf_5];

        // $SortedArray=$HashKey;

        // for ($i = 0; $i < count($HashArray); $i++) {
        //     if ($HashArray[$i] != 'undefined' and $HashArray[$i]!= null and $HashArray[$i]!="") {
        //         $SortedArray .="&".$HashArray[$i];
        //     }
        // }

        // $Securehash = hash_hmac('sha256', $SortedArray, $HashKey);
        // $finalData = array();

        // $finalData = [
        //     'pp_Version' => $Version,
        //     'pp_TxnType' => $TxnType,
        //     'pp_Language' => $Language,
        //     'pp_MerchantID' => $MerchantID,
        //     'pp_SubMerchantID' => $SubMerchantID,
        //     'pp_Password' => $Password,
        //     'pp_TxnRefNo' => $TxnRefNumber,
        //     'pp_Amount' => $Amount,
        //     'pp_TxnCurrency' => $TxnCurrency,
        //     'pp_TxnDateTime' => $TxnDateTime,
        //     'pp_BillReference' => $BillReference,
        //     'pp_Description' => $Description,
        //     'pp_DiscountedAmount' => $DiscountedAmount,
        //     'pp_DiscountBank' => $DiscountedBank,
        //     'pp_TxnExpiryDateTime' => $TxnExpiryDateTime,
        //     'pp_ReturnURL' => $ReturnURL,
        //     'pp_SecureHash' => $Securehash,
        //     'ppmpf_1' => $ppmpf_1,
        //     'ppmpf_2' => $ppmpf_2,
        //     'ppmpf_3' => $ppmpf_3,
        //     'ppmpf_4' => $ppmpf_4,
        //     'ppmpf_5' => $ppmpf_5,
        // ];

        // Get meeting join URL for a practitioner.
        $practitioner_name = $practitioner->name;
        // Get meeting join URL for an patient:
        $patient_name = $patient->name;

        $practitioner_url = null;
        $patient_url = null;
        $otp = mt_rand(100000, 999999);

        $appointmentData = [
            'patient_id' => $patient->id,
            'practitioner_id' => $request->practitioner_id,
            'clinic_id' => $request->clinic_id,
            'time_slot' => $request->time_slot,
            'patient_type_id' => $patient->patient_type_id,
            'practitioner_url' => $practitioner_url,
            'patient_url' => $patient_url,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'type' => $request->type,
            'status' => 0,
            'otp' => $otp
        ];

        $appointment = Appointment::create($appointmentData);
        if ($request->fee != null && $request->payment_method != null) {
            $payment = Payment::where('appointment_id', $appointment->id)->first();
            if ($payment == null) {
                $randomNumber = rand(10000000, 99999999);

                $paymentData = [
                    'patient_id' => $appointment->patient_id,
                    'practitioner_id' => $appointment->practitioner_id,
                    'appointment_id' => $appointment->id,
                    'transaction_id' => $randomNumber,
                    'date' => \Illuminate\Support\Carbon::now()->format('Y-m-d H:i:s'),
                    'amount' => $request->fee,
                    'payment_method' => $request->payment_method,
                    'payment_status' => 'Unpaid',
                ];

                Payment::create($paymentData);
            } else {
                $paymentData = [
                    'amount' => $request->fee,
                    'payment_method' => $request->payment_method,
                    'payment_status' => 'Unpaid',
                ];

                $payment->update($paymentData);
            }
        }
        $phone = str_replace('-', '', $appointment->patient->phone);
        $phone = substr($phone, 1);
        $phone = '92' . $phone;
        $doctor = str_replace(' ', '', $appointment->practitioner->name);
        $time = str_replace(' ', '', $appointment->time_slot);
        $link = route('joinAppointment', ['patientId' => $appointment->patient->id, 'practitionerId' => $appointment->practitioner->id, 'appointmentId' => $appointment->id]);
        if ($appointment->type == 1) {
            if ($appointment->payment->payment_status == "Unpaid") {
                $message = 'Your%20online%20appointment%20is%20booked%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Your%20One%20Time%20Password%20For%20Appointment%20is%20' . $otp . '%20Your%20video%20call%20link%20is%0a' . $link;
            } else {
                $message = 'Your%20online%20appointment%20is%20booked%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Please%20pay%20your%20payment%20form%20your%20portal.';
            }
        } else {
            $message = 'Your%20appointment%20is%20booked%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').';
        }

        $curl = curl_init();
        $curlSet = curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.bizsms.pk/api-send-branded-sms.aspx?username=eonhc@bizsms.pk&pass=e3th3rt9&text=" . $message . "&masking=SMS%20Alert&destinationnum=" . $phone . "&language=English",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ));
        $response = curl_exec($curl);
        curl_close($curl);

        // $data = array(
        //     'practitioner_name' => $practitioner->name,
        //     'patient_name' => $patient->name,
        //     'practitioner_email' => $practitioner->email,
        //     'patient_email' => $patient->email,
        //     'patient_phone' => $patient->phone,
        //     'date' => $appointment->date,
        //     'time_slot' => $appointment->time_slot,
        //     'type' => $appointment->type,
        //     'status' => $appointment->status,
        // );

        // try{
        //     Mail::send('patient.mails.meeting', ["data" => $data], function ($message) use ($data) {
        //         $message->to($data['practitioner_email'])->subject("Meeting Request");
        //     });
        // } catch (\Exception $e) {

        // }

        // $historyData = [
        //     'patient_id' => $patient->id,
        //     'practitioner_id' => $appointment->practitioner_id,
        //     'clinic_id' => $appointment->clinic_id,
        // ];

        // $history = History::create($historyData);

         $notificationData = [
             'user_type' => 1,
             'user_id' =>  $patient->id,
             'is_read' => 0,
             'title' => 'Appointment Request Sent.',
             'message' => 'Please check out appointment list requested for '. $practitioner->email
         ];

         $notification = Notification::create($notificationData);

        // $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        // event(new Notify($notification->id, $notification->title, $notification->message, $currentTime ,$notification->user_type, $notification->user_id));

         $notificationData1 = [
             'user_type' => 2,
             'user_id' =>  $appointment->practitioner_id,
             'is_read' => 0,
             'title' => 'Patient Requested Appointment.',
             'message' => 'Please check out appointment list requested by '. $patient->email
         ];

         $notification = Notification::create($notificationData1);

        // $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        // event(new Notify($notification->id, $notification->title, $notification->message, $currentTime ,$notification->user_type, $notification->user_id));


        // $appointmentInfo = [
        //     'patient_name' => $patient->name,
        //     'practitioner_name' => $practitioner->name,
        //     'clinic_name' => $clinic->name,
        //     'date' => Carbon::parse($request->date)->format('l M d Y'),
        //     'time_slot' => $request->time_slot,
        //     'type' => $request->type,
        //     'amount' => $price,
        // ];

        return redirect()->route('patientAppointmentList')->with('success-message', 'Appointment Booked Successfully.');

        // return view('patient.payment.create', ['appointmentInfo' => $appointmentInfo, 'PostURL' => $PostURL, 'finalData' => $finalData]);

        // return redirect()->route('patientAppointmentList')->with('success-message', 'Record Added Successfully.');
    }

    //edit Appointment
    public function edit($id)
    {
        $appointment = Appointment::find($id);

        $practitioners = Practitioner::where('status', 1)
            ->get();


        $practitioner = Practitioner::find($appointment->practitioner_id);

        $clinics = $practitioner->getClinics;

        $practitionerClinic = PractitionerClinics::where('practitioner_id', $practitioner->id)
            ->where('clinic_id', $appointment->clinic_id)
            ->first();

        $timeIn = Carbon::parse($practitionerClinic->from_time);

        $timeOut = Carbon::parse($practitionerClinic->to_time);


        $interval = new DateInterval('PT15M');

        $time_slots = array();

        $period = new DatePeriod($timeIn, $interval, $timeOut);

        $existingSlots = Appointment::where('id', '!=', $appointment->id)
            ->where('practitioner_id', $appointment->practitioner_id)
            ->where('clinic_id', $appointment->clinic_id)
            ->where('date', $appointment->date)
            ->where('status', '!=', 4)
            ->get()
            ->pluck('time_slot')
            ->toArray();


        foreach ($period as $time) {

            $timeslot = $time->format('h:i a');

            if (!in_array($timeslot, $existingSlots, true)) {
                $time_slots[] = array('key' => $timeslot, 'value' => $timeslot);
            }
        }


        return view('patient.appointment.edit', ['title' => 'Edit Appointment', 'appointment' => $appointment, 'practitioners' => $practitioners, 'clinics' => $clinics, 'time_slots' => $time_slots]);
    }

    // udpate Appointment
    public function update(Request $request)
    {

        $appointment = Appointment::where('id', $request->appointment_id)
            ->first();

        $rules = [
            'practitioner_id' => 'required',
            'clinic_id' => 'required',
            'date' => 'required',
            'time_slot' => 'required',
            'type' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $appointmentData = [
            'practitioner_id' => $request->practitioner_id,
            'clinic_id' => $request->clinic_id,
            'time_slot' => $request->time_slot,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'type' => $request->type,
        ];

        $appointment->update($appointmentData);

        return redirect()->route('patientAppointmentList')->with('success-message', 'Record Updated Successfully.');
    }

    // Get list of clinics by practitioner id for dropdowns
    public function getClinics(Request $request)
    {
        $practitioner = Practitioner::find($request->practitioner_id);

        $clinics = $practitioner->getClinics;

        return ['clinics' => $clinics];
    }

    // Get time slots
    public function getTimeSlots(Request $request)
    {
        if (
            empty($request->selected_date) ||
            empty($request->practitioner_id) ||
            empty($request->clinic_id)
        ) {
            return ['status' => 0, 'error' => 'Date / Practitioner / Clinic must be selected.'];
        }

        try {
            $selected_date = Carbon::parse($request->selected_date)->format('Y-m-d');
        } catch (Exception $err) {
            return ['status' => 0, 'error' => 'Date format is invalid'];
        }

        $day = strtolower(date('l', strtotime($selected_date)));

        $practitionerClinic = PractitionerClinics::where('practitioner_id', $request->practitioner_id)
            ->where('clinic_id', $request->clinic_id)
            ->first();

        $practitionerClinicDays = PractitionerClinicDay::where('practitioner_clinic_id', $practitionerClinic->id)
            ->get()
            ->pluck('day')
            ->toArray();

        if (!in_array($day, $practitionerClinicDays, true)) {
            return ['status' => 0, 'error' => 'Practitioner is not available in this clinic on your selected date.'];
        }

        $timeIn = Carbon::parse($practitionerClinic->from_time);

        $timeOut = Carbon::parse($practitionerClinic->to_time);

        $interval = new DateInterval('PT10M');

        $time_slots = array();

        $period = new DatePeriod($timeIn, $interval, $timeOut);

        if ($request->appointment_id == 0) {
            $existingSlots = Appointment::where('practitioner_id', $request->practitioner_id)
                ->where('clinic_id', $request->clinic_id)
                ->where('date', $selected_date)
                ->where('status', '!=', 4)
                ->get()
                ->pluck('time_slot')
                ->toArray();
        } else {
            $existingSlots = Appointment::where('id', '!=', (int)($request->appointment_id))
                ->where('practitioner_id', $request->practitioner_id)
                ->where('clinic_id', $request->clinic_id)
                ->where('date', $selected_date)
                ->where('status', '!=', 4)
                ->get()
                ->pluck('time_slot')
                ->toArray();
        }

        $currentDate = date('d-m-Y', strtotime(Carbon::now()));
        $currentTime = date('H:i:s', strtotime(Carbon::now()));
        $selectedDate = date('d-m-Y', strtotime($request->selected_date));

        foreach ($period as $time) {
            if ($currentDate == $selectedDate) {
                if ($time->format('H:i:s') > $currentTime) {
                    $timeslot = $time->format('h:i a');

                    if (!in_array($timeslot, $existingSlots, true)) {
                        $time_slots[] = array('key' => $timeslot, 'value' => $timeslot);
                    }
                }
            } else {
                $timeslot = $time->format('h:i a');
                if (!in_array($timeslot, $existingSlots, true)) {
                    $time_slots[] = array('key' => $timeslot, 'value' => $timeslot);
                }
            }
        }

        return ['status' => 1, 'time_slots' => $time_slots];

    }

    public function submitPayment($id)
    {
        $patient = Patient::find(Auth::guard('patient')->user()->id);
        $appointment = Appointment::find($id);
        if ($appointment) {
            $currentTime = Carbon::now()->timezone('Asia/Karachi')->format('Y-m-d\TH:i:s');
            $emailAddress = $patient->email;
            $mobileNum = str_replace('-', '', $patient->phone);
            $storeId = env('EASYPIASA_STORE_ID');
            $paymentMethod = 'InitialRequest';
            $postBackURL = route('backPayment');
            $orderRefNum = (string)$appointment->id;
            $expiryDate = Carbon::parse($appointment->date)->addDay()->format('Ymd Hms');
            $amount = $appointment->payment->amount;
            $hashKey = env('EASYPIASA_HASH_KEY');
            $paramMap = array();
            $paramMap['amount'] = $amount;
            $paramMap['emailAddress'] = $emailAddress;
            $paramMap['expiryDate'] = $expiryDate;
            $paramMap['mobileNum'] = $mobileNum;
            $paramMap['orderRefNum'] = $orderRefNum;
            $paramMap['paymentMethod'] = $paymentMethod;
            $paramMap['postBackURL'] = $postBackURL;
            $paramMap['storeId'] = $storeId;
            $paramMap['timeStamp'] = $currentTime;
            $mapString = '';
            foreach ($paramMap as $key => $val) {
                $mapString .= $key . '=' . $val . '&';
            }
            $mapString = substr($mapString, 0, -1);
            $cipher = "aes-128-ecb";
            $crypttext = openssl_encrypt($mapString, $cipher, $hashKey, OPENSSL_RAW_DATA);
            $hashRequest = base64_encode($crypttext);
            $storeIdUrl = urlencode($storeId);
            $orderRefNumUrl = urlencode($orderRefNum);
            $amountUrl = urlencode($amount);
            $mobileNumUrl = urlencode($mobileNum);
            $emailAddressUrl = urlencode($emailAddress);
            $paymentMethodUrl = urlencode($paymentMethod);
            $expiryDateUrl = urlencode($expiryDate);
            $postBackURLUrl = urlencode($postBackURL);
            $hashRequestUrl = urlencode($hashRequest);
            $sampleUrl = "storeId=" . $storeIdUrl . "&orderId=" . $orderRefNumUrl . "&transactionAmount=" . $amountUrl . "&mobileAccountNo=" . $mobileNumUrl . "&emailAddress=" . $emailAddressUrl . "&transactionType=" . $paymentMethodUrl . "&tokenExpiry=" . $expiryDateUrl . "&bankIdentificationNumber=&merchantPaymentMethod=&postBackURL=" . $postBackURLUrl . "&signature=&encryptedHashRequest=" . $hashRequestUrl;
            $url = "https://easypay.easypaisa.com.pk/tpg/?" . $sampleUrl;
            return Redirect::to($url);
        } else {
            return redirect()->route('patientAppointmentList')->with('error-message', 'No Appointment Found.');

        }
    }

    public function backPayment(Request $request)
    {
        if ($request->status == '0001') {
            return redirect()->route('patientAppointmentList')->with('success-message', 'Your Payment Not Submitted.');
        }
        if ($request->status == '0032') {
            return redirect()->route('patientAppointmentList')->with('success-message', 'Sorry, your payment has failed. Please try again');
        }

        if ($request->status == "0000") {
            $appointment = Appointment::where('id', $request->orderRefNumber)->with('payment')->first();

            $payment = Payment::find($appointment->payment->id);

            if ($payment) {
                $payment->update([
                    'payment_status' => 'Paid',
                    'transaction_ref_number' => $request->transactionRefNumber,
                ]);
            }
            $otp = $appointment->otp;
            $phone = str_replace('-', '', $appointment->patient->phone);
            $phone = substr($phone, 1);
            $phone = '92' . $phone;
            $doctor = str_replace(' ', '', $appointment->practitioner->name);
            $time = str_replace(' ', '', $appointment->time_slot);
            $link = route('joinAppointment', ['patientId' => $appointment->patient->id, 'practitionerId' => $appointment->practitioner->id, 'appointmentId' => $appointment->id]);
            $message = 'Your%20Have%20Submitted%20Payment%20Successfully%20Your%20Appointment%20is%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Your%20One%20Time%20Password%20For%20Appointment%20is%20' . $otp . '%20Your%20video%20call%20link%20is%0a' . $link;


            $curl = curl_init();


            $curlSet = curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.bizsms.pk/api-send-branded-sms.aspx?username=eonhc@bizsms.pk&pass=e3th3rt9&text=" . $message . "&masking=SMS%20Alert&destinationnum=" . $phone . "&language=English",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",

            ));
            $response = curl_exec($curl);
            curl_close($curl);

            return redirect()->route('patientAppointmentList')->with('success-message', 'You Have Submitted Payment Successfully.');
        } else {
            return redirect()->route('patientAppointmentList')->with('success-message', 'Sorry, your payment has failed. Please try again');

        }
    }

    public function getPractitionerPatientFee(Request $request)
    {
        if (empty($request->clinic_id)) {
            return ['status' => 0, 'error' => 'Clinic must be Selected First.'];
        }
        $patient = Patient::find(Auth::guard('patient')->user()->id);

        $today = \Illuminate\Support\Carbon::now()->format('Y-m-d');
        $patientType = PatientType::select('discount_percentage')->where('id', $patient->patient_type_id)->where('status', 1)->first();

        if ($patientType != null) {
            $patientTypeDiscountPercentage = $patientType->discount_percentage;

            if ($request->type == 0) {
                $practitionerClinicFee = PractitionerClinics::select('physical_fee')->where('practitioner_id', $request->practitioner_id)->where('clinic_id', $request->clinic_id)->first();

                $practitionerClinicPhysicalFee = $practitionerClinicFee->physical_fee;
                $practitionerClinicFinalPhysicalFee = ($patientTypeDiscountPercentage / 100) * $practitionerClinicPhysicalFee;
                $fee = $practitionerClinicFee->physical_fee - $practitionerClinicFinalPhysicalFee;
            } else {
                $practitionerClinicFee = PractitionerClinics::select('online_fee')->where('practitioner_id', $request->practitioner_id)->where('clinic_id', $request->clinic_id)->first();

                $practitionerClinicOnlineFee = $practitionerClinicFee->online_fee;
                $practitionerClinicFinalOnlineFee = ($patientTypeDiscountPercentage / 100) * $practitionerClinicOnlineFee;
                $fee = $practitionerClinicFee->online_fee - $practitionerClinicFinalOnlineFee;
            }
        }
        return ['status' => 1, 'fee' => $fee];
    }
}

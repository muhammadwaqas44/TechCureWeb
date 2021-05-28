<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\PatientType;
use App\Models\Payment;
use App\Models\Practitioner;
use App\Models\PractitionerClinicDay;
use App\Models\PractitionerClinics;
use App\Services\FCMServices;
use Config;
use DateInterval;
use DatePeriod;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use JWTAuth;
use Validator;

class AppointmentController extends Controller
{
    private $generalConstants;
    private $responseConstants;
    private $constants;
    private $recordsPerPage = 20;

    public function __construct()
    {
        $this->constants = Config::get('constants.APPOINTMENT_CONSTANTS');
        $this->generalConstants = Config::get('constants.GENERAL_CONSTANTS');
        $this->responseConstants = Config::get('constants.RESPONSE_CONSTANTS');
    }

    public function getAppointments(Request $request)
    {
        $response = [];
        $user = JWTAuth::toUser($request->token);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }
        $offset = 0;
        if ($request->filled($this->generalConstants['KEY_PAGE_NO'])) {
            $offset = $this->recordsPerPage * $request->get($this->generalConstants['KEY_PAGE_NO']);
        }
        $appointments = Appointment::orderBy('id', 'DESC')
            ->where('patient_id', $user->id)
            ->with(['patient' => function ($q) {
                $q->select('id', 'name');
            }, 'practitioner' => function ($q) {
                $q->select('id', 'name', 'agora_app_id', 'agora_app_token', 'agora_app_channel');
            }, 'payment' => function ($q) {
                $q->select('appointment_id', 'id', 'date', 'payment_type', 'amount', 'payment_method', 'payment_status');
            }, 'patientType' => function ($q) {
                $q->select('id', 'title');
            }])
            ->skip($offset)
            ->take($this->recordsPerPage)->get();

        $totalRecords = Appointment::where('patient_id', $user->id)->count();
        $totalPages = ceil($totalRecords / $this->recordsPerPage);
        $currentPage = (int)$request->get($this->generalConstants['KEY_PAGE_NO']);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['appointments'] = $appointments;
        $response['currentPage'] = $currentPage;
        $response['totalPages'] = $totalPages;
        return response()->json($response);
    }

    public function getClinics(Request $request)
    {
        $rules = [
            $this->constants['KEY_PRACTITIONER_ID'] => "required|integer",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        $practitioner = Practitioner::find($request->get($this->constants['KEY_PRACTITIONER_ID']));

        $clinics = $practitioner->getClinics;
        return response()->json([
            'status' => $this->responseConstants['STATUS_SUCCESS'],
            'message' => "Success",
            'clinics' => $clinics,
        ]);
    }

    public function getPractitionerFee(Request $request)
    {
        $rules = [
            $this->constants['KEY_PRACTITIONER_ID'] => "required|integer",
            $this->constants['KEY_CLINIC_ID'] => "required|integer",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        $today = \Illuminate\Support\Carbon::now()->format('Y-m-d');
        $patientType = PatientType::select('discount_percentage')->where('id', 3)->where('status', 1)->first();

        if ($patientType != null) {
            $patientTypeDiscountPercentage = $patientType->discount_percentage;

            if ($request->get($this->constants['KEY_APPOINTMENT_TYPE']) == 0) {
                $practitionerClinicFee = PractitionerClinics::select('physical_fee')->where('practitioner_id', $request->get($this->constants['KEY_PRACTITIONER_ID']))->where('clinic_id', $request->get($this->constants['KEY_CLINIC_ID']))->first();

                $practitionerClinicPhysicalFee = $practitionerClinicFee->physical_fee;
                $practitionerClinicFinalPhysicalFee = ($patientTypeDiscountPercentage / 100) * $practitionerClinicPhysicalFee;
                $fee = $practitionerClinicFee->physical_fee - $practitionerClinicFinalPhysicalFee;
            } else {
                $practitionerClinicFee = PractitionerClinics::select('online_fee')->where('practitioner_id', $request->get($this->constants['KEY_PRACTITIONER_ID']))->where('clinic_id', $request->get($this->constants['KEY_CLINIC_ID']))->first();

                $practitionerClinicOnlineFee = $practitionerClinicFee->online_fee;
                $practitionerClinicFinalOnlineFee = ($patientTypeDiscountPercentage / 100) * $practitionerClinicOnlineFee;
                $fee = $practitionerClinicFee->online_fee - $practitionerClinicFinalOnlineFee;
            }
        }

        return response()->json([
            'status' => $this->responseConstants['STATUS_SUCCESS'],
            'message' => "Success",
            'fee' => $fee,
        ]);
    }

    public function getTimeSlots(Request $request)
    {
        $rules = [
            $this->constants['KEY_PRACTITIONER_ID'] => "required|integer",
            $this->constants['KEY_CLINIC_ID'] => "required|integer",
            $this->constants['KEY_DATE'] => "required",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        try {
            $selected_date = \Carbon\Carbon::parse($request->selected_date)->format('Y-m-d');
        } catch (Exception $err) {
            return response()->json(['status' => 0, 'error' => 'Date format is invalid']);
        }

        $day = strtolower(date('l', strtotime($selected_date)));

        $practitionerClinic = PractitionerClinics::where('practitioner_id', $request->get($this->constants['KEY_PRACTITIONER_ID']))
            ->where('clinic_id', $request->get($this->constants['KEY_CLINIC_ID']))
            ->first();

        $practitionerClinicDays = PractitionerClinicDay::where('practitioner_clinic_id', $practitionerClinic->id)
            ->get()
            ->pluck('day')
            ->toArray();

        if (!in_array($day, $practitionerClinicDays, true)) {
            return response()->json(['status' => 0, 'error' => 'Practitioner is not available in this clinic on your selected date.']);
        }

        $timeIn = Carbon::parse($practitionerClinic->from_time);

        $timeOut = Carbon::parse($practitionerClinic->to_time);

        $interval = new DateInterval('PT10M');

        $time_slots = array();

        $period = new DatePeriod($timeIn, $interval, $timeOut);

        if ($request->appointment_id == 0) {
            $existingSlots = Appointment::where('practitioner_id', $request->get($this->constants['KEY_PRACTITIONER_ID']))
                ->where('clinic_id', $request->get($this->constants['KEY_CLINIC_ID']))
                ->where('date', $selected_date)
                ->where('status', '!=', 4)
                ->get()
                ->pluck('time_slot')
                ->toArray();
        } else {
            $existingSlots = Appointment::where('id', '!=', (int)($request->get($this->constants['KEY_APPOINTMENT_ID'])))
                ->where('practitioner_id', $request->get($this->constants['KEY_PRACTITIONER_ID']))
                ->where('clinic_id', $request->get($this->constants['KEY_CLINIC_ID']))
                ->where('date', $selected_date)
                ->where('status', '!=', 4)
                ->get()
                ->pluck('time_slot')
                ->toArray();
        }

        $currentDate = date('d-m-Y', strtotime(Carbon::now()));
        $currentTime = date('H:i:s', strtotime(Carbon::now()));
        $selectedDate = date('d-m-Y', strtotime($request->get($this->constants['KEY_DATE'])));

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

        return response()->json([
            'status' => $this->responseConstants['STATUS_SUCCESS'],
            'message' => "Success",
            'time_slots' => $time_slots
        ]);
    }

    public function createAppointment(Request $request)
    {
        $response = [];
        $rules = [
            $this->constants['KEY_PRACTITIONER_ID'] => "required|integer",
            $this->constants['KEY_CLINIC_ID'] => "required|integer",
            $this->constants['KEY_DATE'] => "required|date|after_or_equal:" . Date('Y-m-d'),
            $this->constants['KEY_APPOINTMENT_TYPE'] => "required",
            $this->constants['KEY_TIME_SLOT'] => "required",
            $this->constants['KEY_FEE'] => "required",
            $this->constants['KEY_PAYMENT_METHOD'] => "required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }
        $patient = JWTAuth::toUser($request->token);

        $patientStatus = $patient->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        $practitioner = Practitioner::find($request->get($this->constants['KEY_PRACTITIONER_ID']));

        $patientAppointmentExist = Appointment::where('patient_id', $patient->id)
            ->where('date', \Carbon\Carbon::parse($request->get($this->constants['KEY_DATE']))->format('Y-m-d'))
            ->where('time_slot', $request->get($this->constants['KEY_TIME_SLOT']))
            ->whereNotIn('status', [2, 4])
            ->first();

        if (!empty($patientAppointmentExist)) {
            return response()->json(['status' => 0, 'message' => 'Patient already have meeting with someone on selected Date and Time.']);
        }

        $practitionerAppointmentExist = Appointment::where('practitioner_id', $practitioner->id)
            ->where('date', Carbon::parse($request->get($this->constants['KEY_DATE']))->format('Y-m-d'))
            ->where('time_slot', $request->get($this->constants['KEY_TIME_SLOT']))
            ->whereNotIn('status', [2, 4])
            ->first();

        if (!empty($practitionerAppointmentExist)) {
            return response()->json(['status' => 0, 'message' => 'Practitioner already have meeting with someone on selected Date and Time.']);
        }

        $practitioner_name = $practitioner->name;
        $patient_name = $patient->name;

        $practitioner_url = null;
        $patient_url = null;
        $otp = mt_rand(100000, 999999);

        $appointmentData = [
            'patient_id' => $patient->id,
            'practitioner_id' => $request->get($this->constants['KEY_PRACTITIONER_ID']),
            'clinic_id' => $request->get($this->constants['KEY_CLINIC_ID']),
            'time_slot' => $request->get($this->constants['KEY_TIME_SLOT']),
            'patient_type_id' => 3,
            'practitioner_url' => $practitioner_url,
            'patient_url' => $patient_url,
            'date' => Carbon::parse($request->get($this->constants['KEY_DATE']))->format('Y-m-d'),
            'type' => $request->get($this->constants['KEY_APPOINTMENT_TYPE']),
            'status' => 0,
            'otp' => $otp
        ];

        $appointment = Appointment::create($appointmentData);
        if ($request->get($this->constants['KEY_FEE']) != null && $request->get($this->constants['KEY_PAYMENT_METHOD']) != null) {
            $payment = Payment::where('appointment_id', $appointment->id)->first();
            if ($payment == null) {
                $randomNumber = rand(10000000, 99999999);

                $paymentData = [
                    'patient_id' => $appointment->patient_id,
                    'practitioner_id' => $appointment->practitioner_id,
                    'appointment_id' => $appointment->id,
                    'transaction_id' => $randomNumber,
                    'date' => \Illuminate\Support\Carbon::now()->format('Y-m-d H:i:s'),
                    'amount' => $request->get($this->constants['KEY_FEE']),
                    'payment_method' => $request->get($this->constants['KEY_PAYMENT_METHOD']),
                    'payment_status' => 'Unpaid',
                ];

                Payment::create($paymentData);
            } else {
                $paymentData = [
                    'amount' => $request->get($this->constants['KEY_FEE']),
                    'payment_method' => $request->get($this->constants['KEY_PAYMENT_METHOD']),
                    'payment_status' => 'Unpaid',
                ];

                $payment->update($paymentData);
            }
        }

        if (isset($patient->token)) {
            $title = 'Appointment Booked Successfully.';
            $payloadBody = $patient->name . ' your appointment has been booked successfully. Your appointment time is ' . $appointment->time_slot . ' on this date ' . date('D d M Y', strtotime($appointment->date)) . '.';
            $additionalData = [];
            $token = $patient->token;
            $fcmNotification = new FCMServices();
            $fcmNotification->sendNotification($title, $payloadBody, $additionalData, $token);
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
        $response1 = curl_exec($curl);
        curl_close($curl);

         $notificationData = [
             'user_type' => 1,
             'user_id' =>  $patient->id,
             'is_read' => 0,
             'title' => 'Appointment Request Sent.',
             'message' => 'Please check out appointment list requested for '. $practitioner->email
         ];

         $notification = Notification::create($notificationData);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Appointment Booked Successfully.";

        return response()->json($response);
    }

    public function editAppointment(Request $request)
    {
        $response = [];
        $rules = [
            $this->constants['KEY_APPOINTMENT_ID'] => "required|integer",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }
        $appointment = Appointment::find($request->get($this->constants['KEY_APPOINTMENT_ID']));

        $practitioners = Practitioner::where('status', 1)
            ->get();


        $practitioner = Practitioner::find($appointment->practitioner_id);

        $clinics = $practitioner->getClinics;

        $practitionerClinic = PractitionerClinics::where('practitioner_id', $practitioner->id)
            ->where('clinic_id', $appointment->clinic_id)
            ->first();

        $timeIn = \Carbon\Carbon::parse($practitionerClinic->from_time);

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

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['appointment'] = $appointment;
        $response['practitioners'] = $practitioners;
        $response['clinics'] = $clinics;
        $response['time_slots'] = $time_slots;

        return response()->json($response);
    }

    public function updateAppointment(Request $request)
    {

        $appointment = Appointment::where('id', $request->get($this->constants['KEY_APPOINTMENT_ID']))
            ->first();
        $rules = [
            $this->constants['KEY_PRACTITIONER_ID'] => "required|integer",
            $this->constants['KEY_CLINIC_ID'] => "required|integer",
            $this->constants['KEY_DATE'] => "required|date|after_or_equal:" . Date('Y-m-d'),
            $this->constants['KEY_APPOINTMENT_TYPE'] => "required",
            $this->constants['KEY_TIME_SLOT'] => "required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }
        $appointmentData = [
            'practitioner_id' => $request->get($this->constants['KEY_PRACTITIONER_ID']),
            'clinic_id' => $request->get($this->constants['KEY_CLINIC_ID']),
            'time_slot' => $request->get($this->constants['KEY_TIME_SLOT']),
            'date' => Carbon::parse($request->get($this->constants['KEY_DATE']))->format('Y-m-d'),
            'type' => $request->get($this->constants['KEY_APPOINTMENT_TYPE']),
        ];

        $appointment->update($appointmentData);
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Appointment Updated Successfully.";
        return response()->json($response);
    }

}

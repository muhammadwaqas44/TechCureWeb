<?php

namespace App\Http\Controllers\Assistant;

use App\Events\Notify;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Assistant;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientType;
use App\Models\Payment;
use App\Models\Practitioner;
use App\Models\PractitionerClinicDay;
use App\Models\PractitionerClinics;
use DateInterval;
use DatePeriod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class AppointmentController extends Controller
{

    // show list of today appointments
    public function todayAppointment()
    {
        $today = Carbon::now()->format('Y-m-d');
        $id = Auth::guard('assistant')->user()->id;

        $assistant = Assistant::find($id);

        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');

        $appointments = Appointment::where('practitioner_id', $practitionersID)
            ->where('date', $today)
            ->whereNotIn('status', [2, 4])
            ->orderBy('id', 'DESC')
            ->get();

        return view('assistant.appointment.index', ['appointments' => $appointments, 'title' => 'Appointments']);
    }

    // show list of today Open appointments
    public function todayOpenAppointment()
    {
        $today = Carbon::now()->format('Y-m-d');
        $id = Auth::guard('assistant')->user()->id;

        $assistant = Assistant::find($id);

        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');

        $appointments = Appointment::whereIn('practitioner_id', $practitionersID)
            ->where('date', $today)
            ->where('status', 3)
            ->orderBy('id', 'DESC')
            ->get();

        return view('assistant.appointment.index', ['appointments' => $appointments, 'title' => 'Appointments']);
    }

    // show list today  Closed appointments
    public function todayClosedAppointment()
    {
        $today = Carbon::now()->format('Y-m-d');
        $id = Auth::guard('assistant')->user()->id;

        $assistant = Assistant::find($id);

        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');

        $appointments = Appointment::where('practitioner_id', $practitionersID)
            ->where('date', $today)
            ->where('status', 4)
            ->orderBy('id', 'DESC')
            ->get();

        return view('assistant.appointment.index', ['appointments' => $appointments, 'title' => 'Appointments']);
    }

    // function compare($a, $b)
    // {
    //     $aDateTime = new DateTime($a[0]['time_slot']);
    //     $bDateTime = new DateTime($b[0]['time_slot']);
    //     return $aDateTime > $bDateTime ? 1 : -1;
    // }

    // show list of all appointments
    public function index(Request $request)
    {
        // dd($request->all());
        $todayOnly = Carbon::now()->format('Y-m-d');

        $id = Auth::guard('assistant')->user()->id;

        $assistant = Assistant::find($id);

        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');

        if (empty($request->search_date) && empty($request->status) && empty($request->payment)) {
            $appointments = Appointment::whereIn('practitioner_id', $practitionersID)->where('date', $todayOnly)
                ->orderBy('date', 'DESC');
        } else {
            $appointments = Appointment::whereIn('practitioner_id', $practitionersID)
                ->orderBy('date', 'DESC');
        }

        // $appointments = Appointment::where('practitioner_id', Auth::guard('practitioner')->user()->id)
        //     ->orderBy('date', 'DESC')->orderBy('time_slot', 'DESC');

        if (!empty($request->search_date)) {
            $date = Carbon::parse($request->search_date)->format('y-m-d');
            $appointments = $appointments->whereDate('date', $date);
        }

        // if (!empty($request->status) && $request->status == 5) {
        //     $appointments = $appointments->where('status', 0);
        // }
        if (!empty($request->status) && $request->status == 1) {
            $appointments = $appointments->where('status', 1);
        }
        if (!empty($request->status) && $request->status == 2) {
            $appointments = $appointments->where('status', 2);
        }
        if (!empty($request->status) && $request->status == 3) {
            $appointments = $appointments->where('status', 3);
        }
        if (!empty($request->status) && $request->status == 4) {
            $appointments = $appointments->where('status', 4);
        }

        if (!empty($request->status) && $request->status == 5) {
            $appointments = $appointments->where('status', 5);
        }

        if (!empty($request->payment) && $request->payment == 1) {
            $appointments = $appointments->whereHas('paymentPaid');
        }

        $appointments = $appointments->with('patient', 'patientVisits')->get();
        $appointments = $appointments->toArray();

        usort($appointments, function ($first, $second) {
            return (strtotime($first['date'] . ' ' . $first['time_slot']) > strtotime($second['date'] . ' ' . $second['time_slot']));
        });

        $appointmentsCount = Appointment::whereIn('practitioner_id', $practitionersID)->count();
        $completedCount = Appointment::where('status', 5)->whereIn('practitioner_id', $practitionersID)->count();

        return view('assistant.appointment.index', ['appointments' => $appointments, 'title' => 'Appointments', 'appointmentsCount' => $appointmentsCount, 'completedCount' => $completedCount]);
    }

    //check patient check in status
    public function checkPatientStatus()
    {
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $practitioners = Practitioner::whereIn('id', $practitionersID)->get();
        $appointments = Appointment::whereIn('practitioner_id', $practitionersID)->get();
        return ['status' => 1, 'appointments' => $appointments];
    }

    // create new appointment
    public function create()
    {
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $practitioners = Practitioner::whereIn('id', $practitionersID)->get();

//        $clinics = $practitioner->getClinics;

        $patients = Patient::where('status', 1)->get();

        $patientTypes = PatientType::where('status', 1)->get();

        return view('assistant.appointment.create', ['patients' => $patients, 'patientTypes' => $patientTypes, 'title' => 'Create Appointment', 'practitioners' => $practitioners]);
    }


    // store new Appointment
    public function store(Request $request)
    {
        $id = Auth::guard('assistant')->user()->id;
        $practitioner = Practitioner::find($request->practitioner_id);
        // return $request->all();
        $rules = [
            'patient_id' => 'required',
            'patient_type_id' => 'required',
            'clinic_id' => 'required',
            'date' => 'required',
            'time_slot' => 'required',
            'type' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $patient = Patient::find($request->patient_id);

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
        $otp = mt_rand(100000, 999999);

        $appointmentData = [
            'patient_id' => $request->patient_id,
            'patient_type_id' => $request->patient_type_id,
            'practitioner_id' => $practitioner->id,
            'assistant_id' => $id,
            'clinic_id' => $request->clinic_id,
            'time_slot' => $request->time_slot,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'type' => $request->type,
            'status' => $request->status,
            'otp' => 123456
        ];

        $appointment = Appointment::create($appointmentData);
        if ($request->fee != null && $request->payment_method != null && $request->payment_status != null) {
            $payment = Payment::where('appointment_id', $appointment->id)->first();
            if ($payment == null) {
                $randomNumber = rand(10000000, 99999999);

                $paymentData = [
                    'patient_id' => $appointment->patient_id,
                    'practitioner_id' => $appointment->practitioner_id,
                    'appointment_id' => $appointment->id,
                    'transaction_id' => $randomNumber,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'amount' => $request->fee,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
                ];

                Payment::create($paymentData);
            } else {
                $paymentData = [
                    'amount' => $request->fee,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
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
                $message = 'Your%20online%20appointment%20is%20booked%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Please%20pay%20your%20payment%20form%20your%20portal.';
            } else {
                $message = 'Your%20online%20appointment%20is%20booked%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Your%20video%20call%20link%20is%0a' . $link;
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
        // dd($phone,$doctor, $message, $link, $curlSet, $response);
        curl_close($curl);

//
//        $historyData = [
//            'patient_id' => $appointment->patient_id,
//            'practitioner_id' => $practitioner->id,
//            'clinic_id' => $appointment->clinic_id,
//        ];
//
//        $history = History::create($historyData);
//
        $notificationData = [
            'user_type' => 1,
            'user_id' => $appointment->patient_id,
            'is_read' => 0,
            'title' => 'Appointment Created.',
            'message' => 'Please check out appointment list created by ' . $practitioner->email
        ];

        $notification = Notification::create($notificationData);
//
//        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');
//
//        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));
//
        $notificationData = [
            'user_type' => 2,
            'user_id' => $practitioner->id,
            'is_read' => 0,
            'title' => 'Appointment Created.',
            'message' => 'Please check out appointment list created for ' . $patient->email
        ];

        $notification = Notification::create($notificationData);
//
//        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');
//
//        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));

        return redirect()->route('assistantAppointmentList')->with('success-message', 'Record Added Successfully.');
    }

    //edit Appointment
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $practitioners = Practitioner::whereIn('id', $practitionersID)->get();
        $patients = Patient::where('status', 1)
            ->get();

        $patientTypes = PatientType::where('status', 1)->get();

        $practitioner = Practitioner::find($appointment->practitioner_id);

        $clinics = $practitioner->getClinics;

        $practitionerClinic = PractitionerClinics::where('practitioner_id', $practitioner->id)
            ->where('clinic_id', $appointment->clinic_id)
            ->first();

        $timeIn = Carbon::parse($practitionerClinic->from_time);

        $timeOut = Carbon::parse($practitionerClinic->to_time);


        $interval = new DateInterval('PT10M');

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

        $currentDate = date('d-m-Y', strtotime(Carbon::now()));
        $currentTime = date('H:i:s', strtotime(Carbon::now()));
        $appointmentDate = date('d-m-Y', strtotime($appointment->date));

        foreach ($period as $time) {
            if ($currentDate >= $appointmentDate) {
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


        return view('assistant.appointment.edit', ['title' => 'Edit Appointment', 'appointment' => $appointment, 'patients' => $patients, 'patientTypes' => $patientTypes, 'clinics' => $clinics, 'time_slots' => $time_slots, 'practitioners' => $practitioners]);
    }

    // udpate Appointment
    public function update(Request $request)
    {

        $appointment = Appointment::where('id', $request->appointment_id)
            ->first();

        $rules = [
            'patient_id' => 'required',
            'patient_type_id' => 'required',
            'clinic_id' => 'required',
            'date' => 'required',
            'time_slot' => 'required',
            'type' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Practitioner::find($appointment->practitioner_id);
        $patient = Patient::find($request->patient_id);

        $patientAppointmentExist = Appointment::where('id', '!=', $appointment->id)
            ->where('patient_id', $patient->id)
            ->where('date', Carbon::parse($request->date)->format('Y-m-d'))
            ->where('time_slot', $request->time_slot)
            ->whereNotIn('status', [2, 4])
            ->first();

        if (!empty($patientAppointmentExist)) {
            return Redirect::back()->with('error-message', 'Patient already have meeting with someone on selected Date and Time.');
        }

        $practitionerAppointmentExist = Appointment::where('id', '!=', $appointment->id)
            ->where('practitioner_id', $practitioner->id)
            ->where('date', Carbon::parse($request->date)->format('Y-m-d'))
            ->where('time_slot', $request->time_slot)
            ->whereNotIn('status', [2, 4])
            ->first();

        if (!empty($practitionerAppointmentExist)) {
            return Redirect::back()->with('error-message', 'Practitioner already have meeting with someone on selected Date and Time.');
        }


        $appointmentData = [
            'patient_id' => $request->patient_id,
            'patient_type_id' => $request->patient_type_id,
            'clinic_id' => $request->clinic_id,
            'time_slot' => $request->time_slot,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'type' => $request->type,
            'status' => $request->status,
        ];

        $appointment->update($appointmentData);

        if ($request->fee != null && $request->payment_method != null && $request->payment_status != null) {
            $payment = Payment::where('appointment_id', $appointment->id)->first();
            if ($payment == null) {
                $randomNumber = rand(10000000, 99999999);

                $paymentData = [
                    'patient_id' => $appointment->patient_id,
                    'practitioner_id' => $appointment->practitioner_id,
                    'appointment_id' => $appointment->id,
                    'transaction_id' => $randomNumber,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'amount' => $request->fee,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
                ];

                Payment::create($paymentData);
            } else {
                $paymentData = [
                    'amount' => $request->fee,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
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
            $message = 'Your%20online%20appointment%20is%20updated%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Your%20video%20call%20link%20is%0a' . $link;
        } else {
            $message = 'Your%20appointment%20is%20updated%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').';
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

//        $notificationData = [
//            'user_type' => 1,
//            'user_id' => $appointment->patient_id,
//            'title' => 'Appointment Updated.',
//            'message' => 'Please check out appointment list upated by ' . $practitioner->email
//        ];
//
//        $notification = Notification::create($notificationData);
//
//        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');
//
//        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));
//
//        $notificationData = [
//            'user_type' => 2,
//            'user_id' => $practitioner->id,
//            'is_read' => 0,
//            'title' => 'Appointment Updated.',
//            'message' => 'Please check out appointment list updated for ' . $patient->email
//        ];
//
//        $notification = Notification::create($notificationData);
//
//        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');
//
//        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));

        return redirect()->route('assistantAppointmentList')->with('success-message', 'Record Updated Successfully.');
    }

    // Get time slots
    public function getTimeSlots(Request $request)
    {
        $practitioner = Practitioner::find($request->practitioner_id);

        if (
            empty($request->selected_date) ||
            empty($request->patient_id) ||
            empty($request->clinic_id)
        ) {
            return ['status' => 0, 'error' => 'Date / Patient / Clinic must be selected.'];
        }

        try {
            $selected_date = Carbon::parse($request->selected_date)->format('Y-m-d');
        } catch (Exception $err) {
            return ['status' => 0, 'error' => 'Date format is invalid'];
        }


        $day = strtolower(date('l', strtotime($selected_date)));

        $practitionerClinic = PractitionerClinics::where('practitioner_id', $practitioner->id)
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
            $existingSlots = Appointment::where('practitioner_id', $practitioner->id)
                ->where('clinic_id', $request->clinic_id)
                ->where('date', $selected_date)
                ->where('status', '!=', 4)
                ->get()
                ->pluck('time_slot')
                ->toArray();
        } else {
            $existingSlots = Appointment::where('id', '!=', (int)($request->appointment_id))
                ->where('practitioner_id', $practitioner->id)
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

    public function startEarly($id)
    {
        $appointment = Appointment::find($id);

        $appointment->early_meeting = 1;

        $appointment->update();

        $notificationData = [
            'user_type' => 1,
            'user_id' => $appointment->patient_id,
            'is_read' => 0,
            'title' => 'Appointment Updated.',
            'message' => 'Early meeting Notification.'
        ];

        $notification = Notification::create($notificationData);

        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));

        return redirect()->route('assistantAppointmentList')->with('success-message', 'Record Updated Successfully.');
    }

    // Patient Appointment Reminder - Cron Job
    public function patientAppointmentReminder()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('h:i:s');

        $appointments = Appointment::where('date', $currentDate)->get();

        $appointmentTimeSlots = [];
        foreach ($appointments as $appointmentTimeSlot) {
            $addOneHourFromAppointmentTime = Carbon::now()->addHour(1)->format('h:i:s');
            $timeSlot = Carbon::parse($appointmentTimeSlot->time_slot)->format('h:i:s');

            if ($timeSlot <= $addOneHourFromAppointmentTime && $timeSlot >= $currentTime) {
                $appointmentTimeSlots['ids'][] = $appointmentTimeSlot->id;
                $appointmentTimeSlots['time_slots'][] = $appointmentTimeSlot->time_slot;
            }
        }

        if (isset($appointmentTimeSlots['ids'])) {
            $Ids = $appointmentTimeSlots['ids'];
            $appointmentsWithinTime = Appointment::whereIn('id', $Ids)->get();

            if (count($appointmentsWithinTime) > 0) {
                foreach ($appointmentsWithinTime as $appointment) {
                    $phone = str_replace('-', '', $appointment->patient->phone);
                    $phone = substr($phone, 1);
                    $phone = '92' . $phone;
                    $doctor = str_replace(' ', '', $appointment->practitioner->name);
                    $time = str_replace(' ', '', $appointment->time_slot);
                    $link = route('joinAppointment', ['patientId' => $appointment->patient->id, 'practitionerId' => $appointment->practitioner->id, 'appointmentId' => $appointment->id]);
                    if ($appointment->type == 1) {
                        $message = 'Reminder:%20Today%20your%20online%20appointment%20is%20scheduled%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Your%20video%20call%20link%20is%0a' . $link;
                    } else {
                        $message = 'Reminder:%20Today%20your%20appointment%20is%20scheduled%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').';
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
                }

                return 'Successfully Sent Reminder Message!';
            }
        }

        return 'Message Not Send or No Appointment Found!';
    }

    public function getAssistantFee(Request $request)
    {
        if (empty($request->clinic_id) || empty($request->patient_type_id)) {
            return ['status' => 0, 'error' => 'Patient Type, Practitioner & Clinic must be Selected First.'];
        }

        $today = Carbon::now()->format('Y-m-d');
        $patientType = PatientType::select('discount_percentage')->where('id', $request->patient_type_id)->where('status', 1)->first();

        if ($patientType != null) {
            $patientTypeDiscountPercentage = $patientType->discount_percentage;

            if ($request->type == 0) {
                $practitionerClinicFee = PractitionerClinics::select('physical_fee')->where('practitioner_id', Auth::guard('practitioner')->user()->id)->where('clinic_id', $request->clinic_id)->first();

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

    public function getClinics(Request $request)
    {
        $practitioner = Practitioner::find($request->practitioner_id);
        $clinics = $practitioner->getClinics->toArray();
        return ['status' => 1, 'clinics' => $clinics];
    }

}

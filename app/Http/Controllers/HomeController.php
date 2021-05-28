<?php

namespace App\Http\Controllers;


use App\Models\AgoraToken;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Services\FCMServices;
use App\Services\RtcTokenBuilderServices;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Redirection;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function patientKickOut($appointmentId)
    {
        $appointment = Appointment::where('id', $appointmentId)->with(['patient', 'practitioner'])->first();
        $appointment->update([
            'check_in' => 0,
            'appointment_complete' => 0,
        ]);
        return 'Done';
    }

    public function joinAppointment($patientId, $practitionerId, $appointmentId)
    {

        $appointment = Appointment::where('id', $appointmentId)->with(['patient', 'practitioner'])->first();


        $agoraToken = AgoraToken::where('status', 1)->first();
        $token = $agoraToken->token;
        if (isset($appointment)) {
            // dd($appointment);

            if ((int)$appointment->check_in == 0 && (int)$appointment->practitioner_start == 0 && (int)$appointment->appointment_complete == 0) {
                return view('patient.patientCheckIn', ['appointment' => $appointment]);
            }

            if ((int)$appointment->check_in == 1 && (int)$appointment->practitioner_start == 0 && (int)$appointment->appointment_complete == 0) {
                return view('patient.patientWait', ['appointment' => $appointment]);
            }
            if ((int)$appointment->check_in == 1 && (int)$appointment->practitioner_start == 0 && (int)$appointment->appointment_complete == 1) {
                return view('patient.patientWait', ['appointment' => $appointment]);
            }

            if ((int)$appointment->check_in == 1 && (int)$appointment->practitioner_start == 1 && (int)$appointment->appointment_complete == 1) {
                return redirect()->route('indexPage');
            }


            // $currentDate = Carbon::now()->format('Y-m-d');
            // $currentTime = Carbon::now()->format('h:i:s');
            // $slotEndTime = Carbon::parse($appointment->time_slot)->addMinutes(10)->format('h:i:s');

            // $appointmentTime = Carbon::parse($appointment->time_slot)->format('h:i:s');

            // dd($currentDate, $appointment->date, $currentTime, $appointmentTime, $currentTime, $slotEndTime);

            // dd($currentDate == $appointment->date ,  strtotime($currentDate.' '.$currentTime) >= strtotime($appointment->date.' '.$appointmentTime) , strtotime($currentDate.' '.$currentTime) <= strtotime($currentDate.' '.$slotEndTime));

            // if($currentDate == $appointment->date && strtotime($currentDate.' '.$currentTime) >= strtotime($appointment->date.' '.$appointmentTime) && strtotime($currentDate.' '.$currentTime) <= strtotime($currentDate.' '.$slotEndTime)){
            return view('patient.patientAppointment', ['appointment' => $appointment, 'token' => $token]);
            // }else{
            // if(!($currentDate == $appointment->date) && !(strtotime($currentDate.' '.$currentTime) > strtotime($currentDate.' '.$slotEndTime))) {
            //     return redirect()->route('indexPage')->with('error-message', 'Appointment is schedule for '.$appointment->date);
            // }
            // if(!(strtotime($currentDate.' '.$currentTime) < strtotime($appointment->date.' '.$appointmentTime))) {
            //     return redirect()->route('indexPage')->with('error-message', 'Appointment is schedule for '.$appointmentTime .' - '. $slotEndTime);
            // }
            // if(!($currentTime > $slotEndTime)) {
            //     return redirect()->route('indexPage')->with('error-message', 'Appointment is schedule for '.$slotEndTime);
            // }
        }
        // }else{
        //     return redirect()->route('indexPage')->with('error-message', 'Appointment is not schedule.');
        // }
    }

    public function checkIn($otp, $appointmentId)
    {

        $appointment = Appointment::where('id', (int)$appointmentId)->first();

        if (empty($appointment)) {
            return ['status' => 0, 'message' => 'No Appointment Found With This Id'];
        }

        if ((int)$appointment->otp !== (int)$otp) {
            return ['status' => 0, 'message' => 'Please Enter Valid OTP'];
        }

        if ((int)$appointment->otp == (int)$otp) {
            $appointment->update([
                'otp' => NULL,
                'check_in' => 1,
            ]);

            return ['status' => 1, 'message' => 'Check In Successfull'];
        }


    }

    public function checkAppointmentStatus($appointmentId)
    {
        $appointment = Appointment::where('id', (int)$appointmentId)->first();

        if (empty($appointment)) {
            return response()->json(['status' => 0, 'message' => 'No Appointment Found With This Id']);
        }
        if ((int)$appointment->check_in == 1 && (int)$appointment->practitioner_start == 1 && (int)$appointment->appointment_complete == 0) {
            return response()->json(['status' => 1, 'message' => 'Appointment Is Starting']);
        }
        if ((int)$appointment->check_in == 1 && (int)$appointment->practitioner_start == 0 && (int)$appointment->appointment_complete == 1) {
            return response()->json(['status' => 1, 'message' => 'Appointment Video Complete']);
        }
        if ((int)$appointment->check_in == 1 && (int)$appointment->practitioner_start == 1 && (int)$appointment->appointment_complete == 1) {
            return response()->json(['status' => 1, 'message' => 'Appointment Completed']);
        }
        return response()->json(['status' => 0, 'message' => 'No Condition Is True.']);
    }

    public function changeAppointmentStatusBit($appointmentId)
    {
        $appointment = Appointment::where('id', (int)$appointmentId)->first();
        $appointment->practitioner_start = 0;
        $appointment->appointment_complete = 1;
        $appointment->save();
        return response()->json(['status' => 1, 'message' => 'Appointment Completed']);
    }

    public function agoraTokenGenerate()
    {
        $practitioners = Practitioner::all();
        foreach ($practitioners as $practitioner) {
            if (!empty($practitioner->agora_app_id) && !empty($practitioner->agora_app_certificate) && !empty($practitioner->agora_app_channel)) {
                $appID = (string)$practitioner->agora_app_id;
                $appCertificate = (string)$practitioner->agora_app_certificate;
                $channelName = (string)$practitioner->agora_app_channel;
                $uid = null;
                $uidStr = "";
                $role = RtcTokenBuilderServices::RoleAttendee;
                $expireTimeInSeconds = 86400;
                $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
                $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

                $token = RtcTokenBuilderServices::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);

//            $agoraToken = AgoraToken::where('status', 1)->first();

                $practitioner->update([
                    "agora_app_token" => $token,
                ]);
            }
        }
    }

    public function sendAllAppointmentNotifications()
    {
        $patientIds = Patient::where('token', '!=', null)->pluck('id')->toArray();
        $appointmentPatientIds = Appointment::whereIn('patient_id', $patientIds)->where(['date' => Carbon::now()->format('Y-m-d'), 'time_slot' => Carbon::now()->addMinutes(5)->format('h:i a')])->pluck('patient_id')->toArray();
        $patientTokens = Patient::whereIn('id',$appointmentPatientIds )->pluck('token')->toArray();
        if (count($patientTokens) > 0) {
                $title = 'Appointment notification.';
                $payloadBody = 'Your appointment will be start in 5 mints.';
                $additionalData = [];
                $tokens = $patientTokens;
                $fcmNotification = new FCMServices();
                $fcmNotification->sendToAll($title, $payloadBody, $additionalData, $tokens);
                return 'Notification sent.';
        } else {
            return 'No appointment is scheduled at this time.';
        }
    }

}

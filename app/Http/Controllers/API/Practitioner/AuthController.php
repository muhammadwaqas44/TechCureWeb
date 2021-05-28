<?php

namespace App\Http\Controllers\API\Practitioner;

use App\Events\Notify;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Practitioner;
use App\Models\PractitionerClinicDay;
use App\Models\PractitionerClinics;
use Carbon\Carbon;
use Config;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use Mail;
use Validator;

class AuthController extends Controller
{
    private $generalConstants;
    private $responseConstants;
    private $constants;

    public function __construct()
    {
        $this->constants = Config::get('constants.PRACTITIONER_CONSTANTS');
        $this->generalConstants = Config::get('constants.GENERAL_CONSTANTS');
        $this->responseConstants = Config::get('constants.RESPONSE_CONSTANTS');
    }

    public function practitionerSignUp(Request $request)
    {
        $response = [];
        $rules = [
            $this->constants['KEY_PRACTITIONER_CLINICS'] => 'required|array|min:1',
            $this->constants['KEY_FULL_NAME'] => 'required|max:191',
            $this->constants['KEY_EMAIL'] => 'required|email|unique:practitioners',
            $this->constants['KEY_PASSWORD'] => 'required|min:8',
            $this->constants['KEY_PHONE'] => 'required|min:11|unique:practitioners',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors(),
            ]);
        }

        $emailExists = Practitioner::where('email', '=', $request->get($this->constants['KEY_EMAIL']))->first();
        if ($emailExists !== null) {

            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['ERROR_EMAIL_EXIST'],
            ]);
        }
        $phoneExists = Practitioner::where('phone', '=', $request->get($this->constants['KEY_PHONE']))->first();
        if ($phoneExists !== null) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['ERROR_PHONE_EXIST'],
            ]);
        }

        // check if clinic time interval is correct
        for ($i = 0; $i < count($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])); $i++) {
            $startTime = date("H:i", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_FROM_TIME']]));
            $endTime = date("H:i", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_TO_TIME']]));

            if ($startTime < $endTime) {
            } else {
                return response()->json([
                    'status' => $this->responseConstants['STATUS_ERROR'],
                    'message' => "Clinic Opening Time and Closing Time interval error.",
                ]);
            }
        }

        // check if clinics day time match
        for ($i = 0; $i < count($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])); $i++) {

            $firstFromTime = date("H:i", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_FROM_TIME']]));
            $firstToTime = date("H:i", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_TO_TIME']]));

            $days = array();

            for ($j = 0; $j < count($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_DAYS']]); $j++) {
                $days[$j] = $request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_DAYS']][$j];
            }

            for ($k = $i + 1; $k < count($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])); $k++) {

                $secondFromTime = date("H:i", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$k][$this->constants['KEY_FROM_TIME']]));
                $secondToTime = date("H:i", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$k][$this->constants['KEY_TO_TIME']]));

                for ($l = 0; $l < count($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$k][$this->constants['KEY_DAYS']]); $l++) {
                    if (in_array($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$k][$this->constants['KEY_DAYS']][$l], $days, true)) {
                        if (($secondFromTime <= $firstFromTime && $secondToTime > $firstFromTime)
                            || ($secondFromTime >= $firstFromTime && $secondFromTime < $firstToTime)) {
                            // return "overlap";
                            return response()->json([
                                'status' => $this->responseConstants['STATUS_ERROR'],
                                'message' => "You can not select same time for same day in different Clinics.",
                            ]);
                        } else {
                            // return "dont overlap";
                        }
                    }
                }
            }
        }

        $practitionerData = [
            'name' => $request->get($this->constants['KEY_FULL_NAME']),
            'email' => $request->get($this->constants['KEY_EMAIL']),
            'phone' => $request->get($this->constants['KEY_PHONE']),
            'qualification_id' => $request->get($this->constants['KEY_QUALIFICATION_Id']),
            'status' => 0,
            'password' => \Illuminate\Support\Facades\Hash::make($request->get($this->constants['KEY_PASSWORD'])),
        ];

        $practitioner = Practitioner::create($practitionerData);

        for ($i = 0; $i < count($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])); $i++) {

            $practitionerClinicData = [
                'clinic_id' => $request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_CLINIC']],
                'practitioner_id' => $practitioner->id,
                'physical_fee' => $request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_PHYSICAL_FEE']],
                'online_fee' => $request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_ONLINE_FEE']],
                'from_time' => date("H:i:s", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_FROM_TIME']])),
                'to_time' => date("H:i:s", strtotime($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_TO_TIME']])),
            ];

            $practitionerClinic = PractitionerClinics::create($practitionerClinicData);

            for ($j = 0; $j < count($request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_DAYS']]); $j++) {
                $practitionerClinicDaysData = [
                    'practitioner_clinic_id' => $practitionerClinic->id,
                    'day' => $request->get($this->constants['KEY_PRACTITIONER_CLINICS'])[$i][$this->constants['KEY_DAYS']][$j]
                ];

                $practitionerClinicDay = PractitionerClinicDay::create($practitionerClinicDaysData);
            }
        }

        $data = array(
            'name' => $request->get($this->constants['KEY_FULL_NAME']),
            'email' => $request->get($this->constants['KEY_EMAIL']),
            'phone' => $request->get($this->constants['KEY_PHONE']),
            'password' => $request->get($this->constants['KEY_PASSWORD']),
        );

        try {
            Mail::send('practitioner.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject("Account Creation");
            });
        } catch (\Exception $e) {

        }

        $notificationData = [
            'user_type' => 2,
            'user_id' => 0,
            'is_read' => 0,
            'title' => 'Practitioner Account Request',
            'message' => 'Please check out practitioner list to approve the request for ' . $practitioner->email
        ];

        $notification = Notification::create($notificationData);

        $currentTime = \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('l d M Y h:i a');

        event(new Notify($notification->id, $notification->title, $notification->message, $currentTime, $notification->user_type, $notification->user_id));


        if ($request->has($this->constants['KEY_DEVICE_ID']) && !empty($request->get($this->constants['KEY_DEVICE_ID']))) {
            $practitioner->update(['token' => $request->get($this->constants['KEY_DEVICE_ID'])]);
        }

        if ($request->has($this->constants['KEY_DEVICE_TYPE']) && !empty($request->get($this->constants['KEY_DEVICE_TYPE']))) {
            $practitioner->update(['device_type' => $request->get($this->constants['KEY_DEVICE_TYPE'])]);
        }

        $token = JWTAuth::fromUser($practitioner);
        $practitioner->makeHidden([
            'password',
            'status',
            'remember_token',
            'last_login',
            'created_at',
            'updated_at',]);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = $this->responseConstants['MSG_REGISTERED_SUCCESS'];
        $response['access_token'] = $token;
        $response['practitioner'] = $practitioner;
        return response()->json($response);
    }

    public function practitionerSignIn(Request $request)
    {
        $response = [];
        $validator = Validator::make($request->all(), [
            $this->constants['KEY_EMAIL'] => 'required|string',
            $this->constants['KEY_PASSWORD'] => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors(),
            ]);
        }

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->get($this->constants['KEY_EMAIL']), 'password' => $request->get($this->constants['KEY_PASSWORD'])];

        } else {
            $credentials = ['phone' => $request->get($this->constants['KEY_EMAIL']), 'password' => $request->get($this->constants['KEY_PASSWORD'])];
        }
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => $this->responseConstants['STATUS_ERROR'],
                    'message' => $this->responseConstants['ERROR_INVALID_CREDENTIALS'],
                ]);
            }

        } catch (JWTException $e) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => 'Cant create token.',
            ]);
        }

        $user = Practitioner::find(JWTAuth::setToken($token)->getClaim('sub'));

        $user->update(['last_login' => Carbon::now()->toDateTimeString()]);


        $token = JWTAuth::fromUser($user);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }
        $user = Practitioner::select(
            'id',
            'name',
            'email',
            'phone',
            'address',
            'description',
            'image',
            'qualification_id',
            'password',
            'license_no',
            'license_image',
            'prescription_pad_header_image',
            'prescription_pad_footer_image',
            'prescription_pad_sidebar_image',
            'prescription_pad_other_image',
            'status',
            'agora_app_id',
            'agora_app_token',
            'agora_app_certificate',
            'agora_app_channel')->where('id', $user->id)->first();

        if ($request->has($this->constants['KEY_DEVICE_ID']) && !empty($request->get($this->constants['KEY_DEVICE_ID']))) {
            $user->update(['token' => $request->get($this->constants['KEY_DEVICE_ID'])]);
        }

        if ($request->has($this->constants['KEY_DEVICE_TYPE']) && !empty($request->get($this->constants['KEY_DEVICE_TYPE']))) {
            $user->update(['device_type' => $request->get($this->constants['KEY_DEVICE_TYPE'])]);
        }


        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = $this->responseConstants['MSG_LOGGED_IN'];
        $response['access_token'] = $token;
        $response['practitioner'] = $user;
        return response()->json($response);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            $this->constants['KEY_EMAIL'] => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors(),
            ]);
        }

        $consumer = Practitioner::where('email', $request->get($this->constants['KEY_EMAIL']))->first();

        if ($consumer == null) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['ERROR_INVALID_EMAIL'],
            ]);
        }

        $response = app('App\Http\Controllers\Auth\PractitionerForgotPasswordController')->sendResetLinkEmail($request);
        return $response;
    }

    public function logout(Request $request)
    {
        $response = [];

        $user = JWTAuth::toUser($request->token);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }

        $user = Practitioner::find($user->id);
        $user->update([
            'last_login' => Carbon::now()->toDateTimeString(),
            'token' => Null
        ]);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = $this->responseConstants['MSG_LOGGED_OUT'];
        return response()->json($response);

    }

}

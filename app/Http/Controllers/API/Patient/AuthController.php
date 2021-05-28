<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Carbon\Carbon;
use Config;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class AuthController extends Controller
{
    private $generalConstants;
    private $responseConstants;
    private $constants;

    public function __construct()
    {
        $this->constants = Config::get('constants.PATIENT_CONSTANTS');
        $this->generalConstants = Config::get('constants.GENERAL_CONSTANTS');
        $this->responseConstants = Config::get('constants.RESPONSE_CONSTANTS');
    }

    public function patientSignUp(Request $request)
    {
        $response = [];
        $rules = [
            $this->constants['KEY_FULL_NAME'] => 'required',
            $this->constants['KEY_EMAIL'] => 'required|email|',
            $this->constants['KEY_PASSWORD'] => 'required',
            $this->constants['KEY_PHONE'] => 'required',
            $this->constants['KEY_DATE_OF_BIRTH'] => 'required',
            $this->constants['KEY_AGE'] => 'required',
            $this->constants['KEY_GENDER'] => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        $emailExists = Patient::where('email', '=', $request->get($this->constants['KEY_EMAIL']))->first();
        if ($emailExists !== null) {

            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['ERROR_EMAIL_EXIST'],
            ]);
        }
        $emailExists = Patient::where('phone', '=', $request->get($this->constants['KEY_PHONE']))->first();
        if ($emailExists !== null) {

            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['ERROR_PHONE_EXIST'],
            ]);
        }

        $randomNumber = rand(10000000, 99999999);
        $data = [
            'mr_number' => $randomNumber,
            'patient_type_id' => 3,
            'name' => $request->get($this->constants['KEY_FULL_NAME']),
            'email' => $request->get($this->constants['KEY_EMAIL']),
            'password' => Hash::make($request->get($this->constants['KEY_PASSWORD'])),
            'phone' => $request->get($this->constants['KEY_PHONE']),
            'dob' => Carbon::parse($request->get($this->constants['KEY_DATE_OF_BIRTH']))->format('Y-m-d'),
            'age' => $request->get($this->constants['KEY_AGE']),
            'gender' => $request->get($this->constants['KEY_GENDER']),
            'last_login' => Carbon::now()->toDateTimeString()
        ];

        if ($request->has($this->constants['KEY_DEVICE_ID']) && !empty($request->get($this->constants['KEY_DEVICE_ID']))) {
            $data['token'] = $request->get($this->constants['KEY_DEVICE_ID']);
        }

        if ($request->has($this->constants['KEY_DEVICE_TYPE']) && !empty($request->get($this->constants['KEY_DEVICE_TYPE']))) {
            $data['device_type'] = $request->get($this->constants['KEY_DEVICE_TYPE']);
        }

        $user = Patient::create($data);
        $token = JWTAuth::fromUser($user);
        $user->makeHidden([
            'weight_kgs',
            'weight_lbs',
            'height_ft',
            'height_in',
            'height_cms',
            'marital_status',
            'hospitalization',
            'currently_on_drug',
            'payment_status',
            'time_waste_flag_condition',
            'critical_flag_condition',
            'password',
            'status',
            'remember_token',
            'last_login',
            'created_at',
            'updated_at']);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = $this->responseConstants['MSG_REGISTERED_SUCCESS'];
        $response['access_token'] = $token;
        $response['patient'] = $user;
        return response()->json($response);
    }

    public function patientSignIn(Request $request)
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
                'errors' => $validator->errors()->first(),
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

        $user = Patient::find(JWTAuth::setToken($token)->getClaim('sub'));
        $user->update(['last_login' => Carbon::now()->toDateTimeString()]);


        $token = JWTAuth::fromUser($user);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }
        $user = Patient::where('id', $user->id)->first();

        if ($request->has($this->constants['KEY_DEVICE_ID']) && !empty($request->get($this->constants['KEY_DEVICE_ID']))) {
            $user->update(['token' => $request->get($this->constants['KEY_DEVICE_ID'])]);
        }

        if ($request->has($this->constants['KEY_DEVICE_TYPE']) && !empty($request->get($this->constants['KEY_DEVICE_TYPE']))) {
            $user->update(['device_type' => $request->get($this->constants['KEY_DEVICE_TYPE'])]);
        }
        $user->makeHidden([
            'weight_kgs',
            'weight_lbs',
            'height_ft',
            'height_in',
            'height_cms',
            'marital_status',
            'hospitalization',
            'currently_on_drug',
            'payment_status',
            'time_waste_flag_condition',
            'critical_flag_condition',
            'password',
            'status',
            'remember_token',
            'last_login',
            'created_at',
            'updated_at',]);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = $this->responseConstants['MSG_LOGGED_IN'];
        $response['access_token'] = $token;
        $response['patient'] = $user;
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
                'errors' => $validator->errors()->first(),
            ]);
        }

        $consumer = Patient::where('email', $request->get($this->constants['KEY_EMAIL']))->first();

        if ($consumer == null) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['ERROR_INVALID_EMAIL'],
            ]);
        }

        $response = app('App\Http\Controllers\Auth\PatientForgotPasswordController')->sendResetLinkEmail($request);
        return $response;
    }

    public function logout(Request $request)
    {
        $response = [];

        $consumer = JWTAuth::toUser($request->token);
        $consumerStatus = $consumer->_check();
        if ($consumerStatus != null) {
            return response()->json($consumerStatus);
        }

        $consumer = Patient::find($consumer->id);
        $consumer->update([
            'last_login' => Carbon::now()->toDateTimeString(),
            'token' => Null
        ]);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = $this->responseConstants['MSG_LOGGED_OUT'];
        return response()->json($response);

    }

}

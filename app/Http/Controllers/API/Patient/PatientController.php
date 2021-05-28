<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\Allergy;
use App\Models\Appointment;
use App\Models\Drug;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAllergy;
use App\Models\PatientDrug;
use App\Models\PatientReport;
use App\Models\Payment;
use App\Models\Practitioner;
use App\Models\Specialty;
use Carbon\Carbon;
use Config;
use Hash;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Validator;

class PatientController extends Controller
{
    private $generalConstants;
    private $responseConstants;
    private $constants;
    private $recordsPerPage = 20;

    public function __construct()
    {
        $this->constants = Config::get('constants.PATIENT_CONSTANTS');
        $this->generalConstants = Config::get('constants.GENERAL_CONSTANTS');
        $this->responseConstants = Config::get('constants.RESPONSE_CONSTANTS');
    }

    public function dashboard(Request $request)
    {
        $response = [];
        $today = \Illuminate\Support\Carbon::now()->format('Y-m-d');

        $user = JWTAuth::toUser($request->token);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }

        $patient = Patient::find($user->id);

        $practitionerCount = Practitioner::where('status', 1)
            ->count();

        $todayAppointmentCount = Appointment::where('patient_id', $patient->id)
            ->where('date', $today)
            ->whereNotIn('status', [2, 4])
            ->count();

        $allAppointmentCount = Appointment::where('patient_id', $patient->id)
            ->count();


        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['practitionerCount'] = $practitionerCount;
        $response['todayAppointmentCount'] = $todayAppointmentCount;
        $response['allAppointmentCount'] = $allAppointmentCount;

        return response()->json($response);
    }

    public function getMyProfile(Request $request)
    {
        $response = [];
        $user = JWTAuth::toUser($request->token);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }

        $user = Patient::with(['reports' => function ($query) {
            $query->select(['id', 'title', 'type', 'image_url', 'patient_id']);
        }, 'allergies' => function ($query) {
            $query->select(['id', 'patient_id', 'allergy_id', 'allergy_title']);
        }, 'drugs' => function ($query) {
            $query->select(['id', 'patient_id', 'drug_id', 'drug_title']);
        }])->where('id', $user->id)->first();

        $user->makeHidden([
            'payment_status',
            'time_waste_flag_condition',
            'critical_flag_condition',
            'password',
            'status',
            'remember_token',
            'last_login',
            'created_at',
            'updated_at',
            'token',
            'device_type'
        ]);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['patient'] = $user;

        return response()->json($response);
    }

    public function updateProfile(Request $request)
    {
        $response = [];

        $user = JWTAuth::toUser($request->token);

        if (!empty($request->get($this->constants['KEY_EMAIL']))) {
            $rules [$this->constants['KEY_EMAIL']] = 'required|email|unique:patients,email,' . $user->id;
        }
        if (!empty($request->get($this->constants['KEY_PHONE']))) {
            $rules [$this->constants['KEY_PHONE']] = 'required|unique:patients,phone,' . $user->id;
        }

        if (!empty($request->get($this->constants['KEY_FULL_NAME']))) {
            $rules [$this->constants['KEY_FULL_NAME']] = 'required|string';
        }
        if (!empty($request->get($this->constants['KEY_DATE_OF_BIRTH']))) {
            $rules [$this->constants['KEY_DATE_OF_BIRTH']] = 'required|string';
        }
        if (!empty($request->get($this->constants['KEY_AGE']))) {
            $rules [$this->constants['KEY_AGE']] = 'required';
        }
        if (!empty($request->get($this->constants['KEY_GENDER']))) {
            $rules [$this->constants['KEY_GENDER']] = 'required';
        }
        if (!empty($request->get($this->constants['KEY_PROFILE_IMAGE']))) {
            $rules [$this->constants['KEY_PROFILE_IMAGE']] = 'nullable';
        }
        if (!empty($request->get($this->constants['KEY_WEIGHT_KGS']))) {
            $rules [$this->constants['KEY_WEIGHT_KGS']] = 'required|numeric';
        }
        if (!empty($request->get($this->constants['KEY_WEIGHT_LBS']))) {
            $rules [$this->constants['KEY_WEIGHT_LBS']] = 'required|numeric';
        }
        if (!empty($request->get($this->constants['KEY_HEIGHT_FT']))) {
            $rules [$this->constants['KEY_HEIGHT_FT']] = 'required|numeric';
        }
        if (!empty($request->get($this->constants['KEY_HEIGHT_IN']))) {
            $rules [$this->constants['KEY_HEIGHT_IN']] = 'required|numeric';
        }
        if (!empty($request->get($this->constants['KEY_HEIGHT_CMS']))) {
            $rules [$this->constants['KEY_HEIGHT_CMS']] = 'required|numeric';
        }
        if (!empty($request->get($this->constants['KEY_HOSPITALIZATION']))) {
            $rules [$this->constants['KEY_HOSPITALIZATION']] = 'required|numeric';
        }
        if (!empty($request->get($this->constants['KEY_CURRENTLY_ON_DRUG']))) {
            $rules [$this->constants['KEY_CURRENTLY_ON_DRUG']] = 'required|numeric';
        }
        if (!empty($request->get($this->constants['KEY_MARITAL_STATUS']))) {
            $rules [$this->constants['KEY_MARITAL_STATUS']] = 'required|string';
        }
        if (!empty($request->get($this->constants['KEY_ADDRESS']))) {
            $rules [$this->constants['KEY_ADDRESS']] = 'required|string';
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        $patientStatus = $user->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        if (!empty($request->get($this->constants['KEY_EMAIL']))) {
            $email = $request->get($this->constants['KEY_EMAIL']);
        } else {
            $email = $user->email;
        }
        if (!empty($request->get($this->constants['KEY_PHONE']))) {
            $phone = $request->get($this->constants['KEY_PHONE']);
        } else {
            $phone = $user->phone;
        }
        if (!empty($request->get($this->constants['KEY_FULL_NAME']))) {
            $fullName = $request->get($this->constants['KEY_FULL_NAME']);
        } else {
            $fullName = $user->name;
        }
        if (!empty($request->get($this->constants['KEY_DATE_OF_BIRTH']))) {
            $dob = Carbon::parse($request->get($this->constants['KEY_DATE_OF_BIRTH']))->format('Y-m-d');
        } else {
            $dob = $user->dob;
        }
        if (!empty($request->get($this->constants['KEY_PASSWORD']))) {
            $password = \Illuminate\Support\Facades\Hash::make($request->get($this->constants['KEY_PASSWORD']));
        } else {
            $password = $user->password;
        }
        if (!empty($request->get($this->constants['KEY_AGE']))) {
            $age = $request->get($this->constants['KEY_AGE']);
        } else {
            $age = $user->age;
        }
        if (!empty($request->get($this->constants['KEY_GENDER']))) {
            $gender = $request->get($this->constants['KEY_GENDER']);
        } else {
            $gender = $user->gender;
        }
        if (!empty($request->get($this->constants['KEY_WEIGHT_KGS']))) {
            $weight_kgs = $request->get($this->constants['KEY_WEIGHT_KGS']);
        } else {
            $weight_kgs = $user->weight_kgs;
        }
        if (!empty($request->get($this->constants['KEY_WEIGHT_LBS']))) {
            $weight_lbs = $request->get($this->constants['KEY_WEIGHT_LBS']);
        } else {
            $weight_lbs = $user->weight_lbs;
        }
        if (!empty($request->get($this->constants['KEY_HEIGHT_FT']))) {
            $height_ft = $request->get($this->constants['KEY_HEIGHT_FT']);
        } else {
            $height_ft = $user->height_ft;
        }
        if (!empty($request->get($this->constants['KEY_HEIGHT_IN']))) {
            $height_in = $request->get($this->constants['KEY_HEIGHT_IN']);
        } else {
            $height_in = $user->height_in;
        }
        if (!empty($request->get($this->constants['KEY_HEIGHT_CMS']))) {
            $height_cms = $request->get($this->constants['KEY_HEIGHT_CMS']);
        } else {
            $height_cms = $user->height_cms;
        }
        if (!empty($request->get($this->constants['KEY_MARITAL_STATUS']))) {
            $marital_status = $request->get($this->constants['KEY_MARITAL_STATUS']);
        } else {
            $marital_status = $user->marital_status;
        }
        if (!empty($request->get($this->constants['KEY_HOSPITALIZATION']))) {
            $hospitalization = $request->get($this->constants['KEY_HOSPITALIZATION']);
        } else {
            $hospitalization = $user->hospitalization;
        }
        if (!empty($request->get($this->constants['KEY_CURRENTLY_ON_DRUG']))) {
            $currently_on_drug = $request->get($this->constants['KEY_CURRENTLY_ON_DRUG']);
        } else {
            $currently_on_drug = $user->currently_on_drug;
        }
        if (!empty($request->get($this->constants['KEY_ADDRESS']))) {
            $address = $request->get($this->constants['KEY_ADDRESS']);
        } else {
            $address = $user->address;
        }

        $data = [
            'email' => $email,
            'name' => $fullName,
            'phone' => $phone,
            'password' => $password,
            'dob' => $dob,
            'age' => $age,
            'gender' => $gender,
            'weight_kgs' => $weight_kgs,
            'weight_lbs' => $weight_lbs,
            'height_ft' => $height_ft,
            'height_in' => $height_in,
            'height_cms' => $height_cms,
            'marital_status' => $marital_status,
            'hospitalization' => $hospitalization,
            'currently_on_drug' => $currently_on_drug,
            'address' => $address,
        ];


        if ($request->hasFile($this->constants['KEY_PROFILE_IMAGE'])) {
            if (isset($consumer->profile_image) && Storage::exists($consumer->profile_image)) {
                Storage::delete($consumer->profile_image);
            }
            if (!Storage::exists('patientImages')) {
                Storage::makeDirectory('patientImages');
            }

            $data['image'] = Storage::putFile('patientImages', new File($request->file($this->constants['KEY_PROFILE_IMAGE'])));
        }

        Patient::where('id', $user->id)->update($data);

        if ($request->has($this->constants['KEY_ALLERGIES']) && count($request->get($this->constants['KEY_ALLERGIES'])) > 0 && $request->get($this->constants['KEY_ALLERGIES']) != null) {
            $delAllergies = PatientAllergy::where('patient_id', $user->id)->delete();

            foreach ($request->get($this->constants['KEY_ALLERGIES']) as $allergy) {
                $allergyTitle = Allergy::select('title')->where('id', $allergy)->first();
                $allergyData = [
                    'patient_id' => $user->id,
                    'allergy_id' => $allergy,
                    'allergy_title' => $allergyTitle->title,
                ];
                PatientAllergy::create($allergyData);
            }
        } else {
            $delAllergies = PatientAllergy::where('patient_id', $user->id)->delete();
        }

        if (!empty($request->get($this->constants['KEY_CURRENTLY_ON_DRUG'])) && $request->get($this->constants['KEY_CURRENTLY_ON_DRUG']) == 1) {
            $delDrugs = PatientDrug::where('patient_id', $user->id)->delete();

            if ($request->has($this->constants['KEY_DRUGS']) && count($request->get($this->constants['KEY_DRUGS'])) > 0 && $request->get($this->constants['KEY_DRUGS']) != null) {
                foreach ($request->get($this->constants['KEY_DRUGS']) as $drug) {
                    $drugTitle = Drug::select('title')->where('id', $drug)->first();
                    $drugData = [
                        'patient_id' => $user->id,
                        'drug_id' => $drug,
                        'drug_title' => $drugTitle->title,
                    ];
                    PatientDrug::create($drugData);
                }
            } else {
                $delDrugs = PatientDrug::where('patient_id', $user->id)->delete();
            }
        } else {
            $delDrugs = PatientDrug::where('patient_id', $user->id)->delete();
        }


        $user = Patient::with(['reports' => function ($query) {
            $query->select(['title', 'type', 'image_url', 'patient_id']);
        }, 'allergies' => function ($query) {
            $query->select(['patient_id', 'allergy_id', 'allergy_title']);
        }, 'drugs' => function ($query) {
            $query->select(['patient_id', 'drug_id', 'drug_title']);
        }])->where('id', $user->id)->first();

        $user->makeHidden([
            'payment_status',
            'time_waste_flag_condition',
            'critical_flag_condition',
            'password',
            'status',
            'remember_token',
            'last_login',
            'created_at',
            'updated_at',
            'token',
            'device_type'
        ]);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Patient Data Updated Successfully.";
        $response['patient'] = $user;

        return response()->json($response);

    }

    public function getAllAllergies(Request $request)
    {
        $response = [];
        $allergies = Allergy::select('id', 'title')->where('status', 1)->orderBy('title', 'ASC')->get();
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['allergies'] = $allergies;
        return response()->json($response);
    }

    public function getAllDurgs(Request $request)
    {
        $response = [];
        $drugs = Drug::select('id', 'title')->where('status', 1)->orderBy('title', 'ASC')->get();
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['drugs'] = $drugs;
        return response()->json($response);
    }

    public function getAllSpecialties(Request $request)
    {
        $response = [];
        $specialties = Specialty::select('id', 'title')->where('status', 1)->orderBy('title', 'ASC')->get();
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['specialties'] = $specialties;
        return response()->json($response);
    }

    public function getAllPractitionersList(Request $request)
    {
        $response = [];

        $rules = [
            $this->constants['KEY_SPECIALTY_ID'] => "required|integer",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        $user = JWTAuth::toUser($request->token);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }
        $offset = 0;
        if ($request->filled($this->generalConstants['KEY_PAGE_NO'])) {
            $offset = $this->recordsPerPage * $request->get($this->generalConstants['KEY_PAGE_NO']);
        }

        if ($request->get($this->constants['KEY_SPECIALTY_ID']) == 0) {
            $practitioners = Practitioner::where('status', 1)->with('specialties')->orderBy('id', 'DESC')
                ->skip($offset)
                ->take($this->recordsPerPage)->get();
            $practitioners->makeHidden([
                'password',
                'status',
                'remember_token',
                'created_at',
                'updated_at',
            ]);

            $totalRecords = Practitioner::where('status', 1)->with('specialties')->orderBy('id', 'DESC')
                ->count();

            $totalPages = ceil($totalRecords / $this->recordsPerPage);

            $currentPage = (int)$request->get($this->generalConstants['KEY_PAGE_NO']);
        } else {
            $practitioners = Practitioner::where('status', 1)->with('specialties')->whereHas('specialties', function ($q) use ($request) {
                $q->where('specialty_id', $request->get($this->constants['KEY_SPECIALTY_ID']));
            })->orderBy('id', 'DESC')
                ->skip($offset)
                ->take($this->recordsPerPage)->get();
            $practitioners->makeHidden([
                'password',
                'status',
                'remember_token',
                'created_at',
                'updated_at',
            ]);

            $totalRecords = Practitioner::where('status', 1)->with('specialties')->whereHas('specialties', function ($q) use ($request) {
                $q->where('specialty_id', $request->get($this->constants['KEY_SPECIALTY_ID']));
            })->orderBy('id', 'DESC')
                ->count();

            $totalPages = ceil($totalRecords / $this->recordsPerPage);

            $currentPage = (int)$request->get($this->generalConstants['KEY_PAGE_NO']);
        }
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['practitioners'] = $practitioners;
        $response['currentPage'] = $currentPage;
        $response['totalPages'] = $totalPages;
        return response()->json($response);
    }

    public function practitionerDetails(Request $request)
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

        $user = JWTAuth::toUser($request->token);

        $patientStatus = $user->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        $practitioner = Practitioner::select(
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
            'agora_app_channel')
            ->where('id', $request->get($this->constants['KEY_PRACTITIONER_ID']))->with(['specialties', 'clinics' => function ($q) {
                $q->select('id', 'practitioner_id', 'clinic_id', 'physical_fee', 'online_fee', 'from_time', 'to_time');
            }, 'clinics.days' => function ($q) {
                $q->select('id', 'practitioner_clinic_id', 'day');
            }])->first();

        return response()->json([
            'status' => $this->responseConstants['STATUS_SUCCESS'],
            'message' => "Success",
            'practitioner' => $practitioner,
        ]);
    }

    public function getAllPractitioners(Request $request)
    {
        $response = [];
        $practitioners = Practitioner::select('id', 'name')->where('status', 1)->orderBy('name', 'ASC')
            ->get();
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['practitioners'] = $practitioners;
        return response()->json($response);
    }

    public function postEditProfile(Request $request)
    {
        $response = [];
        $rules = [
            $this->constants['KEY_FULL_NAME'] => "required|string"
        ];
        if (!empty($request->get($this->constants['KEY_PASSWORD']))) {
            $rules [$this->constants['KEY_PASSWORD']] = 'required|min:6|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }
        $user = JWTAuth::toUser($request->token);

        $patientStatus = $user->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        if (!empty($request->get($this->constants['KEY_FULL_NAME']))) {
            $fullName = $request->get($this->constants['KEY_FULL_NAME']);
        } else {
            $fullName = $user->name;
        }
        if (!empty($request->get($this->constants['KEY_PASSWORD']))) {
            $password = \Illuminate\Support\Facades\Hash::make($request->get($this->constants['KEY_PASSWORD']));
        } else {
            $password = $user->password;
        }

        $data = [
            'name' => $fullName,
            'password' => $password,
        ];

        Patient::where('id', $user->id)->update($data);


        $user = Patient::with(['reports' => function ($query) {
            $query->select(['title', 'type', 'image_url', 'patient_id']);
        }, 'allergies' => function ($query) {
            $query->select(['patient_id', 'allergy_id', 'allergy_title']);
        }, 'drugs' => function ($query) {
            $query->select(['patient_id', 'drug_id', 'drug_title']);
        }])->where('id', $user->id)->first();

        $user->makeHidden([
            'payment_status',
            'time_waste_flag_condition',
            'critical_flag_condition',
            'password',
            'status',
            'remember_token',
            'last_login',
            'created_at',
            'updated_at',
            'token',
            'device_type'
        ]);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Patient Profile Updated Successfully.";
        $response['patient'] = $user;

        return response()->json($response);
    }

    public function addAttachment(Request $request)
    {
        $response = [];
        $rules = [
            $this->constants['KEY_FILE_TITLE'] => "required|string",
            $this->constants['KEY_FILE_TYPE'] => "required|integer",
            $this->constants['KEY_UPLOAD_FILE'] => "required|max:5200|mimes:pdf,jpg,png,jpeg"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }
        $user = JWTAuth::toUser($request->token);

        $patientStatus = $user->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        $report = new PatientReport();
        $report->patient_id = $user->id;
        $report->title = $request->get($this->constants['KEY_FILE_TITLE']);
        $report->type = $request->get($this->constants['KEY_FILE_TYPE']);

        $reportFolder = 'reportImages';

        if (!Storage::exists($reportFolder)) {
            Storage::makeDirectory($reportFolder);
        }

        $imageUrl = Storage::putFile($reportFolder, new File($request->file($this->constants['KEY_UPLOAD_FILE'])));

        $report->image_url = $imageUrl;

        $report->save();

        $reportListing = PatientReport::where('patient_id', $user->id)->get();

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Attachment Uploaded.";
//        $response['report'] = $report;
        $response['reportListing'] = $reportListing;

        return response()->json($response);
    }

    public function deleteAttachment(Request $request)
    {
        $rules = [
            $this->constants['KEY_ATTACHMENT_ID'] => "required|integer",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        $user = JWTAuth::toUser($request->token);

        $patientStatus = $user->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        $report = PatientReport::find($request->get($this->constants['KEY_ATTACHMENT_ID']));

        if ($report == null) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_OTHER_ERROR'],
                'message' => "Record Not Found",
            ]);
        }

        if (Storage::exists($report->image_url)) {
            Storage::delete($report->image_url);
        }

        $report->delete();
        $reportListing = PatientReport::where('patient_id', $user->id)->get();

        return response()->json([
            'status' => $this->responseConstants['STATUS_SUCCESS'],
            'message' => "Attachment Deleted.",
            'reportListing' => $reportListing,
        ]);
    }

    public function getPaymentList(Request $request)
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

        $payments = Payment::select('patient_id', 'practitioner_id', 'appointment_id', 'transaction_id', 'date', 'payment_type', 'amount', 'payment_method', 'payment_status', 'transaction_ref_number')
            ->where('patient_id', $user->id)->with(['patient' => function ($query) {
                $query->select('id', 'name');
            }, 'practitioner' => function ($query) {
                $query->select('id', 'name');
            }, 'appointment' => function ($query) {
                $query->select('id', 'date', 'time_slot', 'type', 'status');
            }])->orderBy('id', 'DESC')
            ->skip($offset)
            ->take($this->recordsPerPage)->get();

        $totalRecords = Payment::where('patient_id', $user->id)
            ->count();

        $totalPages = ceil($totalRecords / $this->recordsPerPage);

        $currentPage = (int)$request->get($this->generalConstants['KEY_PAGE_NO']);

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['payments'] = $payments;
        $response['currentPage'] = $currentPage;
        $response['totalPages'] = $totalPages;
        return response()->json($response);
    }

    public function getNotifications(Request $request)
    {
        $response = [];
        $user = JWTAuth::toUser($request->token);

        $patientStatus = $user->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        $notifications = Notification::where(['user_id' => $user->id, 'user_type' => 1])->get();

        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['notifications'] = $notifications;
        return response()->json($response);
    }

    public function notificationDelete(Request $request)
    {

        $rules = [
            $this->constants['KEY_NOTIFICATION_ID'] => "required|integer",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_ERROR'],
                'message' => $this->responseConstants['INVALID_PARAMETERS'],
                'errors' => $validator->errors()->first(),
            ]);
        }

        $user = JWTAuth::toUser($request->token);

        $patientStatus = $user->_check();
        if ($patientStatus != null) {
            return response()->json($patientStatus);
        }

        $notification = Notification::find($request->get($this->constants['KEY_NOTIFICATION_ID']));

        if ($notification == null) {
            return response()->json([
                'status' => $this->responseConstants['STATUS_OTHER_ERROR'],
                'message' => "Record Not Found",
            ]);
        }

        $notification->delete();

        return response()->json([
            'status' => $this->responseConstants['STATUS_SUCCESS'],
            'message' => "Notification Deleted.",
        ]);
    }
}

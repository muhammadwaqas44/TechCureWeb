<?php

namespace App\Http\Controllers\API\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Qualification;
use Config;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class PractitionerController extends Controller
{
    private $generalConstants;
    private $responseConstants;
    private $constants;
    private $recordsPerPage = 20;

    public function __construct()
    {
        $this->constants = Config::get('constants.PRACTITIONER_CONSTANTS');
        $this->generalConstants = Config::get('constants.GENERAL_CONSTANTS');
        $this->responseConstants = Config::get('constants.RESPONSE_CONSTANTS');
    }

    public function getAllQualifications(Request $request)
    {
        $response = [];
        $qualifications = Qualification::select('id', 'title')->where('status', 1)->orderBy('title', 'ASC')->get();
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['qualifications'] = $qualifications;
        return response()->json($response);
    }

    public function getAllClinics(Request $request)
    {
        $response = [];
        $clinics = Clinic::select('id', 'name')->where('status', 1)->orderBy('name', 'ASC')->get();
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['clinics'] = $clinics;
        return response()->json($response);
    }
}

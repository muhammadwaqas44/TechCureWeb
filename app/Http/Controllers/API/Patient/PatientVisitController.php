<?php

namespace App\Http\Controllers\API\Patient;

use App\Http\Controllers\Controller;
use App\Models\Adr;
use App\Models\Appointment;
use App\Models\FamilyMedicalHistory;
use App\Models\History;
use App\Models\PastMedicalHistory;
use App\Models\PastSurgicalHistory;
use App\Models\Patient;
use App\Models\PatientLabTest;
use App\Models\PatientReferralPractitioner;
use App\Models\PatientReport;
use App\Models\PatientSugarChart;
use App\Models\PatientVisit;
use App\Models\PatientVisitPrescription;
use App\Models\PatientVital;
use App\Models\PhysicalExamination;
use App\Models\Practitioner;
use App\Models\ReviewSystem;
use App\Models\RXMedicine;
use App\Models\SmokingHistory;
use Config;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class PatientVisitController extends Controller
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

    public function patientPreviousVisits(Request $request)
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
        $patientVisits = PatientVisit::select('id', 'status', 'created_at')
            ->where('patient_id', $user->id)
            ->orderBy('id', 'DESC')
            ->skip($offset)
            ->take($this->recordsPerPage)
            ->get();
        $totalRecords = PatientVisit::select('id', 'status', 'created_at')
            ->where('patient_id', $user->id)
            ->count();
        $totalPages = ceil($totalRecords / $this->recordsPerPage);
        $currentPage = (int)$request->get($this->generalConstants['KEY_PAGE_NO']);
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['patientVisits'] = $patientVisits;
        $response['currentPage'] = $currentPage;
        $response['totalPages'] = $totalPages;
        return response()->json($response);
    }

    public function patientPreviousVisitDetail(Request $request)
    {
        $response = [];
        $user = JWTAuth::toUser($request->token);
        $userStatus = $user->_check();
        if ($userStatus != null) {
            return response()->json($userStatus);
        }
        $id = $request->patient_visit_id;
        $patientVitals = PatientVital::where('patient_visit_id', $id)->first();
        $patientReferTo = PatientReferralPractitioner::select('referral_practitioner_name')->where('patient_visit_id', $id)->first();
        $patientVisit = PatientVisit::where('id', $id)->first();
        $practitioner = Practitioner::with('specialties')->where('id', $patientVisit->practitioner_id)->first();
        $patientReports = PatientReport::select('id', 'title', 'type', 'image_url','created_at')->where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $patient = Patient::where('id', $patientVisit->patient_id)->first();
        $patientSugarChart = PatientSugarChart::where('patient_visit_id', $id)->first();
        $patientAppointment = Appointment::with('payment')->where('id', $patientVisit->appointment_id)->first();
        $patientPrescriptions = PatientVisitPrescription::select('prescription')->where('patient_visit_id', $id)->first();
        $patientPhysicalExaminations = PhysicalExamination::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $patientPastMedicalHistories = PastMedicalHistory::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $patientPastSurgicalHistories = PastSurgicalHistory::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $patientFamilyMedicalHistories = FamilyMedicalHistory::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $adrs = Adr::with('reactions.reaction')->where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $rxMedicines = RXMedicine::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $smokingHistory = SmokingHistory::where('patient_id', $patientVisit->patient_id)->first();
        $patientLabTests = PatientLabTest::where('patient_id', $patientVisit->patient_id)->orderBy('id', 'DESC')->get();
        $ros = ReviewSystem::where(['patient_id' =>$patientVisit->patient_id])->first();
        $history = History::where(['patient_id' => $patientVisit->patient_id])->first();
        $response['status'] = $this->responseConstants['STATUS_SUCCESS'];
        $response['message'] = "Success";
        $response['practitioner'] = $practitioner;
        $response['ros'] = $ros;
        $response['history'] = $history;
        $response['patient'] = $patient;
        $response['patientVitals'] = $patientVitals;
        $response['patientReferTo'] = $patientReferTo;
        $response['patientVisit'] = $patientVisit;
        $response['patientReports'] = $patientReports;
        $response['patientSugarChart'] = $patientSugarChart;
        $response['patientAppointment'] = $patientAppointment;
        $response['patientPrescriptions'] = $patientPrescriptions;
        $response['patientPhysicalExaminations'] = $patientPhysicalExaminations;
        $response['patientPastMedicalHistories'] = $patientPastMedicalHistories;
        $response['patientPastSurgicalHistories'] = $patientPastSurgicalHistories;
        $response['patientFamilyMedicalHistories'] = $patientFamilyMedicalHistories;
        $response['adrs'] = $adrs;
        $response['rxMedicines'] = $rxMedicines;
        $response['smokingHistory'] = $smokingHistory;
        $response['patientLabTests'] = $patientLabTests;
        return response()->json($response);
    }
}

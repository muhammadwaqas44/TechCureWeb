<?php

namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\Adr;
use App\Models\AdrReaction;
use App\Models\Appointment;
use App\Models\DiagnosisType;
use App\Models\Disease;
use App\Models\Dose;
use App\Models\Drug;
use App\Models\Duration;
use App\Models\FamilyMedicalHistory;
use App\Models\Frequency;
use App\Models\History;
use App\Models\Lab;
use App\Models\LabTest;
use App\Models\LabTestType;
use App\Models\Medication;
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
use App\Models\PhysicalExam;
use App\Models\PhysicalExamination;
use App\Models\Practitioner;
use App\Models\PractitionerLabTest;
use App\Models\PrescriptionTemplate;
use App\Models\Reaction;
use App\Models\Relation;
use App\Models\ReviewSystem;
use App\Models\RXMedicine;
use App\Models\SmokingHistory;
use App\Models\Surgery;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use PDF;
use Storage;
use URL;
use Validator;

class PatientVisitController extends Controller
{
    public function manageAppointment(Request $request, $patientId, $appointmentId, $practitionerId)
    {
        $patient = Patient::find($patientId);
        $appointment = Appointment::find($appointmentId);
        $practitioner = Practitioner::find($practitionerId);
        $physicalExams = PhysicalExam::select('id', 'title')->orderBy('title')->where('status', 1)->get();
        $diseases = Disease::select('id', 'title')->orderBy('title')->where('status', 1)->get();
        $surgeries = Surgery::select('id', 'title')->orderBy('title')->where('status', 1)->get();
        $relations = Relation::select('id', 'title')->orderBy('title')->where('status', 1)->get();
        $drugs = Drug::select('id', 'title')->orderBy('title')->where(['status' => 1, 'deleted_at' => null])->get();
        $reactions = Reaction::select('id', 'title')->orderBy('title')->where(['status' => 1, 'deleted_at' => null])->get();
        $prescriptionTemplate = PrescriptionTemplate::where(['practitioner_id' => $practitionerId, 'status' => 1]);
        $prescriptionTemplateAll = $prescriptionTemplate->get();
        $medicines = Medication::select('id', 'title', 'generic_name')->orderBy('title')->where('status', 1)->get();
        $doses = Dose::select('id', 'dose')->orderBy('dose')->where('status', 1)->get();
        $units = Unit::select('id', 'unit')->orderBy('unit')->where('status', 1)->get();
        $frequencies = Frequency::select('id', 'frequency')->orderBy('frequency')->where('status', 1)->get();
        $durations = Duration::select('id', 'duration')->orderBy('duration')->where('status', 1)->get();
        $diagnosisTypes = DiagnosisType::select('id', 'type')->orderBy('type')->where('status', 1)->get();
        $prescriptionTemplateFavourites = $prescriptionTemplate->where('is_favourite', 1)->take(8)->get();
        $referalDoctors = Practitioner::where([['id', '!=', Auth::guard('practitioner')->user()->id], ['status', 1]])->get();
        $physicalExamination = PhysicalExamination::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId]);
        $pastMedicalHistory = PastMedicalHistory::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId]);
        $pastSurgicalHistory = PastSurgicalHistory::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId]);
        $familyMedicalHistory = FamilyMedicalHistory::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId]);
        $rxMedicine = RXMedicine::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId]);
        $patientVisit = PatientVisit::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId, 'appointment_id' => $appointmentId])->orderBy('id', 'DESC');
        $patientVisitGet = $patientVisit->first();
        $patientVisitCount = PatientVisit::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId])->count();


        if ($patientVisitGet == null) {
            $dataPatientVisit = [
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'appointment_id' => $appointment->id,
                'visit_number' => (int)$patientVisitCount + 1,
            ];
            $patientVisit = PatientVisit::create($dataPatientVisit);
        } else {
            $patientVisit = $patientVisitGet;
        }
        $patientVital = PatientVital::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId]);
        $smokingHistory = SmokingHistory::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId])->first();
        $physicalExaminationVisitGets = $physicalExamination->get();
        $pastMedicalHistoryVisitGets = $pastMedicalHistory->get();
        $pastSurgicalHistoryVisitGets = $pastSurgicalHistory->get();
        $familyMedicalHistoryVisitGets = $familyMedicalHistory->get();
        $adrGets = Adr::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId])->get();
        $rxMedicineVisitGets = $rxMedicine->get();
        $patientVitalVisitGets = $patientVital->where('patient_visit_id', $patientVisit->id)->first();
        $patientVisitLabTests = PatientLabTest::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId, 'patient_visit_id' => $patientVisit->id])->get();
        $patientSugarChart = PatientSugarChart::where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId, 'patient_visit_id' => $patientVisit->id]);
        $labs = Lab::where('status', 1)->get();
        $labTests = LabTest::where('status', 1)->get();
        $labTestsFavourites = PractitionerLabTest::with('labTest')->get();
        $patientSugarChartVisitGets = $patientSugarChart->where('patient_visit_id', $patientVisit->id)->first();
        $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $patientVisit->id)->first();

        $patientVisitPrevious = PatientVisit::
//        whereHas('appointment', function ($q) {
//            $q->where('status', 5);
//        })->
        where(['practitioner_id' => $practitionerId, 'patient_id' => $patientId, ['id', '!=', $patientVisit->id]])->orderBy('id', 'DESC')->get();

        $ros = ReviewSystem::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->first();
        $history = History::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->first();
        $patientReferPractitioners = PatientReferralPractitioner::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->get();
        $labTestTypes = LabTestType::orderBy('title')->where(['status' => 1])->get();
        return view('practitioner.patient.patientVisit', [
            'patient' => $patient,
            'appointment' => $appointment,
            'practitioner' => $practitioner,
            'patientVisit' => $patientVisit,
            'physicalExams' => $physicalExams,
            'diseases' => $diseases,
            'surgeries' => $surgeries,
            'relations' => $relations,
            'labs' => $labs,
            'labTests' => $labTests,
            'labTestsFavourites' => $labTestsFavourites,
            'patientVisitLabTests' => $patientVisitLabTests,
            'drugs' => $drugs,
            'reactions' => $reactions,
            'referalDoctors' => $referalDoctors,
            'prescriptionTemplateAll' => $prescriptionTemplateAll,
            'prescriptionTemplateFavourites' => $prescriptionTemplateFavourites,
            'physicalExaminationVisitGets' => $physicalExaminationVisitGets,
            'pastMedicalHistoryVisitGets' => $pastMedicalHistoryVisitGets,
            'pastSurgicalHistoryVisitGets' => $pastSurgicalHistoryVisitGets,
            'familyMedicalHistoryVisitGets' => $familyMedicalHistoryVisitGets,
            'smokingHistory' => $smokingHistory,
            'adrGets' => $adrGets,
            'patientVisitPrescription' => $patientVisitPrescription,
            'medicines' => $medicines,
            'doses' => $doses,
            'units' => $units,
            'frequencies' => $frequencies,
            'durations' => $durations,
            'diagnosisTypes' => $diagnosisTypes,
            'rxMedicineVisitGets' => $rxMedicineVisitGets,
            'patientVitalVisitGets' => $patientVitalVisitGets,
            'patientSugarChart' => $patientSugarChartVisitGets,
            'patientVisitPrevious' => $patientVisitPrevious,
            'ros' => $ros,
            'history' => $history,
            'patientReferPractitioners' => $patientReferPractitioners,
            'labTestTypes' => $labTestTypes,
        ]);
    }

    public function physicalExamsModelPost(Request $request)
    {
        $this->validate($request, [
            'physical_exams' => 'required',
        ], [
            'physical_exams.required' => 'Please add Physical Exams',
        ]);

        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        $formData = [];
        foreach ($request->physical_exams as $key => $value) {
            $formData[$value] = $request->remarks[$key];
        }
        PhysicalExamination::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->delete();
        foreach ($formData as $keyData => $valueData) {
            $physicalExam = PhysicalExam::find($keyData);
            $physicalExamimation = PhysicalExamination::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'physical_exam_id' => $keyData])->first();
            if ($physicalExamimation == null) {
                $data = [
                    'patient_visit_id' => $patientVisit->id,
                    'practitioner_id' => $practitioner->id,
                    'practitioner_name' => $practitioner->name,
                    'patient_id' => $patient->id,
                    'patient_name' => $patient->name,
                    'physical_exam_id' => $keyData,
                    'physical_exam_name' => $physicalExam->title,
                    'description' => $valueData,
                ];
                $physicalExamimation = PhysicalExamination::create($data);
            }
        }
        return response()->json(['result' => 'success', 'message' => 'Physical Exam Added Successfully.']);
    }

    public function pastMedicalHistoriesModelPost(Request $request)
    {
        $this->validate($request, [
            'diseases' => 'required',
        ], [
            'diseases.required' => 'Please add Diseases',
        ]);

        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        PastMedicalHistory::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->delete();

        $pastMedicalHistoryData = [];
        foreach ($request->diseases as $key => $disease) {
            $pastMedicalHistoryData[$key] = [
                'disease' => $disease,
                'no_of_years' => $request->no_of_years[$key],
                'year' => $request->year[$key],
                'remarks' => $request->remarks[$key],
            ];
        }

        foreach ($pastMedicalHistoryData as $pastMedicalHistory) {
            $disease = Disease::find($pastMedicalHistory['disease']);
            $data = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'disease_id' => $disease->id,
                'disease_name' => $disease->title,
                'no_of_years' => $pastMedicalHistory['no_of_years'],
                'year' => $pastMedicalHistory['year'],
                'remarks' => $pastMedicalHistory['remarks'],
            ];
            $pastMedicalHistory = PastMedicalHistory::create($data);
        }
        return response()->json(['result' => 'success', 'message' => 'Past Medical History Added Successfully.']);
    }

    public function pastSurgicalHistoriesModelPost(Request $request)
    {

        $this->validate($request, [
            'surgeries' => 'required',
        ], [
            'surgeries.required' => 'Please add Surgeries',
        ]);

        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        PastSurgicalHistory::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->delete();

        $pastSurgicalHistoryData = [];
        foreach ($request->surgeries as $key => $surgery) {
            $pastSurgicalHistoryData[$key] = [
                'surgery' => $surgery,
                'no_of_years' => $request->no_of_years[$key],
                'year' => $request->year[$key],
                'remarks' => $request->remarks[$key],
            ];
        }

        foreach ($pastSurgicalHistoryData as $pastSurgicalHistory) {
            $surgery = Surgery::find($pastSurgicalHistory['surgery']);
            $data = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'surgery_id' => $surgery->id,
                'surgery_name' => $surgery->title,
                'no_of_years' => $pastSurgicalHistory['no_of_years'],
                'year' => $pastSurgicalHistory['year'],
                'remarks' => $pastSurgicalHistory['remarks'],
            ];
            $pastSurgicalHistory = PastSurgicalHistory::create($data);
        }
        return response()->json(['result' => 'success', 'message' => 'Past Surgical History Added Successfully.']);
    }

    public function familyMedicalHistoriesModelPost(Request $request)
    {
        $this->validate($request, [
            'relations' => 'required',
            'diseases' => 'required',
        ], [
            'relations.required' => 'Please add Relations',
            'diseases.required' => 'Please add Diseases',
        ]);

        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        FamilyMedicalHistory::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->delete();

        $familyMedicalHistoryData = [];
        foreach ($request->diseases as $key => $disease) {
            $familyMedicalHistoryData[$key] = [
                'disease' => $disease,
                'relation' => $request->relations[$key],
                'no_of_years' => $request->no_of_years[$key],
                'year' => $request->year[$key],
                'remarks' => $request->remarks[$key],
                'deceased_status' => $request->deceased_status[$key],
            ];
        }

        foreach ($familyMedicalHistoryData as $familyMedicalHistory) {
            $disease = Disease::find($familyMedicalHistory['disease']);
            $relation = Relation::find($familyMedicalHistory['relation']);
            $data = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'relation_id' => $relation->id,
                'relation_name' => $relation->title,
                'disease_id' => $disease->id,
                'disease_name' => $disease->title,
                'no_of_years' => $familyMedicalHistory['no_of_years'],
                'year' => $familyMedicalHistory['year'],
                'remarks' => $familyMedicalHistory['remarks'],
                'deceased_status' => $familyMedicalHistory['deceased_status'],
            ];
            $familyMedicalHistory = FamilyMedicalHistory::create($data);
        }
        return response()->json(['result' => 'success', 'message' => 'Family Medical History Added Successfully.']);
    }

    public function patientHistoryModelPost(Request $request)
    {
        $this->validate($request, [
            'history' => 'required',
        ], [
            'history.required' => 'Patient history is required.',
        ]);
        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        $history = History::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->first();
        if ($history == null) {
            $data = [
                "patient_id" => $patient->id,
                "patient_name" => $patient->name,
                "practitioner_id" => $practitioner->id,
                "practitioner_name" => $practitioner->name,
                "patient_visit_id" => $patientVisit->id,
                'description' => $request->history,
            ];
            History::create($data);
        } else {
            $history->update([
                'description' => $request->history,
            ]);
        }

        return response()->json(['result' => 'success', 'message' => 'Patient History Added Successfully.']);
    }

    public function rosModelPost(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        $ros = ReviewSystem::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->first();
        if ($ros == null) {
            $data = [
                "patient_id" => $patient->id,
                "patient_name" => $patient->name,
                "practitioner_id" => $practitioner->id,
                "practitioner_name" => $practitioner->name,
                "patient_visit_id" => $patientVisit->id,
                'first_description' => $request->rs_first_description,
                'second_description' => $request->rs_second_description,
                'third_description' => $request->rs_third_description,
            ];
            ReviewSystem::create($data);
        } else {
            $ros->update([
                'first_description' => $request->rs_first_description,
                'second_description' => $request->rs_second_description,
                'third_description' => $request->rs_third_description,
            ]);
        }
        return response()->json(['result' => 'success', 'message' => 'Review System Added Successfully.']);
    }

    public function smokingModelPost(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        $smokingHistpry = SmokingHistory::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->delete();

        if (isset($request->ever_smoke)) {
            $ever_smoke = 1;
        } else {
            $ever_smoke = 0;
        }
        if (isset($request->still_smoke)) {
            if ($request->still_smoke == 0) {
                $still_smoke = 0;
                $no_of_years = null;
                $cig_per_day = null;
            } else {
                $still_smoke = 1;
                $no_of_years = $request->years;
                $cig_per_day = $request->cig_day;
            }
        } else {
            $still_smoke = 0;
            $no_of_years = null;
            $cig_per_day = null;
        }
        if (isset($request->ever_drink)) {
            $ever_drink = 1;
        } else {
            $ever_drink = 0;
        }
        if (isset($request->still_drink)) {
            $still_drink = 1;
        } else {
            $still_drink = 0;
        }
        if (isset($request->ever_use_drugs)) {
            $ever_use_drugs = 1;
        } else {
            $ever_use_drugs = 0;
        }
        if (isset($request->still_use_drugs)) {
            $still_use_drugs = 1;
        } else {
            $still_use_drugs = 0;
        }
        if ($patientVisit) {
            SmokingHistory::create([
                "ever_smoke" => $ever_smoke,
                "still_smoke" => $still_smoke,
                "no_of_years" => $no_of_years,
                "cig_per_day" => $cig_per_day,
                "ever_drink" => $ever_drink,
                "still_drink" => $still_drink,
                "drink_remarks" => $request->drink_remarks,
                "ever_use_drugs" => $ever_use_drugs,
                "still_use_drugs" => $still_use_drugs,
                "what_drug_use" => $request->what_drug_use,
                "how_use_drug" => $request->how_use_drug,
                "patient_id" => $patient->id,
                "patient_name" => $patient->name,
                "practitioner_id" => $practitioner->id,
//                "practitioner_name " => $practitioner->name,
                "patient_visit_id" => $patientVisit->id,
            ]);
            return response()->json(['result' => 'success', 'message' => 'Smoking History Added Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Visit Record Found.']);
        }
    }

    public function getReactionslist(Request $request)
    {
        $reations = Reaction::where("drug_id", $request->drug_id)->get();
        if ($reations == null) {
            return response()->json(['result' => 'error', 'message' => 'Not Reactions Found!']);
        }

        return response()->json(['result' => 'success', 'reactions' => $reations]);
    }

    public function adrModelPost(Request $request)
    {
        $this->validate($request, [
            'drugs' => 'required',
            'reactions' => 'required',
        ], [
            'drugs.required' => 'Please add Medicine',
            'reactions.required' => 'Please add Frequency',
        ]);

        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        $adrsDel = Adr::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id]);
        $adrIds = $adrsDel->pluck('id');

        $adrReactionDel = AdrReaction::whereIn('adr_id', $adrIds)->delete();
        $adrsDel->delete();
//        dd($request->all());
        foreach ($request->drugs as $key => $value) {
            $drug = Drug::find($value);
            $adrData = [
                'drug_id' => $drug->id,
                'drug_name' => $drug->title,
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
            ];
            $adrCreated = Adr::create($adrData);
            if ($adrCreated) {
                foreach ($request->reactions[$key] as $reaction) {
                    $reactionData = [
                        'adr_id' => $adrCreated->id,
                        'reaction_id' => $reaction,
                    ];
                    $adrCreactionCreated = AdrReaction::create($reactionData);
                }
            }
        }

        return response()->json(['result' => 'success', 'message' => 'ADR Added Successfully.']);
    }

    public function getPresciptionTemplate(Request $request)
    {

        $template = PrescriptionTemplate::where("id", $request->template_id)->first();
        if ($template == null) {
            return response()->json(['result' => 'error', 'message' => 'Not Template Found!']);
        }

        return response()->json(['result' => 'success', 'template' => $template]);
    }

    public function submitVisitPresciptionTemplateNOte(Request $request)
    {
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        if ($patientVisit) {
            $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $patientVisit->id)->first();
            if ($patientVisitPrescription) {
                $patientVisitPrescription->prescription = $request->visit_template;
                $patientVisitPrescription->save();
            } else {
                PatientVisitPrescription::create([
                    'patient_visit_id' => $patientVisit->id,
                    'prescription' => $request->visit_template,
                ]);
            }
            return response()->json(['result' => 'success', 'message' => 'Data Saved Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Visit Record Found.']);
        }
    }

    public function doctorNoteInternalPatientVisit(Request $request)
    {
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        if ($patientVisit) {
            $patientVisit->notes_internal = $request->doctor_notes_internal;
            $patientVisit->save();

            return response()->json(['result' => 'success', 'message' => 'Data Saved Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Visit Record Found.']);
        }
    }

    public function doctorNotePrintedPatientVisit(Request $request)
    {
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        if ($patientVisit) {
            $patientVisit->notes_printed = $request->doctor_notes_printed;
            $patientVisit->save();

            return response()->json(['result' => 'success', 'message' => 'Data Saved Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Visit Record Found.']);
        }
    }

    public function updatePatientStatusOnVisit(Request $request)
    {
        $patient = Patient::find($request->patient_id);

        if ($patient) {
            if ($request->status == 'black_list') {
                $patient->time_waste_flag_condition = 1;
                $patient->critical_flag_condition = 0;
            }
            if ($request->status == 'critical_list') {
                $patient->time_waste_flag_condition = 0;
                $patient->critical_flag_condition = 1;
            }
            $patient->save();
            return response()->json(['result' => 'success', 'message' => 'Flag Condition Update Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Record Found.']);
        }
    }

    public function savePatientReferalDoctor(Request $request)
    {
//        dd($request->all());
        $patientRefer = PatientReferralPractitioner::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'referral_practitioner_id' => $request->refer_doctor_id])->first();
        if ($patientRefer) {
            $patientRefer->delete();
        }
        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        $patientReferDoctor = Practitioner::where('id', $request->refer_doctor_id)->first();
        if ($patientReferDoctor) {
            $data = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'referral_practitioner_id' => $patientReferDoctor->id,
                'referral_practitioner_name' => $patientReferDoctor->name
            ];
            $patientReferCreated = PatientReferralPractitioner::create($data);
            return response()->json(['result' => 'success', 'message' => 'Referal Doctor Added Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Referal Doctor Record Found.']);
        }
    }

    public function saveNextVisit(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($request->visit_days == null) {
            $visit_days = $patientVisit->next_visit;
        } else {
            $visit_days = $request->visit_days;
        }
        if ($request->visit_next_date == null) {
            $visit_next_date = $patientVisit->next_visit_date;
        } else {
            $visit_next_date = Carbon::parse($request->visit_next_date)->format('Y-m-d');
        }

        if ($patientVisit) {
            $patientVisit->next_visit_date = $visit_next_date;
            $patientVisit->next_visit = $visit_days;
            $patientVisit->total_duration = $request->run_time;
            $patientVisit->save();
            return response()->json(['result' => 'success', 'message' => 'Next Visit Date Saved Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Visit Record Found.']);
        }

    }

    public function rxMedicinesModelPost(Request $request)
    {
        $this->validate($request, [
            'medicines' => 'required',
            'frequencies' => 'required',
            'durations' => 'required',
            'diagnosis_types' => 'required',
        ], [
            'medicines.required' => 'Please add Medicine',
            'frequencies.required' => 'Please add Frequency',
            'durations.required' => 'Please add Duration',
            'diagnosis_types.required' => 'Please add Diagnosis Type',
        ]);

        $patient = Patient::find($request->patient_id);
        $appointment = Appointment::find($request->appointment_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        RXMedicine::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->delete();

        $rxMedicineData = [];
        foreach ($request->medicines as $key => $medicines) {
            $rxMedicineData[$key] = [
                'medicines' => $medicines,
                'doses' => $request->doses[$key],
                'units' => $request->units[$key],
                'frequencies' => $request->frequencies[$key],
                'durations' => $request->durations[$key],
                'diagnosis_types' => $request->diagnosis_types[$key],
            ];
        }

        foreach ($rxMedicineData as $rxMedicine) {
            $medicine = Medication::find($rxMedicine['medicines']);
            if ($rxMedicine['doses'] != null) {
                $dose = Dose::find($rxMedicine['doses']);
                $doseID = $dose->id;
                $doseName = $dose->dose;
            } else {
                $doseID = null;
                $doseName = null;
            }
            if ($rxMedicine['units'] != null) {
                $unit = Unit::find($rxMedicine['units']);
                $unitID = $unit->id;
                $unitName = $unit->unit;
            } else {
                $unitID = null;
                $unitName = null;
            }
            $frequency = Frequency::find($rxMedicine['frequencies']);
            $duration = Duration::find($rxMedicine['durations']);
            $diagnosisType = DiagnosisType::find($rxMedicine['diagnosis_types']);
            $data = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'medicine_id' => $medicine->id,
                'medicine_name' => $medicine->title,
                'dose_id' => $doseID,
                'dose_name' => $doseName,
                'unit_id' => $unitID,
                'unit_name' => $unitName,
                'frequency_id' => $frequency->id,
                'frequency_name' => $frequency->frequency,
                'duration_id' => $duration->id,
                'duration_name' => $duration->duration,
                'diagnosis_type_id' => $diagnosisType->id,
                'diagnosis_type_name' => $diagnosisType->type,
            ];
            $rxMedicine = RXMedicine::create($data);
        }
        return response()->json(['result' => 'success', 'message' => 'RX Medicine Added Successfully.']);
    }

    public function getRXMedicineFieldsValues(Request $request)
    {
        $medicine = Medication::where('id', $request->medicine_id)->first();
        if ($medicine == null) {
            return response()->json(['result' => 'error', 'message' => 'Not Medicine Found!']);
        }

        return response()->json(['result' => 'success', 'medicine' => $medicine]);
    }

    public function bpSysPatientVisit(Request $request)
    {
        if ($request->bp_sys > 200) {
            return response()->json(['result' => 'error', 'message' => 'BP Sys must be less than 200']);
        }
        $rules = [
            'bp_sys' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BP Sys must be number.']);
        }

        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bp_sys' => $request->bp_sys,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bp_sys' => $request->bp_sys]);
        }
        return response()->json(['result' => 'success', 'message' => 'BP Sys Added Successfully!']);
    }

    public function bpDiasPatientVisit(Request $request)
    {
        if ($request->bp_dias > 200) {
            return response()->json(['result' => 'error', 'message' => 'BP Dias must be less than 200']);
        }
        $rules = [
            'bp_dias' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BP Dias must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bp_dias' => $request->bp_dias,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bp_dias' => $request->bp_dias]);
        }
        return response()->json(['result' => 'success', 'message' => 'BP Dias Added Successfully!']);
    }

    public function pulsePatientVisit(Request $request)
    {
        if ($request->pulse > 200) {
            return response()->json(['result' => 'error', 'message' => 'Pulse must be less than 200']);
        }
        $rules = [
            'pulse' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Pulse must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'pulse' => $request->pulse,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['pulse' => $request->pulse]);
        }
        return response()->json(['result' => 'success', 'message' => 'Pulse Added Successfully!']);
    }

    public function weightLbsPatientVisit(Request $request)
    {
        if ($request->weight_lbs > 2000) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Pounds must be less than 2000']);
        }
        $rules = [
            'weight_lbs' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Pounds must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'weight_lbs' => $request->weight_lbs,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['weight_lbs' => $request->weight_lbs, 'weight_kgs' => null]);
        }
        return response()->json(['result' => 'success', 'message' => 'Weight in Pounds Added Successfully!']);
    }

    public function weightKgsPatientVisit(Request $request)
    {
        if ($request->weight_kgs > 2000) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Kilograms must be less than 2000']);
        }
        $rules = [
            'weight_kgs' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Kilograms must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'weight_kgs' => $request->weight_kgs,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['weight_kgs' => $request->weight_kgs, 'weight_lbs' => null]);
        }
        return response()->json(['result' => 'success', 'message' => 'Weight in Kilograms Added Successfully!']);
    }

    public function heightFtPatientVisit(Request $request)
    {
        if ($request->height_ft > 10) {
            return response()->json(['result' => 'error', 'message' => 'Height in Feet must be less than 10']);
        }
        $rules = [
            'height_ft' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Height in Feet must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'height_ft' => $request->height_ft,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['height_ft' => $request->height_ft, 'height_cms' => null]);
        }
        return response()->json(['result' => 'success', 'message' => 'Height in Feet Added Successfully!']);
    }

    public function heightInPatientVisit(Request $request)
    {
        if ($request->height_in > 11) {
            return response()->json(['result' => 'error', 'message' => 'Height in Inches must be less than 12']);
        }
        $rules = [
            'height_in' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Height in Inches must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'height_in' => $request->height_in,
                'bmi' => $request->bmi,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['height_in' => $request->height_in, 'height_cms' => null, 'bmi' => $request->bmi]);
        }
        return response()->json(['result' => 'success', 'message' => 'Height in Inches Added Successfully!']);
    }

    public function heightCmsPatientVisit(Request $request)
    {
        if ($request->height_cms > 300) {
            return response()->json(['result' => 'error', 'message' => 'Height in Centimeters must be less than 300']);
        }
        $rules = [
            'height_cms' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Height in Centimeters must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'height_cms' => $request->height_cms,
                'bmi' => $request->bmi,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['height_cms' => $request->height_cms, 'height_ft' => null, 'height_in' => null, 'bmi' => $request->bmi]);
        }
        return response()->json(['result' => 'success', 'message' => 'Height in Centimeters Added Successfully!']);
    }

    public function bpSys2PatientVisit(Request $request)
    {
        if ($request->bp_sys_2 > 200) {
            return response()->json(['result' => 'error', 'message' => 'BP Sys must be less than 200']);
        }
        $rules = [
            'bp_sys_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BP Sys must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bp_sys_2' => $request->bp_sys_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bp_sys_2' => $request->bp_sys_2]);
        }
        return response()->json(['result' => 'success', 'message' => 'BP Sys Added Successfully!']);
    }

    public function bpDias2PatientVisit(Request $request)
    {
        if ($request->bp_dias_2 > 200) {
            return response()->json(['result' => 'error', 'message' => 'BP Dias must be less than 200']);
        }
        $rules = [
            'bp_dias_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BP Dias must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bp_dias_2' => $request->bp_dias_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bp_dias_2' => $request->bp_dias_2]);
        }
        return response()->json(['result' => 'success', 'message' => 'BP Dias Added Successfully!']);
    }

    public function pulse2PatientVisit(Request $request)
    {
        if ($request->pulse_2 > 200) {
            return response()->json(['result' => 'error', 'message' => 'Pulse must be less than 200']);
        }
        $rules = [
            'pulse_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Pulse must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'pulse_2' => $request->pulse_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['pulse_2' => $request->pulse_2]);
        }
        return response()->json(['result' => 'success', 'message' => 'Pulse Added Successfully!']);
    }

    public function weightLbs2PatientVisit(Request $request)
    {
        if ($request->weight_lbs_2 > 2000) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Pounds must be less than 2000']);
        }
        $rules = [
            'weight_lbs_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Pounds must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'weight_lbs_2' => $request->weight_lbs_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['weight_lbs_2' => $request->weight_lbs_2, 'weight_kgs_2' => null]);
        }
        return response()->json(['result' => 'success', 'message' => 'Weight in Pounds Added Successfully!']);
    }

    public function weightKgs2PatientVisit(Request $request)
    {
        if ($request->weight_kgs_2 > 2000) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Kilograms must be less than 2000']);
        }
        $rules = [
            'weight_kgs_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Weight in Kilograms must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'weight_kgs_2' => $request->weight_kgs_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['weight_kgs_2' => $request->weight_kgs_2, 'weight_lbs_2' => null]);
        }
        return response()->json(['result' => 'success', 'message' => 'Weight in Kilograms Added Successfully!']);
    }

    public function heightFt2PatientVisit(Request $request)
    {
        if ($request->height_ft_2 > 10) {
            return response()->json(['result' => 'error', 'message' => 'Height in Feet must be less than 10']);
        }
        $rules = [
            'height_ft_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Height in Feet must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'height_ft_2' => $request->height_ft_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['height_ft_2' => $request->height_ft_2, 'height_cms_2' => null]);
        }
        return response()->json(['result' => 'success', 'message' => 'Height in Feet Added Successfully!']);
    }

    public function heightIn2PatientVisit(Request $request)
    {
        if ($request->height_in_2 > 11) {
            return response()->json(['result' => 'error', 'message' => 'Height in Inches must be less than 12']);
        }
        $rules = [
            'height_in_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Height in Inches must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'height_in_2' => $request->height_in_2,
                'bmi_2' => $request->bmi_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['height_in_2' => $request->height_in_2, 'height_cms_2' => null, 'bmi_2' => $request->bmi_2]);
        }
        return response()->json(['result' => 'success', 'message' => 'Height in Inches Added Successfully!']);
    }

    public function heightCms2PatientVisit(Request $request)
    {
        if ($request->height_cms_2 > 300) {
            return response()->json(['result' => 'error', 'message' => 'Height in Centimeters must be less than 300']);
        }
        $rules = [
            'height_cms_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'Height in Centimeters must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bmi_2' => $request->bmi_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['height_cms_2' => $request->height_cms_2, 'height_ft_2' => null, 'height_in_2' => null, 'bmi_2' => $request->bmi_2]);
        }
        return response()->json(['result' => 'success', 'message' => 'Height in Centimeters Added Successfully!']);
    }

    public function saveLabTestPatientVisit(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        $patientLabTestGet = PatientLabTest::where([
            'practitioner_id' => $request->practitioner_id,
            'patient_id' => $request->patient_id,
            'lab_test_id' => $request->lab_test_id, 'patient_visit_id' => $patientVisit->id])->first();
        if ($patientLabTestGet) {
            return response()->json(['result' => 'already', 'message' => 'Lab Test Already Added.']);
        }

        $labTest = LabTest::where('id', $request->lab_test_id)->first();
        if ($labTest) {
            $data = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'lab_test_id' => $labTest->id,
                'lab_test_name' => $labTest->title,
                'type_id' => $labTest->type_id,
                'fasting' => $labTest->fasting,
                'instructions' => $labTest->instructions,
                'recommended_lab' => $labTest->lab_id,
            ];
            $patientLabTestCreated = PatientLabTest::create($data);
            $patientLabTestRecord = PatientLabTest::where('id', $patientLabTestCreated->id)->with(['recommendedLabTest', 'typeTest'])->first();
            return response()->json(['result' => 'added', 'message' => 'Lab Test Added Successfully.', 'record' => $patientLabTestRecord]);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Lab Test Record Found.']);
        }
    }

    public function deleteLabTestPatientVisit(Request $request)
    {
        $patientLabTestGet = PatientLabTest::where('id', $request->id)->first();
        if ($patientLabTestGet) {
            $patientLabTestGet->delete();
            return response()->json(['result' => 'success', 'message' => 'Lab Test deleted Successfully.']);

        } else {
            return response()->json(['result' => 'error', 'message' => 'No Lab Test Record Found.']);
        }
    }

    public function updatePatientLabTestModelPost(Request $request)
    {
        $this->validate($request, [
            'lab_test_id' => 'required',
            'type_id' => 'required',
            'fasting' => 'required',
        ], [
            'lab_test_id.required' => 'Please add Lab Test.',
            'type.required' => 'Please add Diagnosis Type',
            'fasting.required' => 'Please add Fasting Condition',
        ]);

        $patientLabTest = PatientLabTest::where('id', $request->patient_lab_test_id)->first();
        if ($patientLabTest) {
            $labTest = LabTest::where('id', $request->lab_test_id)->first();
            if ($labTest == null) {
                return response()->json(['result' => 'error', 'message' => 'No Lab Test Record Found.']);
            }
            $data = ['lab_test_id' => $labTest->id,
                'lab_test_name' => $labTest->title,
                'type_id' => $request->type_id,
                'fasting' => $request->fasting,
                'instructions' => $request->instructions,
                'recommended_lab' => $request->recommended_lab
            ];

            $update = $patientLabTest->update($data);
            $dataLabTest = PatientLabTest::where('id', $patientLabTest->id)->with(['recommendedLabTest', 'typeTest'])->first();
            return response()->json(['result' => 'success', 'message' => 'Patient Lab Test updated Successfully.', 'record' => $dataLabTest]);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Lab Test Record Found.']);
        }
    }

    public function bsfPatientVisit(Request $request)
    {
        if ($request->bsf > 200) {
            return response()->json(['result' => 'error', 'message' => 'BSF must be less than 200']);
        }
        $rules = [
            'bsf' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BSF must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bsf' => $request->bsf,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bsf' => $request->bsf]);
        }
        return response()->json(['result' => 'success', 'message' => 'BSF Added Successfully!']);
    }

    public function bsrPatientVisit(Request $request)
    {
        if ($request->bsr > 500) {
            return response()->json(['result' => 'error', 'message' => 'BSR must be less than 500']);
        }
        $rules = [
            'bsr' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BSR must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bsr' => $request->bsr,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bsr' => $request->bsr]);
        }
        return response()->json(['result' => 'success', 'message' => 'BSR Added Successfully!']);
    }

    public function bsf2PatientVisit(Request $request)
    {
        if ($request->bsf_2 > 200) {
            return response()->json(['result' => 'error', 'message' => 'BSF must be less than 200']);
        }
        $rules = [
            'bsf_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BSF must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bsf_2' => $request->bsf_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bsf_2' => $request->bsf_2]);
        }
        return response()->json(['result' => 'success', 'message' => 'BSF Added Successfully!']);
    }

    public function bsr2PatientVisit(Request $request)
    {
        if ($request->bsr_2 > 500) {
            return response()->json(['result' => 'error', 'message' => 'BSR must be less than 500']);
        }
        $rules = [
            'bsr_2' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => 'BSR must be number.']);
        }
        $patientVital = PatientVital::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientVital == null) {
            $patientVitalData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bsr_2' => $request->bsr_2,
            ];

            $patientVitalStore = PatientVital::create($patientVitalData);
        } else {
            $patientVital->update(['bsr_2' => $request->bsr_2]);
        }
        return response()->json(['result' => 'success', 'message' => 'BSR Added Successfully!']);
    }

    public function checkSugarChart(Request $request)
    {
// dd($request->all());
        $patientSugarChart = PatientSugarChart::where(['practitioner_id' => $request->practitioner_id, 'patient_id' => $request->patient_id, 'patient_visit_id' => $request->patient_visit_id])->first();

        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::find($request->patient_visit_id);

        if ($patientSugarChart == null) {
            $patientSugarChartData = [
                'patient_visit_id' => $patientVisit->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
            ];

            if ($request->has('day_1_before_breakfast')) {
                $patientSugarChartData['day_1_before_breakfast'] = $request->day_1_before_breakfast;
            }
            if ($request->has('day_2_before_breakfast')) {
                $patientSugarChartData['day_2_before_breakfast'] = $request->day_2_before_breakfast;
            }
            if ($request->has('day_3_before_breakfast')) {
                $patientSugarChartData['day_3_before_breakfast'] = $request->day_3_before_breakfast;
            }
            if ($request->has('day_4_before_breakfast')) {
                $patientSugarChartData['day_4_before_breakfast'] = $request->day_4_before_breakfast;
            }
            if ($request->has('day_5_before_breakfast')) {
                $patientSugarChartData['day_5_before_breakfast'] = $request->day_5_before_breakfast;
            }
            if ($request->has('day_6_before_breakfast')) {
                $patientSugarChartData['day_6_before_breakfast'] = $request->day_6_before_breakfast;
            }
            if ($request->has('day_7_before_breakfast')) {
                $patientSugarChartData['day_7_before_breakfast'] = $request->day_7_before_breakfast;
            }
            if ($request->has('day_1_2_hours_after_breakfast')) {
                $patientSugarChartData['day_1_2_hours_after_breakfast'] = $request->day_1_2_hours_after_breakfast;
            }
            if ($request->has('day_2_2_hours_after_breakfast')) {
                $patientSugarChartData['day_2_2_hours_after_breakfast'] = $request->day_2_2_hours_after_breakfast;
            }
            if ($request->has('day_3_2_hours_after_breakfast')) {
                $patientSugarChartData['day_3_2_hours_after_breakfast'] = $request->day_3_2_hours_after_breakfast;
            }
            if ($request->has('day_4_2_hours_after_breakfast')) {
                $patientSugarChartData['day_4_2_hours_after_breakfast'] = $request->day_4_2_hours_after_breakfast;
            }
            if ($request->has('day_5_2_hours_after_breakfast')) {
                $patientSugarChartData['day_5_2_hours_after_breakfast'] = $request->day_5_2_hours_after_breakfast;
            }
            if ($request->has('day_6_2_hours_after_breakfast')) {
                $patientSugarChartData['day_6_2_hours_after_breakfast'] = $request->day_6_2_hours_after_breakfast;
            }
            if ($request->has('day_7_2_hours_after_breakfast')) {
                $patientSugarChartData['day_7_2_hours_after_breakfast'] = $request->day_7_2_hours_after_breakfast;
            }
            if ($request->has('day_1_before_lunch')) {
                $patientSugarChartData['day_1_before_lunch'] = $request->day_1_before_lunch;
            }
            if ($request->has('day_2_before_lunch')) {
                $patientSugarChartData['day_2_before_lunch'] = $request->day_2_before_lunch;
            }
            if ($request->has('day_3_before_lunch')) {
                $patientSugarChartData['day_3_before_lunch'] = $request->day_3_before_lunch;
            }
            if ($request->has('day_4_before_lunch')) {
                $patientSugarChartData['day_4_before_lunch'] = $request->day_4_before_lunch;
            }
            if ($request->has('day_5_before_lunch')) {
                $patientSugarChartData['day_5_before_lunch'] = $request->day_5_before_lunch;
            }
            if ($request->has('day_6_before_lunch')) {
                $patientSugarChartData['day_6_before_lunch'] = $request->day_6_before_lunch;
            }
            if ($request->has('day_7_before_lunch')) {
                $patientSugarChartData['day_7_before_lunch'] = $request->day_7_before_lunch;
            }
            if ($request->has('day_1_2_hours_after_lunch')) {
                $patientSugarChartData['day_1_2_hours_after_lunch'] = $request->day_1_2_hours_after_lunch;
            }
            if ($request->has('day_2_2_hours_after_lunch')) {
                $patientSugarChartData['day_2_2_hours_after_lunch'] = $request->day_2_2_hours_after_lunch;
            }
            if ($request->has('day_3_2_hours_after_lunch')) {
                $patientSugarChartData['day_3_2_hours_after_lunch'] = $request->day_3_2_hours_after_lunch;
            }
            if ($request->has('day_4_2_hours_after_lunch')) {
                $patientSugarChartData['day_4_2_hours_after_lunch'] = $request->day_4_2_hours_after_lunch;
            }
            if ($request->has('day_5_2_hours_after_lunch')) {
                $patientSugarChartData['day_5_2_hours_after_lunch'] = $request->day_5_2_hours_after_lunch;
            }
            if ($request->has('day_6_2_hours_after_lunch')) {
                $patientSugarChartData['day_6_2_hours_after_lunch'] = $request->day_6_2_hours_after_lunch;
            }
            if ($request->has('day_7_2_hours_after_lunch')) {
                $patientSugarChartData['day_7_2_hours_after_lunch'] = $request->day_7_2_hours_after_lunch;
            }
            if ($request->has('day_1_before_dinner')) {
                $patientSugarChartData['day_1_before_dinner'] = $request->day_1_before_dinner;
            }
            if ($request->has('day_2_before_dinner')) {
                $patientSugarChartData['day_2_before_dinner'] = $request->day_2_before_dinner;
            }
            if ($request->has('day_3_before_dinner')) {
                $patientSugarChartData['day_3_before_dinner'] = $request->day_3_before_dinner;
            }
            if ($request->has('day_4_before_dinner')) {
                $patientSugarChartData['day_4_before_dinner'] = $request->day_4_before_dinner;
            }
            if ($request->has('day_5_before_dinner')) {
                $patientSugarChartData['day_5_before_dinner'] = $request->day_5_before_dinner;
            }
            if ($request->has('day_6_before_dinner')) {
                $patientSugarChartData['day_6_before_dinner'] = $request->day_6_before_dinner;
            }
            if ($request->has('day_7_before_dinner')) {
                $patientSugarChartData['day_7_before_dinner'] = $request->day_7_before_dinner;
            }
            if ($request->has('day_1_2_hours_after_dinner')) {
                $patientSugarChartData['day_1_2_hours_after_dinner'] = $request->day_1_2_hours_after_dinner;
            }
            if ($request->has('day_2_2_hours_after_dinner')) {
                $patientSugarChartData['day_2_2_hours_after_dinner'] = $request->day_2_2_hours_after_dinner;
            }
            if ($request->has('day_3_2_hours_after_dinner')) {
                $patientSugarChartData['day_3_2_hours_after_dinner'] = $request->day_3_2_hours_after_dinner;
            }
            if ($request->has('day_4_2_hours_after_dinner')) {
                $patientSugarChartData['day_4_2_hours_after_dinner'] = $request->day_4_2_hours_after_dinner;
            }
            if ($request->has('day_5_2_hours_after_dinner')) {
                $patientSugarChartData['day_5_2_hours_after_dinner'] = $request->day_5_2_hours_after_dinner;
            }
            if ($request->has('day_6_2_hours_after_dinner')) {
                $patientSugarChartData['day_6_2_hours_after_dinner'] = $request->day_6_2_hours_after_dinner;
            }
            if ($request->has('day_7_2_hours_after_dinner')) {
                $patientSugarChartData['day_7_2_hours_after_dinner'] = $request->day_7_2_hours_after_dinner;
            }
            if ($request->has('day_1_bed_time')) {
                $patientSugarChartData['day_1_bed_time'] = $request->day_1_bed_time;
            }
            if ($request->has('day_2_bed_time')) {
                $patientSugarChartData['day_2_bed_time'] = $request->day_2_bed_time;
            }
            if ($request->has('day_3_bed_time')) {
                $patientSugarChartData['day_3_bed_time'] = $request->day_3_bed_time;
            }
            if ($request->has('day_4_bed_time')) {
                $patientSugarChartData['day_4_bed_time'] = $request->day_4_bed_time;
            }
            if ($request->has('day_5_bed_time')) {
                $patientSugarChartData['day_5_bed_time'] = $request->day_5_bed_time;
            }
            if ($request->has('day_6_bed_time')) {
                $patientSugarChartData['day_6_bed_time'] = $request->day_6_bed_time;
            }
            if ($request->has('day_7_bed_time')) {
                $patientSugarChartData['day_7_bed_time'] = $request->day_7_bed_time;
            }
            if ($request->has('day_1_at_3_am')) {
                $patientSugarChartData['day_1_at_3_am'] = $request->day_1_at_3_am;
            }
            if ($request->has('day_2_at_3_am')) {
                $patientSugarChartData['day_2_at_3_am'] = $request->day_2_at_3_am;
            }
            if ($request->has('day_3_at_3_am')) {
                $patientSugarChartData['day_3_at_3_am'] = $request->day_3_at_3_am;
            }
            if ($request->has('day_4_at_3_am')) {
                $patientSugarChartData['day_4_at_3_am'] = $request->day_4_at_3_am;
            }
            if ($request->has('day_5_at_3_am')) {
                $patientSugarChartData['day_5_at_3_am'] = $request->day_5_at_3_am;
            }
            if ($request->has('day_6_at_3_am')) {
                $patientSugarChartData['day_6_at_3_am'] = $request->day_6_at_3_am;
            }
            if ($request->has('day_7_at_3_am')) {
                $patientSugarChartData['day_7_at_3_am'] = $request->day_7_at_3_am;
            }

            $patientSugarChartStore = PatientSugarChart::create($patientSugarChartData);
        } else {
            if ($request->has('day_1_before_breakfast')) {
                $patientSugarChart->update(['day_1_before_breakfast' => $request->day_1_before_breakfast]);
            }
            if ($request->has('day_2_before_breakfast')) {
                $patientSugarChart->update(['day_2_before_breakfast' => $request->day_2_before_breakfast]);
            }
            if ($request->has('day_3_before_breakfast')) {
                $patientSugarChart->update(['day_3_before_breakfast' => $request->day_3_before_breakfast]);
            }
            if ($request->has('day_4_before_breakfast')) {
                $patientSugarChart->update(['day_4_before_breakfast' => $request->day_4_before_breakfast]);
            }
            if ($request->has('day_5_before_breakfast')) {
                $patientSugarChart->update(['day_5_before_breakfast' => $request->day_5_before_breakfast]);
            }
            if ($request->has('day_6_before_breakfast')) {
                $patientSugarChart->update(['day_6_before_breakfast' => $request->day_6_before_breakfast]);
            }
            if ($request->has('day_7_before_breakfast')) {
                $patientSugarChart->update(['day_7_before_breakfast' => $request->day_7_before_breakfast]);
            }
            if ($request->has('day_1_2_hours_after_breakfast')) {
                $patientSugarChart->update(['day_1_2_hours_after_breakfast' => $request->day_1_2_hours_after_breakfast]);
            }
            if ($request->has('day_2_2_hours_after_breakfast')) {
                $patientSugarChart->update(['day_2_2_hours_after_breakfast' => $request->day_2_2_hours_after_breakfast]);
            }
            if ($request->has('day_3_2_hours_after_breakfast')) {
                $patientSugarChart->update(['day_3_2_hours_after_breakfast' => $request->day_3_2_hours_after_breakfast]);
            }
            if ($request->has('day_4_2_hours_after_breakfast')) {
                $patientSugarChart->update(['day_4_2_hours_after_breakfast' => $request->day_4_2_hours_after_breakfast]);
            }
            if ($request->has('day_5_2_hours_after_breakfast')) {
                $patientSugarChart->update(['day_5_2_hours_after_breakfast' => $request->day_5_2_hours_after_breakfast]);
            }
            if ($request->has('day_6_2_hours_after_breakfast')) {
                $patientSugarChart->update(['day_6_2_hours_after_breakfast' => $request->day_6_2_hours_after_breakfast]);
            }
            if ($request->has('day_7_2_hours_after_breakfast')) {
                $patientSugarChart->update(['day_7_2_hours_after_breakfast' => $request->day_7_2_hours_after_breakfast]);
            }
            if ($request->has('day_1_before_lunch')) {
                $patientSugarChart->update(['day_1_before_lunch' => $request->day_1_before_lunch]);
            }
            if ($request->has('day_2_before_lunch')) {
                $patientSugarChart->update(['day_2_before_lunch' => $request->day_2_before_lunch]);
            }
            if ($request->has('day_3_before_lunch')) {
                $patientSugarChart->update(['day_3_before_lunch' => $request->day_3_before_lunch]);
            }
            if ($request->has('day_4_before_lunch')) {
                $patientSugarChart->update(['day_4_before_lunch' => $request->day_4_before_lunch]);
            }
            if ($request->has('day_5_before_lunch')) {
                $patientSugarChart->update(['day_5_before_lunch' => $request->day_5_before_lunch]);
            }
            if ($request->has('day_6_before_lunch')) {
                $patientSugarChart->update(['day_6_before_lunch' => $request->day_6_before_lunch]);
            }
            if ($request->has('day_7_before_lunch')) {
                $patientSugarChart->update(['day_7_before_lunch' => $request->day_7_before_lunch]);
            }
            if ($request->has('day_1_2_hours_after_lunch')) {
                $patientSugarChart->update(['day_1_2_hours_after_lunch' => $request->day_1_2_hours_after_lunch]);
            }
            if ($request->has('day_2_2_hours_after_lunch')) {
                $patientSugarChart->update(['day_2_2_hours_after_lunch' => $request->day_2_2_hours_after_lunch]);
            }
            if ($request->has('day_3_2_hours_after_lunch')) {
                $patientSugarChart->update(['day_3_2_hours_after_lunch' => $request->day_3_2_hours_after_lunch]);
            }
            if ($request->has('day_4_2_hours_after_lunch')) {
                $patientSugarChart->update(['day_4_2_hours_after_lunch' => $request->day_4_2_hours_after_lunch]);
            }
            if ($request->has('day_5_2_hours_after_lunch')) {
                $patientSugarChart->update(['day_5_2_hours_after_lunch' => $request->day_5_2_hours_after_lunch]);
            }
            if ($request->has('day_6_2_hours_after_lunch')) {
                $patientSugarChart->update(['day_6_2_hours_after_lunch' => $request->day_6_2_hours_after_lunch]);
            }
            if ($request->has('day_7_2_hours_after_lunch')) {
                $patientSugarChart->update(['day_7_2_hours_after_lunch' => $request->day_7_2_hours_after_lunch]);
            }
            if ($request->has('day_1_before_dinner')) {
                $patientSugarChart->update(['day_1_before_dinner' => $request->day_1_before_dinner]);
            }
            if ($request->has('day_2_before_dinner')) {
                $patientSugarChart->update(['day_2_before_dinner' => $request->day_2_before_dinner]);
            }
            if ($request->has('day_3_before_dinner')) {
                $patientSugarChart->update(['day_3_before_dinner' => $request->day_3_before_dinner]);
            }
            if ($request->has('day_4_before_dinner')) {
                $patientSugarChart->update(['day_4_before_dinner' => $request->day_4_before_dinner]);
            }
            if ($request->has('day_5_before_dinner')) {
                $patientSugarChart->update(['day_5_before_dinner' => $request->day_5_before_dinner]);
            }
            if ($request->has('day_6_before_dinner')) {
                $patientSugarChart->update(['day_6_before_dinner' => $request->day_6_before_dinner]);
            }
            if ($request->has('day_7_before_dinner')) {
                $patientSugarChart->update(['day_7_before_dinner' => $request->day_7_before_dinner]);
            }
            if ($request->has('day_1_2_hours_after_dinner')) {
                $patientSugarChart->update(['day_1_2_hours_after_dinner' => $request->day_1_2_hours_after_dinner]);
            }
            if ($request->has('day_2_2_hours_after_dinner')) {
                $patientSugarChart->update(['day_2_2_hours_after_dinner' => $request->day_2_2_hours_after_dinner]);
            }
            if ($request->has('day_3_2_hours_after_dinner')) {
                $patientSugarChart->update(['day_3_2_hours_after_dinner' => $request->day_3_2_hours_after_dinner]);
            }
            if ($request->has('day_4_2_hours_after_dinner')) {
                $patientSugarChart->update(['day_4_2_hours_after_dinner' => $request->day_4_2_hours_after_dinner]);
            }
            if ($request->has('day_5_2_hours_after_dinner')) {
                $patientSugarChart->update(['day_5_2_hours_after_dinner' => $request->day_5_2_hours_after_dinner]);
            }
            if ($request->has('day_6_2_hours_after_dinner')) {
                $patientSugarChart->update(['day_6_2_hours_after_dinner' => $request->day_6_2_hours_after_dinner]);
            }
            if ($request->has('day_7_2_hours_after_dinner')) {
                $patientSugarChart->update(['day_7_2_hours_after_dinner' => $request->day_7_2_hours_after_dinner]);
            }
            if ($request->has('day_1_bed_time')) {
                $patientSugarChart->update(['day_1_bed_time' => $request->day_1_bed_time]);
            }
            if ($request->has('day_2_bed_time')) {
                $patientSugarChart->update(['day_2_bed_time' => $request->day_2_bed_time]);
            }
            if ($request->has('day_3_bed_time')) {
                $patientSugarChart->update(['day_3_bed_time' => $request->day_3_bed_time]);
            }
            if ($request->has('day_4_bed_time')) {
                $patientSugarChart->update(['day_4_bed_time' => $request->day_4_bed_time]);
            }
            if ($request->has('day_5_bed_time')) {
                $patientSugarChart->update(['day_5_bed_time' => $request->day_5_bed_time]);
            }
            if ($request->has('day_6_bed_time')) {
                $patientSugarChart->update(['day_6_bed_time' => $request->day_6_bed_time]);
            }
            if ($request->has('day_7_bed_time')) {
                $patientSugarChart->update(['day_7_bed_time' => $request->day_7_bed_time]);
            }
            if ($request->has('day_1_at_3_am')) {
                $patientSugarChart->update(['day_1_at_3_am' => $request->day_1_at_3_am]);
            }
            if ($request->has('day_2_at_3_am')) {
                $patientSugarChart->update(['day_2_at_3_am' => $request->day_2_at_3_am]);
            }
            if ($request->has('day_3_at_3_am')) {
                $patientSugarChart->update(['day_3_at_3_am' => $request->day_3_at_3_am]);
            }
            if ($request->has('day_4_at_3_am')) {
                $patientSugarChart->update(['day_4_at_3_am' => $request->day_4_at_3_am]);
            }
            if ($request->has('day_5_at_3_am')) {
                $patientSugarChart->update(['day_5_at_3_am' => $request->day_5_at_3_am]);
            }
            if ($request->has('day_6_at_3_am')) {
                $patientSugarChart->update(['day_6_at_3_am' => $request->day_6_at_3_am]);
            }
            if ($request->has('day_7_at_3_am')) {
                $patientSugarChart->update(['day_7_at_3_am' => $request->day_7_at_3_am]);
            }
        }
        return response()->json(['result' => 'success', 'message' => 'Sugar Chart Updated Successfully!']);
    }

    public function patientEditProfileModelPost(Request $request)
    {
        $this->validate($request, [
            'patient_name' => 'required',
            'patient_age' => 'required',
            'patient_gender' => 'required',
            'patient_phone' => 'required',
        ], [
            'patient_name.required' => 'Please add Patient Name',
            'patient_age.required' => 'Please add Patient Age',
            'patient_gender.required' => 'Please add Patient Gender',
            'patient_phone.required' => 'Please add Patient Phone',
        ]);

        $patient = Patient::find($request->patient_id);

        $data = [
            'name' => $request->patient_name,
            'age' => $request->patient_age,
            'gender' => $request->patient_gender,
            'phone' => $request->patient_phone,
            'address' => $request->patient_address,
        ];

        $patientUpdate = $patient->update($data);

        return response()->json(['result' => 'success', 'message' => 'Patient Info Updated Successfully.']);
    }

    public function patientReportUploadModelPost(Request $request)
    {
        $this->validate($request, [
            'file_title' => 'required',
            'file_type' => 'required',
            'upload_file' => 'required',
        ], [
            'file_title.required' => 'Please add File Title',
            'upload_file.required' => 'Please add File to Upload',
        ]);

        $patient = Patient::find($request->patient_id);

        $data = [
            'patient_id' => $patient->id,
            'title' => $request->file_title,
            'type' => $request->file_type,
        ];

        $patientReport = PatientReport::create($data);

        if ($request->hasFile('upload_file')) {
            $reportImagesFolder = 'reportImages';

            if (!Storage::exists($reportImagesFolder)) {
                Storage::makeDirectory($reportImagesFolder);
            }

            $imageUrl = Storage::putFile($reportImagesFolder, new File($request->file('upload_file')));
            $patientReport->update(['image_url' => $imageUrl]);
        }

        return response()->json(['result' => 'success', 'message' => 'Patient Attachment Added Successfully.', 'patientReport' => $patientReport]);
    }

    public function getPreviousVisitDetails(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVisit = PatientVisit::where('id', $request->patient_visit_id)->with('patientVital')->first();
        $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $request->patient_visit_id)->first();

        return response()->json(['result' => 'success', 'patient' => $patient, 'practitioner' => $practitioner, 'patientVisit' => $patientVisit, 'patientVisitPrescription' => $patientVisitPrescription]);
    }

    public function savePreviousVisitDetails(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVital = PatientVital::where('patient_visit_id', $request->patient_visit_id_current)->first();
        $patientVitalPrevious = PatientVital::where('patient_visit_id', $request->patient_visit_id)->first();
        $patientVisitCurrent = PatientVisit::where('id', $request->patient_visit_id_current)->with('patientVital')->first();
        $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $request->patient_visit_id)->first();
        $patientVisitPrescriptionCurrent = PatientVisitPrescription::where('patient_visit_id', $request->patient_visit_id_current)->first();
//        $dataVital = [
//            'patient_visit_id' => $patientVisitCurrent->id,
//            'practitioner_id' => $practitioner->id,
//            'practitioner_name' => $practitioner->name,
//            'patient_id' => $patient->id,
//            'patient_name' => $patient->name,
//            'bp_sys' => $patientVitalPrevious->bp_sys,
//            'bp_dias' => $patientVitalPrevious->bp_dias,
//            'pulse' => $patientVitalPrevious->pulse,
//            'weight_lbs' => $patientVitalPrevious->weight_lbs,
//            'weight_kgs' => $patientVitalPrevious->weight_kgs,
//            'height_ft' => $patientVitalPrevious->height_ft,
//            'height_in' => $patientVitalPrevious->height_in,
//            'height_cms' => $patientVitalPrevious->height_cms,
//            'bmi' => $patientVitalPrevious->bmi,
//            'bsf' => $patientVitalPrevious->bsf,
//            'bsr' => $patientVitalPrevious->bsr,
//            'bp_sys_2' => $patientVitalPrevious->bp_sys_2,
//            'bp_dias_2' => $patientVitalPrevious->bp_dias_2,
//            'pulse_2' => $patientVitalPrevious->pulse_2,
//            'weight_lbs_2' => $patientVitalPrevious->weight_lbs_2,
//            'weight_kgs_2' => $patientVitalPrevious->weight_kgs_2,
//            'height_ft_2' => $patientVitalPrevious->height_ft_2,
//            'height_in_2' => $patientVitalPrevious->height_in_2,
//            'height_cms_2' => $patientVitalPrevious->height_cms_2,
//            'bmi_2' => $patientVitalPrevious->bmi_2,
//            'bsf_2' => $patientVitalPrevious->bsf_2,
//            'bsr_2' => $patientVitalPrevious->bsr_2,
//        ];
//        if ($patientVital) {
//            $patientVital->update($dataVital);
//        } else {
//            PatientVital::create($dataVital);
//        }
        if ($patientVisitPrescription != null) {
            $prescription = $patientVisitPrescription->prescription;
        } else {
            $prescription = null;
        }
        if ($patientVisitPrescriptionCurrent) {
            $patientVisitPrescriptionCurrent->update([
                'prescription' => $prescription,
            ]);
        } else {
            PatientVisitPrescription::create([
                'patient_visit_id' => $patientVisitCurrent->id,
                'prescription' => $prescription,
            ]);
        }

        return response()->json(['result' => 'success', 'message' => 'Data Added Successfully.']);

    }

    public function revisePatientVisit(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $practitioner = Practitioner::find($request->practitioner_id);
        $patientVital = PatientVital::where('patient_visit_id', $request->patient_visit_id_current)->first();
        $patientVitalPrevious = PatientVital::where('patient_visit_id', $request->patient_visit_id)->first();
        $patientVisitPrevious = PatientVisit::where('id', $request->patient_visit_id)->with('patientVital')->first();
        $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $request->patient_visit_id)->first();
        $patientVisitCount = PatientVisit::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->count();

        if ($patientVisitPrevious) {
            $dataPatientVisit = [
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'appointment_id' => $patientVisitPrevious->appointment_id,
                'visit_number' => (int)$patientVisitCount + 1,
                'total_duration' => $patientVisitPrevious->total_duration,
                'notes_internal' => $patientVisitPrevious->notes_internal,
                'notes_printed' => $patientVisitPrevious->notes_printed,
                'status' => 1,
                'revise_of' => Carbon::now(),
                'history' => $patientVisitPrevious->history,
                'rs_first_description' => $patientVisitPrevious->rs_first_description,
                'rs_second_description' => $patientVisitPrevious->rs_second_description,
                'rs_third_description' => $patientVisitPrevious->rs_third_description,
            ];
            $patientVisitCreated = PatientVisit::create($dataPatientVisit);
            $dataVital = [
                'patient_visit_id' => $patientVisitCreated->id,
                'practitioner_id' => $practitioner->id,
                'practitioner_name' => $practitioner->name,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'bp_sys' => $patientVitalPrevious->bp_sys,
                'bp_dias' => $patientVitalPrevious->bp_dias,
                'pulse' => $patientVitalPrevious->pulse,
                'weight_lbs' => $patientVitalPrevious->weight_lbs,
                'weight_kgs' => $patientVitalPrevious->weight_kgs,
                'height_ft' => $patientVitalPrevious->height_ft,
                'height_in' => $patientVitalPrevious->height_in,
                'height_cms' => $patientVitalPrevious->height_cms,
                'bmi' => $patientVitalPrevious->bmi,
                'bsf' => $patientVitalPrevious->bsf,
                'bsr' => $patientVitalPrevious->bsr,
                'bp_sys_2' => $patientVitalPrevious->bp_sys_2,
                'bp_dias_2' => $patientVitalPrevious->bp_dias_2,
                'pulse_2' => $patientVitalPrevious->pulse_2,
                'weight_lbs_2' => $patientVitalPrevious->weight_lbs_2,
                'weight_kgs_2' => $patientVitalPrevious->weight_kgs_2,
                'height_ft_2' => $patientVitalPrevious->height_ft_2,
                'height_in_2' => $patientVitalPrevious->height_in_2,
                'height_cms_2' => $patientVitalPrevious->height_cms_2,
                'bmi_2' => $patientVitalPrevious->bmi_2,
                'bsf_2' => $patientVitalPrevious->bsf_2,
                'bsr_2' => $patientVitalPrevious->bsr_2,
            ];
            if ($patientVitalPrevious) {
                PatientVital::create($dataVital);
            }

            if ($patientVisitPrescription) {
                PatientVisitPrescription::create([
                    'patient_visit_id' => $patientVisitCreated->id,
                    'prescription' => $patientVisitPrescription->prescription,
                ]);
            }

            return response()->json(['result' => 'success', 'message' => 'Visit Revised Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Previous Visit Record Found.']);

        }
    }

    public function saveDurationVisit(Request $request)
    {
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        if ($patientVisit) {
            $patientVisit->total_duration = $request->run_time;
            $patientVisit->save();
            return response()->json(['result' => 'success', 'message' => 'Duration Saved Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Visit Record Found.']);
        }
    }

    public function saveVisitPresciptionTemplate(Request $request)
    {
        $var = strip_tags($request->visit_template);
        $expload = explode(' ', $var);
        $practitioner = Auth::guard('practitioner')->user();
        $patientVisit = PatientVisit::find($request->patient_visit_id);
        $title = $expload[0] . ' ' . $expload[1] . ' ' . $expload[2] . ' ' . $expload[3] . '-' . (Carbon::now()->format('Y-m-d h:i A'));
        if ($patientVisit) {
            $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $patientVisit->id)->first();
            if ($patientVisitPrescription) {
                $patientVisitPrescription->prescription = $request->visit_template;
                $patientVisitPrescription->save();

                $prescriptionTemplateData = [
                    'title' => $title,
                    'slug' => Str::slug($title, '-'),
                    'description' => $request->visit_template,
                    'practitioner_id' => $practitioner->id,
                    'practitioner_name' => $practitioner->name,
                    'is_favourite' => 0,
                    'status' => 1,
                ];

                $prescriptionTemplate = PrescriptionTemplate::create($prescriptionTemplateData);
            } else {
                PatientVisitPrescription::create([
                    'patient_visit_id' => $patientVisit->id,
                    'prescription' => $request->visit_template,
                ]);
                $prescriptionTemplateData = [
                    'title' => $title,
                    'slug' => Str::slug($title, '-'),
                    'description' => $request->visit_template,
                    'practitioner_id' => $practitioner->id,
                    'practitioner_name' => $practitioner->name,
                    'is_favourite' => 0,
                    'status' => 1,
                ];

                $prescriptionTemplate = PrescriptionTemplate::create($prescriptionTemplateData);
            }
            return response()->json(['result' => 'success', 'message' => 'Data Saved Successfully.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'No Patient Visit Record Found.']);
        }
    }

    public function sendToPatientReport(Request $request, $patientId, $appointmentId, $practitionerId)
    {
        $patient = Patient::find($patientId);
        $appointment = Appointment::find($appointmentId);
        $practitioner = Practitioner::find($practitionerId);

        $patientVisit = PatientVisit::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'appointment_id' => $appointment->id])->first();

        $patientVitals = PatientVital::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->first();

        $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $patientVisit->id)->first();

        $patientLabTests = PatientLabTest::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->orderBy('id', 'ASC')->get();

        $patientRXMedicines = RXMedicine::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->orderBy('id', 'ASC')->get();

        $patientPastMedicalHistories = PastMedicalHistory::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->orderBy('id', 'ASC')->get();

        $patientAdrs = ADR::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->orderBy('id', 'ASC')->get();

        $patientSugarChart = PatientSugarChart::where('patient_visit_id', $patientVisit->id)->first();
        $patientReferPractitioners = PatientReferralPractitioner::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->get();

        $generatePDF = PDF::loadView('practitioner.patient.patientVisitReportPDF', array('patient' => $patient, 'patientVisit' => $patientVisit, 'practitioner' => $practitioner, 'appointment' => $appointment, 'patientVitals' => $patientVitals, 'patientVisitPrescription' => $patientVisitPrescription, 'patientLabTests' => $patientLabTests, 'patientSugarChart' => $patientSugarChart, 'patientRXMedicines' => $patientRXMedicines, 'patientPastMedicalHistories' => $patientPastMedicalHistories, 'patientAdrs' => $patientAdrs, 'patientReferPractitioners' => $patientReferPractitioners));

        // $currentDateTime = date('YmdHis');
        $filename = $appointment->id . '.pdf';

        // $destinationPath = 'reports';
        // if(file_exists($destinationPath.'/'.$filename))
        // {
        //     File::delete($destinationPath.'/'.$filename);
        // }

        $pdf = $generatePDF->save('reports/' . $filename);
        if ($pdf) {
            $patientVisit->update(['pdf_report' => $filename]);
        }

//        if ($pdf) {
//            $patientVisit->update(['pdf_report' => $filename]);
//            $phone = str_replace('-', '', $appointment->patient->phone);
//            $phone = substr($phone, 1);
//            $phone = '92' . $phone;
//            $doctor = str_replace(' ', '', $appointment->practitioner->name);
//            $time = str_replace(' ', '', $appointment->time_slot);
//            $link = URL::to('/') . '/reports/' . $patientVisit->pdf_report;
//
//            $message = 'Your%20appointment%20is%20done%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($appointment->date)) . ')%20at%20(' . $time . ').%20Download%20your%20prescription%20from%20this%20link%0a' . $link;
//
//            $curl = curl_init();
//
//            $curlSet = curl_setopt_array($curl, array(
//                CURLOPT_URL => "http://api.bizsms.pk/api-send-branded-sms.aspx?username=eonhc@bizsms.pk&pass=e3th3rt9&text=" . $message . "&masking=SMS%20Alert&destinationnum=" . $phone . "&language=English",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "GET",
//
//            ));
//            $response = curl_exec($curl);
//            curl_close($curl);
//        }

        return view('practitioner.patient.patientVisitReport', ['patient' => $patient, 'patientVisit' => $patientVisit, 'appointment' => $appointment, 'practitioner' => $practitioner, 'patientVitals' => $patientVitals, 'patientVisitPrescription' => $patientVisitPrescription, 'patientLabTests' => $patientLabTests, 'patientSugarChart' => $patientSugarChart, 'patientRXMedicines' => $patientRXMedicines, 'patientPastMedicalHistories' => $patientPastMedicalHistories, 'patientAdrs' => $patientAdrs]);
    }

    public function patientReportPreview(Request $request, $patientId, $appointmentId, $practitionerId)
    {
        $patient = Patient::find($patientId);
        $appointment = Appointment::find($appointmentId);
        $practitioner = Practitioner::find($practitionerId);

//        $appointment->where('id', $appointment->id)->update(['status' => 5]);

        $patientVisit = PatientVisit::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'appointment_id' => $appointment->id])->first();

        $patientVitals = PatientVital::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->first();

        $patientVisitPrescription = PatientVisitPrescription::where('patient_visit_id', $patientVisit->id)->first();

        $patientLabTests = PatientLabTest::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->orderBy('id', 'ASC')->get();

        $patientRXMedicines = RXMedicine::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->orderBy('id', 'ASC')->get();

        $patientPastMedicalHistories = PastMedicalHistory::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->orderBy('id', 'ASC')->get();

        $patientAdrs = ADR::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id])->orderBy('id', 'ASC')->get();

        $patientSugarChart = PatientSugarChart::where('patient_visit_id', $patientVisit->id)->first();
        $patientReferPractitioners = PatientReferralPractitioner::where(['practitioner_id' => $practitioner->id, 'patient_id' => $patient->id, 'patient_visit_id' => $patientVisit->id])->get();

        return view('practitioner.patient.patientVisitReportPreview', ['patient' => $patient, 'patientVisit' => $patientVisit, 'practitioner' => $practitioner, 'appointment' => $appointment, 'patientVitals' => $patientVitals, 'patientVisitPrescription' => $patientVisitPrescription, 'patientLabTests' => $patientLabTests, 'patientSugarChart' => $patientSugarChart, 'patientRXMedicines' => $patientRXMedicines, 'patientPastMedicalHistories' => $patientPastMedicalHistories, 'patientAdrs' => $patientAdrs, 'patientReferPractitioners' => $patientReferPractitioners]);
    }

    public function showPdfFile($id)
    {
        $report = PatientReport::find($id);
        $path = storage_path() . '/app/public/' . $report->image_url;
        return response()->file($path);
    }

    public function sendSMSOnVisit($patientVisitId)
    {

        $patientVisit = PatientVisit::find($patientVisitId);
        $appointment = Appointment::find($patientVisit->appointment->id);
        if ($patientVisit && $appointment) {
            $appointment->where('id', $appointment->id)->update(['status' => 5, 'appointment_complete' => 1, 'practitioner_start' => 1]);

            $phone = str_replace('-', '', $patientVisit->patient->phone);
            $phone = substr($phone, 1);
            $phone = '92' . $phone;
            $doctor = str_replace(' ', '', $patientVisit->appointment->practitioner->name);
            $time = str_replace(' ', '', $patientVisit->appointment->time_slot);
            $link = URL::to('/') . '/reports/' . $patientVisit->pdf_report;

            $message = 'Your%20appointment%20is%20done%20with%20' . $doctor . '%20on%20(' . date('d-m-Y', strtotime($patientVisit->appointment->date)) . ')%20at%20(' . $time . ').%20Download%20your%20prescription%20from%20this%20link%0a' . $link;

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

        return response()->json('Message Send To Patient Successfully.');
    }

}


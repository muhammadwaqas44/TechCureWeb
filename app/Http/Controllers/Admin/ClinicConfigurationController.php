<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use App\Models\Clinic;
use App\Models\ClinicConfiguration;
use App\Models\ClinicConfigurationFacility;
use App\Models\ClinicConfigurationLabTest;
use App\Models\ClinicConfigurationMedication;
use App\Models\ClinicConfigurationSpecialty;
use App\Models\LabTest;
use App\Models\Medication;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class ClinicConfigurationController extends Controller
{

    public function index()
    {
        $clinicConfigurations = ClinicConfiguration::orderBy('id', 'DESC')->where('deleted_at', null)->get();

        return view('admin.clinicConfiguration.index', ['clinicConfigurations' => $clinicConfigurations, 'title' => 'Clinic Configurations']);
    }


    public function create()
    {
        $clinics = Clinic::orderBy('name')->where('status', 1)->get();
        $facilities = Facility::orderBy('title')->where('status', 1)->get();
        $labTests = LabTest::orderBy('title')->where('status', 1)->get();
        $medications = Medication::orderBy('title')->where('status', 1)->get();
        $specialties = Specialty::orderBy('title')->where('status', 1)->get();

        return view('admin.clinicConfiguration.create', ['title' => 'Create Clinic Configuration', 'clinics' => $clinics, 'facilities' => $facilities, 'labTests' => $labTests, 'medications' => $medications, 'specialties' => $specialties]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:191',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        $clinic = Clinic::find($request->clinic_id);
        if ($clinic) {
            $clinicData = [
                'key' => $request->title,
                'slug' => Str::slug($request->input('title'), '-'),
                'clinic_id' => $clinic->id,
                'clinic_name' => $clinic->name,
            ];

            $clinicConfig = ClinicConfiguration::create($clinicData);

            if ($clinicConfig) {
                if ($request->lab_tests) {
                    foreach ($request->lab_tests as $lab_test) {
                        $labTestData = LabTest::find($lab_test);
                        if ($labTestData) {
                            ClinicConfigurationLabTest::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'lab_test_id' => $lab_test,
                                'lab_test_name' => $labTestData->title,
                            ]);
                        }
                    }
                }
                if ($request->facilities) {
                    foreach ($request->facilities as $facility) {
                        $facilityData = Facility::find($facility);
                        if ($facilityData) {
                            ClinicConfigurationFacility::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'facility_id' => $facility,
                                'facility_name' => $facilityData->title,
                            ]);
                        }
                    }
                }
                if ($request->medications) {
                    foreach ($request->medications as $medication) {
                        $medicationData = Medication::find($medication);
                        if ($medicationData) {
                            ClinicConfigurationMedication::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'medication_id' => $medication,
                                'medication_name' => $medicationData->title,
                            ]);
                        }
                    }
                }
                if ($request->specialties) {
                    foreach ($request->specialties as $specialty) {
                        $specialtyData = Specialty::find($specialty);
                        if ($specialtyData) {
                            ClinicConfigurationSpecialty::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'specialty_id' => $specialty,
                                'specialty_name' => $specialtyData->title,
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('clinicConfigurationList')->with('success-message', 'Record Added Successfully.');
    }


    //edit facility
    public function edit($id)
    {
        $clinicConfig = ClinicConfiguration::find($id);
        if($clinicConfig)
        {
            $clinics = Clinic::orderBy('name')->where('status', 1)->get();
            $facilities = Facility::orderBy('title')->where('status', 1)->get();
            $labTests = LabTest::orderBy('title')->where('status', 1)->get();
            $medications = Medication::orderBy('title')->where('status', 1)->get();
            $specialties = Specialty::orderBy('title')->where('status', 1)->get();
            return view('admin.clinicConfiguration.edit', ['title' => 'Edit Clinic Configuration', 'clinics' => $clinics, 'clinicConfig' => $clinicConfig, 'facilities' => $facilities, 'labTests' => $labTests, 'medications' => $medications, 'specialties' => $specialties]);
        }
        else
        {
            return redirect()->route('adminDashboard')->with('error-message', 'No Configuration Found.');
        }
    }

    public function update(Request $request)
    {
        $clinicConfig = ClinicConfiguration::find($request->clinic_config_id);
        $rules = [
            'title' => 'required|max:191',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        $clinic = Clinic::find($request->clinic_id);
        if ($clinic) {
            $clinicData = [
                'key' => $request->title,
                'slug' => Str::slug($request->input('title'), '-'),
                'clinic_id' => 1,
                'clinic_name' => $clinic->name,
            ];


            $clinicConfig->update($clinicData);
            if ($clinicConfig) {
                if ($request->lab_tests) {
                    ClinicConfigurationLabTest::where(['clinic_config_id' => $clinicConfig->id])->delete();
                    foreach ($request->lab_tests as $lab_test) {
                        $labTestData = LabTest::find($lab_test);
                        if ($labTestData) {
                            ClinicConfigurationLabTest::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'lab_test_id' => $lab_test,
                                'lab_test_name' => $labTestData->title,
                            ]);
                        }
                    }
                }
                if ($request->facilities) {
                    ClinicConfigurationFacility::where(['clinic_config_id' => $clinicConfig->id])->delete();
                    foreach ($request->facilities as $facility) {
                        $facilityData = Facility::find($facility);
                        if ($facilityData) {
                            ClinicConfigurationFacility::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'facility_id' => $facility,
                                'facility_name' => $facilityData->title,
                            ]);
                        }
                    }
                }
                if ($request->medications) {
                    ClinicConfigurationMedication::where(['clinic_config_id' => $clinicConfig->id])->delete();
                    foreach ($request->medications as $medication) {
                        $medicationData = Medication::find($medication);
                        if ($medicationData) {
                            ClinicConfigurationMedication::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'medication_id' => $medication,
                                'medication_name' => $medicationData->title,
                            ]);
                        }
                    }
                }
                if ($request->specialties) {
                    ClinicConfigurationSpecialty::where(['clinic_config_id' => $clinicConfig->id])->delete();
                    foreach ($request->specialties as $specialty) {
                        $specialtyData = Specialty::find($specialty);
                        if ($specialtyData) {
                            ClinicConfigurationSpecialty::create([
                                'clinic_config_id' => $clinicConfig->id,
                                'specialty_id' => $specialty,
                                'specialty_name' => $specialtyData->title,
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('adminDashboard')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request)
    {

        $clinicConfig = ClinicConfiguration::find($request->id);

        if ($clinicConfig == null) {
            return response()->json(['status' => 0]);
        }

        $clinicConfig->delete();

        return response()->json(['status' => 1]);
    }


}

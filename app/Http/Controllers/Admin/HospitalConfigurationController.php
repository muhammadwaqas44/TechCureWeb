<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use App\Models\Hospital;
use App\Models\HospitalConfiguration;
use App\Models\HospitalConfigurationFacility;
use App\Models\HospitalConfigurationLabTest;
use App\Models\HospitalConfigurationMedication;
use App\Models\HospitalConfigurationSpecialty;
use App\Models\LabTest;
use App\Models\Medication;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class HospitalConfigurationController extends Controller
{

    public function index()
    {
        $hospitalConfigurations = HospitalConfiguration::orderBy('id', 'DESC')->where('deleted_at', null)->get();

        return view('admin.hospitalConfiguration.index', ['hospitalConfigurations' => $hospitalConfigurations, 'title' => 'Hospital Configurations']);
    }


    public function create()
    {
        $hospitals = Hospital::orderBy('title')->where('status', 1)->get();
        $facilities = Facility::orderBy('title')->where('status', 1)->get();
        $labTests = LabTest::orderBy('title')->where('status', 1)->get();
        $medications = Medication::orderBy('title')->where('status', 1)->get();
        $specialties = Specialty::orderBy('title')->where('status', 1)->get();

        return view('admin.hospitalConfiguration.create', ['title' => 'Create Hospital Configuration', 'hospitals' => $hospitals, 'facilities' => $facilities, 'labTests' => $labTests, 'medications' => $medications, 'specialties' => $specialties]);
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
        $hospital = Hospital::find(1);
        if ($hospital) {
            $hospitalData = [
                'key' => $request->title,
                'slug' => Str::slug($request->input('title'), '-'),
                'hospital_id' => $hospital->id,
                'hospital_name' => $hospital->title,
            ];

            $hospitalConfig = HospitalConfiguration::create($hospitalData);

            if ($hospitalConfig) {
                if ($request->lab_tests) {
                    foreach ($request->lab_tests as $lab_test) {
                        $labTestData = LabTest::find($lab_test);
                        if ($labTestData) {
                            HospitalConfigurationLabTest::create([
                                'hospital_config_id' => $hospitalConfig->id,
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
                            HospitalConfigurationFacility::create([
                                'hospital_config_id' => $hospitalConfig->id,
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
                            HospitalConfigurationMedication::create([
                                'hospital_config_id' => $hospitalConfig->id,
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
                            HospitalConfigurationSpecialty::create([
                                'hospital_config_id' => $hospitalConfig->id,
                                'specialty_id' => $specialty,
                                'specialty_name' => $specialtyData->title,
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('hospitalConfigurationList')->with('success-message', 'Record Added Successfully.');
    }


    //edit facility
    public function edit($id)
    {
        $hospitalConfig = HospitalConfiguration::find($id);
        if($hospitalConfig)
        {
            $facilities = Facility::orderBy('title')->where('status', 1)->get();
            $labTests = LabTest::orderBy('title')->where('status', 1)->get();
            $medications = Medication::orderBy('title')->where('status', 1)->get();
            $specialties = Specialty::orderBy('title')->where('status', 1)->get();
            return view('admin.hospitalConfiguration.edit', ['title' => 'Edit Hospital Configuration', 'hospitalConfig' => $hospitalConfig, 'facilities' => $facilities, 'labTests' => $labTests, 'medications' => $medications, 'specialties' => $specialties]);
        }
        else
        {
            return redirect()->route('adminDashboard')->with('error-message', 'No Configuration Found.');
  
        }
    }

    public function update(Request $request)
    {
        $hospitalConfig = HospitalConfiguration::find($request->hospital_config_id);
        $rules = [
            'title' => 'required|max:191',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        $hospital = Hospital::find(1);
        if ($hospital) {
            $hospitalData = [
                'key' => $request->title,
                'slug' => Str::slug($request->input('title'), '-'),
                'hospital_id' => 1,
                'hospital_name' => $hospital->title,
            ];


            $hospitalConfig->update($hospitalData);
            if ($hospitalConfig) {
                if ($request->lab_tests) {
                    HospitalConfigurationLabTest::where(['hospital_config_id' => $hospitalConfig->id])->delete();
                    foreach ($request->lab_tests as $lab_test) {
                        $labTestData = LabTest::find($lab_test);
                        if ($labTestData) {
                            HospitalConfigurationLabTest::create([
                                'hospital_config_id' => $hospitalConfig->id,
                                'lab_test_id' => $lab_test,
                                'lab_test_name' => $labTestData->title,
                            ]);
                        }
                    }
                }
                if ($request->facilities) {
                    HospitalConfigurationFacility::where(['hospital_config_id' => $hospitalConfig->id])->delete();
                    foreach ($request->facilities as $facility) {
                        $facilityData = Facility::find($facility);
                        if ($facilityData) {
                            HospitalConfigurationFacility::create([
                                'hospital_config_id' => $hospitalConfig->id,
                                'facility_id' => $facility,
                                'facility_name' => $facilityData->title,
                            ]);
                        }
                    }
                }
                if ($request->medications) {
                    HospitalConfigurationMedication::where(['hospital_config_id' => $hospitalConfig->id])->delete();
                    foreach ($request->medications as $medication) {
                        $medicationData = Medication::find($medication);
                        if ($medicationData) {
                            HospitalConfigurationMedication::create([
                                'hospital_config_id' => $hospitalConfig->id,
                                'medication_id' => $medication,
                                'medication_name' => $medicationData->title,
                            ]);
                        }
                    }
                }
                if ($request->specialties) {
                    HospitalConfigurationSpecialty::where(['hospital_config_id' => $hospitalConfig->id])->delete();
                    foreach ($request->specialties as $specialty) {
                        $specialtyData = Specialty::find($specialty);
                        if ($specialtyData) {
                            HospitalConfigurationSpecialty::create([
                                'hospital_config_id' => $hospitalConfig->id,
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

        $hospitalConfig = HospitalConfiguration::find($request->id);

        if ($hospitalConfig == null) {
            return response()->json(['status' => 0]);
        }

        $hospitalConfig->delete();

        return response()->json(['status' => 1]);
    }


}

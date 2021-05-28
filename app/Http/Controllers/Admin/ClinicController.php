<?php

namespace App\Http\Controllers\Admin;

use App\Models\LabTest;
use App\Models\Medication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\ClinicDepartment;
use App\Models\Department;
use App\Models\Specialty;
use App\Models\Facility;
use Storage;
use Mail;
use Auth;
use URL;
use Illuminate\Http\File;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Rules\EmailMustHaveTLD;

class ClinicController extends Controller
{

    // show list of all Cinics
    public function index()
    {
        $clinics = Clinic::orderBy('id', 'DESC')
            ->get();

        return view('admin.clinic.index', ['clinics' => $clinics, 'title' => 'Clinics']);
    }

    // create new clinic
    public function create()
    {
        $specialties = Specialty::where('status', 1)
            ->get();

        $facilities = Facility::where('status', 1)
            ->get();
        $labTests = LabTest::orderBy('title')->where('status', 1)->get();
        $medications = Medication::orderBy('title')->where('status', 1)->get();
        $departments = Department::orderBy('title')->where('status', 1)->get();

        return view('admin.clinic.create', ['specialties' => $specialties, 'facilities' => $facilities, 'title' => 'Create Clinic', 'labTests' => $labTests, 'medications' => $medications, 'departments' => $departments]);
    }

    // store new clinic
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|max:191',
            'email' => ['required', 'email', 'unique:clinics', new EmailMustHaveTLD],
            'phone' => 'required|min:12',
            'status' => 'required',
            'all_day' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
        ];

        if ($request->all_day == 0) {
            $rules['from_day'] = 'required';
            $rules['to_day'] = 'required';
            $rules['opening_time'] = 'required';
            $rules['closing_time'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $clinicData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'all_day' => $request->all_day,
            'password' => Hash::make($request->password),
        ];

        if ($request->all_day == 0) {
            $clinicData['from_day'] = $request->from_day;
            $clinicData['to_day'] = $request->to_day;
            $clinicData['opening_time'] = date("H:i:s", strtotime($request->opening_time));
            $clinicData['closing_time'] = date("H:i:s", strtotime($request->closing_time));
        }

        $clinic = Clinic::create($clinicData);

        if ($request->departments) {
            foreach ($request->departments as $department) {
                $departmentData = Department::find($department);
                if ($departmentData) {
                    ClinicDepartment::create([
                        'clinic_id' => $clinic->id,
                        'department_id' => $department,
                        'department_name' => $departmentData->title,
                    ]);
                }
            }
        }

        if ($request->hasFile('logo')) {
            $clinicFolder = 'clinicImage';

            if (!Storage::exists($clinicFolder)) {
                Storage::makeDirectory($clinicFolder);
            }

            $imageUrl = Storage::putFile($clinicFolder, new File($request->file('logo')));
            $clinic->update(['logo' => $imageUrl]);
        }

        $clinic->specialties()->sync($request->specialties);
        $clinic->facilities()->sync($request->facilities);
        $clinic->labTests()->sync($request->lab_tests);
        $clinic->medications()->sync($request->medications);


        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        );

        try {
            Mail::send('admin.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject("Account Creation");
            });
        } catch (\Exception $e) {

        }


        return redirect()->route('clinicList')->with('success-message', 'Record Added Successfully.');
    }

    //edit clinic
    public function edit($id)
    {
        $clinic = Clinic::find($id);

        $specialties = Specialty::where('status', 1)->get();
        $facilities = Facility::where('status', 1)->get();
        $labTests = LabTest::orderBy('title')->where('status', 1)->get();
        $medications = Medication::orderBy('title')->where('status', 1)->get();
        $departments = Department::orderBy('title')->where('status', 1)->get();

        return view('admin.clinic.edit', ['title' => 'Edit Clinic', 'clinic' => $clinic, 'specialties' => $specialties, 'facilities' => $facilities, 'labTests' => $labTests, 'medications' => $medications, 'departments' => $departments]);
    }

    // udpate clinic
    public function update(Request $request)
    {


        $clinic = Clinic::where('id', $request->clinic_id)
            ->first();

        $rules = [
            'name' => 'required|max:191',
            'email' => 'email',
            'phone' => 'required|min:12',
            'status' => 'required',
        ];


        if (!empty($request->password) && !empty($request->confirm_password)) {
            $rules['password'] = 'required_with:confirm_password|same:confirm_password|min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $clinicData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ];

        if (!empty($request->password) && !empty($request->confirm_password)) {
            $clinicData['password'] = Hash::make($request->password);
        }

        $clinic->update($clinicData);

        if ($request->departments) {
            ClinicDepartment::where(['clinic_id' => $clinic->id])->delete();
            foreach ($request->departments as $department) {
                $departmentData = Department::find($department);
                if ($departmentData) {
                    ClinicDepartment::create([
                        'clinic_id' => $clinic->id,
                        'department_id' => $department,
                        'department_name' => $departmentData->title,
                    ]);
                }
            }
        }

        if ($request->hasFile('logo')) {
            $clinicFolder = 'clinicImage';

            if (!Storage::exists($clinicFolder)) {
                Storage::makeDirectory($clinicFolder);
            }

            if (Storage::exists($clinic->logo)) {
                Storage::delete($clinic->logo);
            }

            $imageUrl = Storage::putFile($clinicFolder, new File($request->file('logo')));
            $clinic->update(['logo' => $imageUrl]);
        }

        $clinic->specialties()->sync($request->specialties);
        $clinic->facilities()->sync($request->facilities);
        $clinic->labTests()->sync($request->lab_tests);
        $clinic->medications()->sync($request->medications);

        return redirect()->route('clinicList')->with('success-message', 'Record Updated Successfully.');
    }
}

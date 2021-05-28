<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Facility;
use App\Models\Hospital;
use App\Models\HospitalDay;
use App\Models\HospitalDepartment;
use App\Models\HospitalFacility;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use Redirect;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::orderBy('id', 'DESC')->where('deleted_at', null)->get();

        return view('admin.hospital.index', ['hospitals' => $hospitals, 'title' => 'Hospitals']);
    }


    public function create()
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $departments = Department::orderBy('title')->where('status', 1)->get();
        $facilities = Facility::orderBy('title')->where('status', 1)->get();
        return view('admin.hospital.create', ['title' => 'Create Hospital', 'departments' => $departments, 'facilities' => $facilities, 'days' => $days]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:191',
            'contact_no' => 'required|unique:hospitals',
            'email' => 'required|unique:hospitals',
            'address' => 'required|max:191',
            'all_time' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        if ($request->from_time != null) {
            $form_time = Carbon::parse($request->from_time);
        } else {
            $form_time = null;
        }
        if ($request->to_time != null) {
            $to_time = Carbon::parse($request->to_time);
        } else {
            $to_time = null;
        }
        $hospitalData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'address' => $request->address,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'about' => $request->description,
            'all_time' => $request->all_time,
            'from_time' => $form_time,
            'to_time' => $to_time,
            'status' => $request->status,
        ];

        $hospital = Hospital::create($hospitalData);

        if ($hospital) {
            if ($request->departments) {
                foreach ($request->departments as $department) {
                    $departmentData = Department::find($department);
                    if ($departmentData) {
                        HospitalDepartment::create([
                            'hospital_id' => $hospital->id,
                            'department_id' => $department,
                            'department_name' => $departmentData->title,
                        ]);
                    }
                }
            }
            if ($request->days) {
                foreach ($request->days as $key => $value) {
                    HospitalDay::create([
                        'hospital_id' => $hospital->id,
                        'day' => $value,
                    ]);
                }
            }
            if ($request->facilities) {
                foreach ($request->facilities as $facility) {
                    $facilityData = Facility::find($facility);
                    if ($facilityData) {
                        HospitalFacility::create([
                            'hospital_id' => $hospital->id,
                            'facility_id' => $facility,
                            'facility_name' => $facilityData->title,
                        ]);
                    }
                }
            }
        }


        return redirect()->route('hospitalList')->with('success-message', 'Record Added Successfully.');
    }


    //edit facility
    public function edit($id)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $departments = Department::orderBy('title')->where('status', 1)->get();
        $facilities = Facility::orderBy('title')->where('status', 1)->get();
        $hospital = Hospital::find($id);
        return view('admin.hospital.edit', ['title' => 'Edit Hospital', 'hospital' => $hospital, 'departments' => $departments, 'facilities' => $facilities, 'days' => $days]);
    }

    public function detail($id)
    {

        $hospital = Hospital::find($id);
        return view('admin.hospital.detail', ['title' => 'Edit Hospital', 'hospital' => $hospital]);
    }

    public function update(Request $request)
    {
        $hospital = Hospital::find($request->hospital_id);
//dd($hospital);
        $rules = [
            'title' => 'required|max:191',
            'contact_no' => 'required|unique:hospitals,contact_no,' . $hospital->id,
            'email' => 'required|unique:hospitals,email,' . $hospital->id,
            'address' => 'required|max:191',
            'all_time' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        if (!empty($request->from_time)) {
            $form_time = Carbon::parse($request->from_time);
        } else {
            $form_time = null;
        }
        if (!empty($request->to_time)) {
            $to_time = Carbon::parse($request->to_time);
        } else {
            $to_time = null;
        }
        $hospitalData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'address' => $request->address,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'about' => $request->description,
            'all_time' => $request->all_time,
            'from_time' => $form_time,
            'to_time' => $to_time,
            'status' => $request->status,
        ];

        $hospital->update($hospitalData);
        if ($hospital) {
            if ($request->departments) {
                HospitalDepartment::where(['hospital_id' => $hospital->id])->delete();
                foreach ($request->departments as $department) {
                    $departmentData = Department::find($department);
                    if ($departmentData) {
                        HospitalDepartment::create([
                            'hospital_id' => $hospital->id,
                            'department_id' => $department,
                            'department_name' => $departmentData->title,
                        ]);
                    }
                }
            }
            if ($request->days) {
                HospitalDay::where(['hospital_id' => $hospital->id])->delete();
                foreach ($request->days as $key => $value) {
                    HospitalDay::create([
                        'hospital_id' => $hospital->id,
                        'day' => $value,
                    ]);
                }
            }
            if ($request->facilities) {
                HospitalFacility::where(['hospital_id' => $hospital->id])->delete();
                foreach ($request->facilities as $facility) {
                    $facilityData = Facility::find($facility);
                    if ($facilityData) {
                        HospitalFacility::create([
                            'hospital_id' => $hospital->id,
                            'facility_id' => $facility,
                            'facility_name' => $facilityData->title,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('hospitalList')->with('success-message', 'Record Updated Successfully.');
    }


    public function delete(Request $request)
    {

        $hospital = Hospital::find($request->id);

        if ($hospital == null) {
            return response()->json(['status' => 0]);
        }

        $hospital->delete();

        return response()->json(['status' => 1]);
    }

    public function changeHospitalStatus(Request $request)
    {
        $hospital = Hospital::find($request->id);

        if ($hospital == null) {
            return response()->json(['status' => 0]);
        }

        $hospital->update(['status' => $request->status]);

        return response()->json(['status' => 1]);
    }
}

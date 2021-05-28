<?php

namespace App\Http\Controllers\Clinic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\Clinic;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Http\File;

use Redirect;
use App\Models\Practitioner;
use App\Models\PractitionerClinics;
use App\Models\Specialty;
use App\Models\Facility;
use App\Models\Notification;




class ClinicController extends Controller
{
    // Dashboard
    public function index()
    {

        $id = Auth::guard('clinic')->user()->id;

        $clinic =  Clinic::find($id);

        $practitionerCount = PractitionerClinics::where('clinic_id', $clinic->id)
        ->count();

        return view('clinic.dashboard.dashboard', compact('practitionerCount'));
    }

    // Profile Edit View
    public function editProfile(){
        return view('clinic.profile.edit');
    }

    // Profile Update
    public function updateProfile(Request $request){

        $rules['clinic_name'] = 'required';
        $rules['old_password'] = 'required';

        if($request->new_password!=null){
            $rules['new_password'] = 'min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $clinic = Clinic::find(Auth::guard('clinic')->user()->id);

        if (Hash::check($request->old_password, $clinic->password)) { 
            $clinic->name=$request->clinic_name;

            if($request->new_password!=null){
                $clinic->password = Hash::make($request->new_password);
            }

            $clinic->update();
            Auth::guard('clinic')->logout();
            return redirect()->route('clinicLoginForm')->with('success-message','Successfully Updated, Login again!');
        } 
        else {
            return redirect()->back()->with('error-message','Old Password is not matched, try again!');
        }
    }

    // Practitioner List
    public function practitionerList()
    {

        $id = Auth::guard('clinic')->user()->id;

        $clinic =  Clinic::find($id);

        $practitioners = $clinic->getPractitioners;

        return view('clinic.practitioner.index', ['practitioners' => $practitioners, 'title' => 'Practitioners']);
    }

    // Practitioner Profile
    public function practitionerProfile($id){

        $practitioner = Practitioner::find($id);

        return view('clinic.practitioner.profile', ['practitioner' => $practitioner, 'title' => 'Profile']);
    }

    // Data Edit View
    public function editData(){
        $id = Auth::guard('clinic')->user()->id;

        $clinic =  Clinic::find($id);

        $specialties = Specialty::where('status', 1)
        ->get();

        $facilities = Facility::where('status', 1)
        ->get();

        return view('clinic.data.index', ['title' => 'Edit Clinic', 'clinic' => $clinic, 'specialties' => $specialties, 'facilities' => $facilities,]);
    }

    // Data Update
    public function updateData(Request $request)
    {

        $clinic = Clinic::where('id', $request->clinic_id)
        ->first();

        // $rules = [
        //     'from_day' => 'required',
        //     'to_day' => 'required',
        //     'opening_time' => 'required',
        //     'closing_time' => 'required',
        // ];

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     return Redirect::back()->withErrors($validator)->withInput(Input::all());
        // }

        $clinicData = [
            'address' => $request->address,
        ];


        $clinic->update($clinicData);

        if ($request->hasFile('logo')) {
            $clinicFolder = 'clinicImage';

            if (!Storage::exists($clinicFolder)) {
                Storage::makeDirectory($clinicFolder);
            }

            if(Storage::exists($clinic->logo)){
                Storage::delete($clinic->logo);
            }
            
            $imageUrl = Storage::putFile($clinicFolder, new File($request->file('logo')));
            $clinic->update(['logo'=> $imageUrl]);
        }

        $clinic->specialties()->sync($request->specialties);
        $clinic->facilities()->sync($request->facilities);

        return redirect()->route('clinicEditData')->with('success-message', 'Record Updated Successfully.');
    }

    public function notificationDetail($id){
        $notification = Notification::find($id);

        if(empty($notification)){
            return redirect()->back()->with('error-message','Not Found !');
        }

        $notification->is_read = 1;

        $notification->update();

        return view('clinic.notification.detail', compact('notification'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;

use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Assistant;
use App\Models\Clinic;
use App\Models\Appointment;
use App\Models\Medication;
use App\Models\Notification;


class AdminController extends Controller
{
    
    public function index()
    {
        $today = date('Y-m-d');
        $practitionersCount = Practitioner::count();
        $assistantsCount = Assistant::count();
        $patientsCount = Patient::count();
        $todayAppointmentsCount = Appointment::where('date', $today)->count();
        $todayOpenAppointmentsCount = Appointment::whereIn('status', [0,1,2,4])->where('date', $today)->count();
        $todayClosedAppointmentsCount = Appointment::where('status', 5)->where('date', $today)->count();

        // $patientCount = Patient::count();
        // $clinicCount = Clinic::count();
        // $userCount = User::where('id', '!=' , Auth::user()->id)->count();
        // $medicineCount = Medication::where('status', 1)->count();

        return view('admin.dashboard.dashboard', compact('practitionersCount', 'assistantsCount', 'patientsCount', 'todayAppointmentsCount', 'todayOpenAppointmentsCount', 'todayClosedAppointmentsCount'));
    }

    public function editProfile(){
        return view('admin.profile.edit');
    }

    public function updateProfile(Request $request){

        $rules['user_name'] = 'required';
        // $rules['user_email'] = 'required';
        $rules['old_password'] = 'required';

        if($request->new_password!=null){
            $rules['new_password'] = 'min:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) { 
            $user->name=$request->user_name;
            // $user->email=$request->user_email;

            if($request->new_password!=null){
                $user->password = Hash::make($request->new_password);
            }

            $user->update();
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('success-message','Successfully Updated, Login again!');
        } 
        else {
            return redirect()->back()->with('error-message','Old Password is not matched, try again!');
        }
    }

    public function notificationDetail($id){
        $notification = Notification::find($id);

        if(empty($notification)){
            return redirect()->back()->with('error-message','Not Found !');
        }

        $notification->is_read = 1;

        $notification->update();

        return view('admin.notification.detail', compact('notification'));
    }
}

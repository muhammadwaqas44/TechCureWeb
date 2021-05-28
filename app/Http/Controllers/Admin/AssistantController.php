<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\Specialty;
use App\Models\Qualification;
use App\Models\Practitioner;
use App\Models\PractitionerAssistant;
use App\Models\Appointment;
use App\Models\Patient;
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

class AssistantController extends Controller
{
    // Show List of All Assistants
    public function index()
    {
        $assistants = Assistant::orderBy('id', 'DESC')
        ->get();

        return view('admin.assistant.index', ['assistants' => $assistants, 'title' => 'Assistants']);
    }

    // Create New Assistant
    public function create()
    {
        $specialties = Specialty::where('status', 1)
        ->get();

        $qualifications = Qualification::where('status', 1)
        ->get();

        $practitioners = Practitioner::where('status', 1)
        ->get();

        return view('admin.assistant.create', ['specialties' => $specialties, 'qualifications' => $qualifications, 'practitioners' => $practitioners, 'title' => 'Create Assistant']);
    }

    // Store New Assistant
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:191',
            'email' => ['required', 'email', 'unique:assistants' , new EmailMustHaveTLD],
            'phone' => 'required|min:12|unique:assistants',
            'status' => 'required',
            'qualification_id' => 'required',
            'practitioners.*' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
        ];

        if($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if($request->has('address')) {
            $rules['address'] = 'required|max:250';
        }

        if($request->has('description')) {
            $rules['description'] = 'required|max:5000';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $assistantData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'qualification_id' => $request->qualification_id,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ];

        $assistant = Assistant::create($assistantData);

        $assistant->specialties()->sync($request->specialties);
        $assistant->practitioners()->sync($request->practitioners);

        if($request->hasFile('image')) {
            $assistantFolder = 'assistantImage';

            if (!Storage::exists($assistantFolder)) {
                Storage::makeDirectory($assistantFolder);
            }
            
            $imageUrl = Storage::putFile($assistantFolder, new File($request->file('image')));
            $assistant->update(['image'=> $imageUrl]);
        }

        // $data = array(
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password,
        // );

        // try{
        //     Mail::send('admin.mails.accountCreated', ["data" => $data], function ($message) use ($data) {
        //         $message->to($data['email'])->subject("Account Creation");
        //     });
        // } catch (\Exception $e) {

        // }

        return redirect()->route('assistantList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Assistant
    public function edit($id)
    {
        $assistant = Assistant::find($id);

        $specialties = Specialty::where('status', 1)
        ->get();

        $qualifications = Qualification::where('status', 1)
        ->get();

        $practitioners = Practitioner::where('status', 1)
        ->get();

        return view('admin.assistant.edit', ['title' => 'Edit Assistant', 'assistant' => $assistant, 'qualifications' => $qualifications, 'practitioners' => $practitioners, 'specialties' => $specialties]);
    }

    // Update Assistant
    public function update(Request $request)
    {
        $assistant = Assistant::where('id', $request->assistant_id)
        ->first();

        $rules = [
            'name' => 'required|max:191',
            'email' => 'email',
            'phone' => 'required|min:12|unique:assistants,phone,'.$assistant->id,
            'status' => 'required',
            'qualification_id' => 'required',
            'practitioners.*' => 'required',
        ];

        if($request->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }

        if($request->has('address')) {
            $rules['address'] = 'required|max:250';
        }

        if($request->has('description')) {
            $rules['description'] = 'required|max:5000';
        }

        if (!empty($request->password)) {
            $rules['password'] = 'required_with:confirm_password|same:confirm_password|min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $assistantData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
            'qualification_id' => $request->qualification_id,
        ];


        if (!empty($request->password) && !empty($request->confirm_password)) {
            $assistantData['password'] = Hash::make($request->password);
        }

        $assistant->update($assistantData);

        if ($request->hasFile('image')) {
            $assistantFolder = 'assistantImage';

            if (!Storage::exists($assistantFolder)) {
                Storage::makeDirectory($assistantFolder);
            }

            if(Storage::exists($assistant->image)){
                Storage::delete($assistant->image);
            }
            
            $imageUrl = Storage::putFile($assistantFolder, new File($request->file('image')));
            $assistant->update(['image'=> $imageUrl]);
        }

        $assistant->specialties()->sync($request->specialties);
        $assistant->practitioners()->sync($request->practitioners);

        return redirect()->route('assistantList')->with('success-message', 'Record Updated Successfully.');
    }

    // Assistant Detail
    public function detail($id)
    {
        $assistant = Assistant::where('id', $id)->first();

        if ($assistant == null) {
            return redirect()->route('assistantList')->with('error', 'No Record Found.');
        }

        return view('admin.assistant.detail', ['title' => 'Assistant Detail', 'assistant' => $assistant]);
    }

    // Change Status of the Assistant
    public function changeAssistantStatus(Request $request)
    {
        $assistant = Assistant::find($request->id);

        if($assistant == null) {
            return response()->json(['status' => 0]);
        }

        $assistant->update(['status' => $request->status]);

        return response()->json(['status' => 1]);
    }

    // Get Assistant Appointments
    public function assistantAppointments($id)
    {
        if($id == null)
        {
            return redirect()->route('assistantList')->with('error', 'No Record Found.');
        }

        $practitionerIds = PractitionerAssistant::select('practitioner_id')->where('assistant_id', $id)->pluck('practitioner_id')->toArray();

        $appointments = Appointment::whereIn('practitioner_id', $practitionerIds)->orderBy('id', 'DESC')->get();

        return view('admin.assistant.appointments', ['appointments' => $appointments, 'title' => 'Assistant Appointments']);
    }
    
    // Get Assistant Patients
    public function assistantPatients($id)
    {
        if($id == null)
        {
            return redirect()->route('patientList')->with('error', 'No Record Found.');
        }

        $practitionerIds = PractitionerAssistant::select('practitioner_id')->where('assistant_id', $id)->pluck('practitioner_id')->toArray();

        $patientAppointments = Appointment::whereIn('practitioner_id', $practitionerIds)->orderBy('id', 'DESC')->pluck('patient_id')->toArray();

        $patientUniqueIds = array_unique($patientAppointments);

        $patients = Patient::whereIn('id', $patientUniqueIds)->get();

        return view('admin.assistant.patients', ['patients' => $patients, 'title' => 'Assistant Patients']);
    }
}

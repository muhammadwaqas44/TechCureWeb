<?php

namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\PrescriptionTemplate;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Redirect;
use Validator;

class PrescriptionTemplateController extends Controller
{

    // Show list of all Prescription Template
    public function index()
    {
        $prescriptionTemplates = PrescriptionTemplate::where('practitioner_id', Auth::guard('practitioner')->user()->id)->orderBy('created_at', 'DESC')->get();

        return view('practitioner.prescriptionTemplate.index', ['prescriptionTemplates' => $prescriptionTemplates, 'title' => 'Prescription Templates']);
    }

    // Create new Prescription Template
    public function create()
    {
        return view('practitioner.prescriptionTemplate.create', ['title' => 'Create Prescription Template']);
    }

    // Store new Prescription Template
    public function store(Request $request)
    {
        $rules = [
//            'title' => 'required|unique:prescription_templates|max:191',
            'title' => 'required|max:191',
            'description' => 'required',
            'is_favourite' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Auth::guard('practitioner')->user();

        $prescriptionTemplateCheck = PrescriptionTemplate::where(['title' => $request->title, 'practitioner_id' => $practitioner->id])->get();
        if ($prescriptionTemplateCheck->count() == 0){
        $prescriptionTemplateData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title') . ' ' . time(), '-'),
            'description' => $request->description,
            'practitioner_id' => $practitioner->id,
            'practitioner_name' => $practitioner->name,
            'is_favourite' => $request->is_favourite,
            'status' => $request->status,
        ];

        $prescriptionTemplate = PrescriptionTemplate::create($prescriptionTemplateData);
            return redirect()->route('practitionerPrescriptionTemplateList')->with('success-message', 'Record Added Successfully.');
        }else{
            return redirect()->route('practitionerPrescriptionTemplateList')->with('error-message', 'You Already Added A Template Against This Title.');

        }
    }

    // Edit Prescription Template
    public function edit($id)
    {
        $prescriptionTemplate = PrescriptionTemplate::find($id);

        return view('practitioner.prescriptionTemplate.edit', ['title' => 'Edit Prescription Template', 'prescriptionTemplate' => $prescriptionTemplate]);
    }

    // Update Prescription Template
    public function update(Request $request)
    {
        $prescriptionTemplate = PrescriptionTemplate::find($request->prescription_template_id);

        $rules = [
//            'title' => 'required|max:191|unique:prescription_templates,title,'.$prescriptionTemplate->id,
            'title' => 'required|max:191',
            'description' => 'required',
            'is_favourite' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Auth::guard('practitioner')->user();

        $prescriptionTemplateData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title') . ' ' . time(), '-'),
            'description' => $request->description,
            'practitioner_id' => $practitioner->id,
            'practitioner_name' => $practitioner->name,
            'is_favourite' => $request->is_favourite,
            'status' => $request->status,
        ];

        $prescriptionTemplate->update($prescriptionTemplateData);

        return redirect()->route('practitionerPrescriptionTemplateList')->with('success-message', 'Record Updated Successfully.');
    }

    // Delete Prescription Template
    public function delete(Request $request)
    {
        $prescriptionTemplate = PrescriptionTemplate::find($request->id);

        if ($prescriptionTemplate == null) {
            return response()->json(['status' => 0]);
        }

        $prescriptionTemplate->delete();

        return response()->json(['status' => 1]);
    }
}

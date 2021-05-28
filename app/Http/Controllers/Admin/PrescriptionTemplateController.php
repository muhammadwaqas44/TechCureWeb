<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrescriptionTemplate;
use App\Models\Practitioner;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class PrescriptionTemplateController extends Controller
{
    // Show list of all Prescription Template
    public function index()
    {
        $prescriptionTemplates = PrescriptionTemplate::orderBy('id', 'DESC')->get();

        return view('admin.prescriptionTemplate.index', ['prescriptionTemplates' => $prescriptionTemplates, 'title' => 'Prescription Templates']);
    }

    // Create new Prescription Template
    public function create()
    {
        $practitioners = Practitioner::select('id', 'name')->where('status', 1)->get();

        return view('admin.prescriptionTemplate.create', ['title' => 'Create Prescription Template', 'practitioners' => $practitioners]);
    }

    // Store new Prescription Template
    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|unique:prescription_templates|max:191',
            'description' => 'required',
            'practitioner_id' => 'required|numeric',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Practitioner::select('name')->where('id', $request->practitioner_id)->first();

        $prescriptionTemplateData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->description,
            'practitioner_id' => $request->practitioner_id,
            'practitioner_name' => $practitioner->name,
            'status' => $request->status,
        ];

        $prescriptionTemplate= PrescriptionTemplate::create($prescriptionTemplateData);

        return redirect()->route('prescriptionTemplateList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Prescription Template
    public function edit($id)
    {
        $prescriptionTemplate = PrescriptionTemplate::find($id);
        $practitioners = Practitioner::select('id', 'name')->where('status', 1)->get();

        return view('admin.prescriptionTemplate.edit', ['title' => 'Edit Prescription Template', 'prescriptionTemplate' => $prescriptionTemplate, 'practitioners' => $practitioners]);
    }

    // Update Prescription Template
    public function update(Request $request)
    {
        $prescriptionTemplate = PrescriptionTemplate::find($request->prescription_template_id);
        
        $rules = [
            'title' => 'required|max:191|unique:prescription_templates,title,'.$prescriptionTemplate->id,
            'description' => 'required',
            'practitioner_id' => 'required|numeric',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Practitioner::select('name')->where('id', $request->practitioner_id)->first();
        
        $prescriptionTemplateData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->description,
            'practitioner_id' => $request->practitioner_id,
            'practitioner_name' => $practitioner->name,
            'status' => $request->status,
        ];

        $prescriptionTemplate->update($prescriptionTemplateData);

        return redirect()->route('prescriptionTemplateList')->with('success-message', 'Record Updated Successfully.');
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

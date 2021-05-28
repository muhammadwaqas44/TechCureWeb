<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\Practitioner;
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

        $id = Auth::guard('assistant')->user()->id;

        $assistant = Assistant::find($id);

        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $prescriptionTemplates = PrescriptionTemplate::whereIn('practitioner_id', $practitionersID)->orderBy('created_at', 'DESC')->get();

        return view('assistant.prescriptionTemplate.index', ['prescriptionTemplates' => $prescriptionTemplates, 'title' => 'Prescription Templates']);
    }

    // Create new Prescription Template
    public function create()
    {
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $practitioners = Practitioner::whereIn('id', $practitionersID)->get();
        return view('assistant.prescriptionTemplate.create', ['title' => 'Create Prescription Template', 'practitioners' => $practitioners]);
    }

    // Store new Prescription Template
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:prescription_templates|max:191',
            'description' => 'required',
            'practitioner_id' => 'required',
            'is_favourite' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Practitioner::where('id', $request->practitioner_id)->first();

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
            return redirect()->route('assistantPrescriptionTemplateList')->with('success-message', 'Record Added Successfully.');
        }else{
            return redirect()->route('assistantPrescriptionTemplateList')->with('error-message', 'You Already Added A Template With The Same Name Against This Practitioner.');

        }
//        $prescriptionTemplateData = [
//            'title' => $request->title,
//            'slug' => Str::slug($request->input('title'), '-'),
//            'description' => $request->description,
//            'practitioner_id' => $practitioner->id,
//            'practitioner_name' => $practitioner->name,
//            'is_favourite' => $request->is_favourite,
//            'status' => $request->status,
//        ];
//
//        $prescriptionTemplate = PrescriptionTemplate::create($prescriptionTemplateData);
//
//        return redirect()->route('assistantPrescriptionTemplateList')->with('success-message', 'Record Added Successfully.');
    }

    // Edit Prescription Template
    public function edit($id)
    {
        $prescriptionTemplate = PrescriptionTemplate::find($id);
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $practitioners = Practitioner::whereIn('id', $practitionersID)->get();
        return view('assistant.prescriptionTemplate.edit', ['title' => 'Edit Prescription Template', 'prescriptionTemplate' => $prescriptionTemplate, 'practitioners' => $practitioners]);
    }

    // Update Prescription Template
    public function update(Request $request)
    {
        $prescriptionTemplate = PrescriptionTemplate::find($request->prescription_template_id);

        $rules = [
            'title' => 'required|max:191|unique:prescription_templates,title,' . $prescriptionTemplate->id,
            'description' => 'required',
            'practitioner_id' => 'required',
            'is_favourite' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $practitioner = Practitioner::where('id', $request->practitioner_id)->first();

        $prescriptionTemplateData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->description,
            'practitioner_id' => $practitioner->id,
            'practitioner_name' => $practitioner->name,
            'is_favourite' => $request->is_favourite,
            'status' => $request->status,
        ];

        $prescriptionTemplate->update($prescriptionTemplateData);

        return redirect()->route('assistantPrescriptionTemplateList')->with('success-message', 'Record Updated Successfully.');
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

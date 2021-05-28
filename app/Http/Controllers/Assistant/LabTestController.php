<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\LabTest;
use App\Models\Practitioner;
use App\Models\PractitionerLabTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class LabTestController extends Controller
{
    public function index()
    {
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $labTests = PractitionerLabTest::whereIn('practitioner_id', $practitionersID)->orderBy('id', 'DESC')
            ->get();

        return view('assistant.labTest.index', ['labTests' => $labTests, 'title' => 'Favourite Lab Tests']);
    }

    public function create()
    {
        $labTests = LabTest::orderBy('title')->where('status', 1)->get();
        $id = Auth::guard('assistant')->user()->id;
        $assistant = Assistant::find($id);
        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $practitioners = Practitioner::whereIn('id', $practitionersID)->get();
        return view('assistant.labTest.create', ['labTests' => $labTests, 'practitioners' => $practitioners, 'title' => 'Add Favourite Lab Tests']);
    }

    public function store(Request $request)
    {
        $rules = [
            'practitioner_id' => 'required',
            'lab_tests' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }


        foreach ($request->lab_tests as $labTest) {
            PractitionerLabTest::where(['practitioner_id' => $request->practitioner_id, 'lab_test_id' => $labTest])->delete();

            PractitionerLabTest::create([
                'lab_test_id' => $labTest,
                'practitioner_id' => $request->practitioner_id,
            ]);
        }
        return redirect()->route('assistantLabTestList')->with('success-message', 'Record Added Successfully.');


    }

    public function delete(Request $request)
    {

        $labTest = PractitionerLabTest::find($request->id);
        if ($labTest == null) {
            return response()->json(['status' => 0]);
        }

        $labTest->delete();

        return response()->json(['status' => 1]);
    }
}

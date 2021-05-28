<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\LabTest;
use App\Models\PractitionerLabTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;

class LabTestController extends Controller
{
    public function index()
    {
        $labTests = PractitionerLabTest::orderBy('id', 'DESC')
            ->get();

        return view('practitioner.labTest.index', ['labTests' => $labTests, 'title' => 'Favourite Lab Tests']);
    }

    public function create()
    {
        $labTests = LabTest::orderBy('title')->where('status', 1)->get();

        return view('practitioner.labTest.create', ['labTests' => $labTests, 'title' => 'Add Favourite Lab Tests']);
    }

    public function store(Request $request)
    {
        $rules = [
            'lab_tests' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }


        foreach ($request->lab_tests as $labTest) {
            PractitionerLabTest::where(['practitioner_id'=>Auth::guard('practitioner')->user()->id,'lab_test_id'=>$labTest])->delete();

            PractitionerLabTest::create([
                'lab_test_id' => $labTest,
                'practitioner_id' => Auth::guard('practitioner')->user()->id,
            ]);
        }
        return redirect()->route('practitionerLabTestList')->with('success-message', 'Record Added Successfully.');


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

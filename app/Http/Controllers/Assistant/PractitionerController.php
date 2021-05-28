<?php

namespace App\Http\Controllers\Assistant;

use App\Models\Assistant;
use App\Models\Practitioner;
use App\Models\PractitionerAssistant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PractitionerController extends Controller
{
    public function index()
    {
        $id = Auth::guard('assistant')->user()->id;

        $assistant = Assistant::find($id);

        $practitionersID = $assistant->practitioners()->pluck('practitioner_id');
        $practitioners = Practitioner::whereIn('id', $practitionersID)->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('assistant.practitioner.index', ['practitioners' => $practitioners, 'title' => 'Practitioners']);
    }

    // Assistant Detail
    public function detail($id)
    {
        $practitioner = Practitioner::where('id', $id)->first();

        if ($practitioner == null) {
            return redirect()->route('assistantPractitionerList')->with('error', 'No Record Found.');
        }

        return view('assistant.practitioner.detail', ['practitioner' => $practitioner, 'title' => 'Practitioner Detail']);
    }
}

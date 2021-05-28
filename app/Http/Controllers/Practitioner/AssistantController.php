<?php

namespace App\Http\Controllers\Practitioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\PractitionerAssistant;
use Illuminate\Support\Facades\Auth;

class AssistantController extends Controller
{
    // Show List of All Practitioner Assistants
    public function index()
    {
        $practitionerAssistantIds = PractitionerAssistant::select('assistant_id')->where('practitioner_id', Auth::guard('practitioner')->user()->id)->pluck('assistant_id')->toArray();

        $assistants = Assistant::whereIn('id', $practitionerAssistantIds)->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('practitioner.assistant.index', ['assistants' => $assistants, 'title' => 'Assistants']);
    }

    // Assistant Detail
    public function detail($id)
    {
        $assistant = Assistant::where('id', $id)->first();

        if ($assistant == null) {
            return redirect()->route('practitionerAssistantList')->with('error', 'No Record Found.');
        }

        return view('practitioner.assistant.detail', ['assistant' => $assistant, 'title' => 'Assistant Detail']);
    }
}

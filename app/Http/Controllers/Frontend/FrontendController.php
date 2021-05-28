<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Practitioner;
use App\Models\Clinic;
use App\Models\Facility;

use DB;


class FrontendController extends Controller
{

    public function indexPage(){

        $facilities = Facility::where('status', 1)
        ->orderBy(DB::raw('RAND()'))
        ->limit(8)
        ->get();

        $doctors = Practitioner::where('status', 1)
        ->orderBy(DB::raw('RAND()'))
        ->limit(6)
        ->get();

        return view('frontend.pages.index', compact('facilities', 'doctors'));
    }

    public function facilitiesPage(){

        $facilities = Facility::where('status', 1)
        ->orderBy('id', 'DESC')
        ->paginate(8);

        return view('frontend.pages.facilities', compact('facilities'));
    }

    public function clinicsPage(){

        $clinics = Clinic::where('status', 1)
        ->orderBy('id', 'DESC')
        ->paginate(6);

        return view('frontend.pages.clinics', compact('clinics'));
    }

    public function doctorsPage(){

        $doctors = Practitioner::where('status', 1)
        ->orderBy('id', 'DESC')
        ->paginate(6);

        return view('frontend.pages.doctors', compact('doctors'));
    }

    public function clinicSearch(Request $request){
        
        $keyword = $request->keyword;

        $clinics = Clinic::where('status', 1)
        ->where('name', 'LIKE', "%$keyword%")
        ->orderBy('id', 'DESC')
        ->get();

        return view('frontend.pages.clinicsSearch', compact('clinics','keyword'));
    }

    public function doctorSearch(Request $request){

        $keyword = $request->keyword;

        $doctors = Practitioner::where('status', 1)
        ->where('name', 'LIKE', "%$keyword%")
        ->orderBy('id', 'DESC')
        ->get();

        return view('frontend.pages.doctorsSearch', compact('doctors','keyword'));
    }

    public function clinicProfilePage($id){

        $clinic = Clinic::find($id);

        return view('frontend.pages.clinicProfile', compact('clinic'));
    }

    public function doctorProfilePage($id){

        $doctor = Practitioner::find($id);

        return view('frontend.pages.doctorProfile', compact('doctor'));
    }
}

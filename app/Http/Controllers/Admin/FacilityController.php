<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Http\File;


class FacilityController extends Controller
{
    // show list of all facilities
    public function index()
    {
        $facilities = Facility::orderBy('id', 'DESC')
        ->get();

        return view('admin.facility.index', ['facilities' => $facilities, 'title' => 'Facilities']);
    }


    // create new facility
    public function create()
    {
        return view('admin.facility.create', ['title' => 'Create Facility']);
    }


    // store new facility
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:facilities|max:191',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $facilityData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->description,
            'status' => $request->status,
        ];

        $facility= Facility::create($facilityData);

        if ($request->hasFile('image')) {
            $facilityFolder = 'facilityImage';

            if (!Storage::exists($facilityFolder)) {
                Storage::makeDirectory($facilityFolder);
            }

            $imageUrl = Storage::putFile($facilityFolder, new File($request->file('image')));
            $facility->update(['image'=> $imageUrl]);
        }

        return redirect()->route('facilityList')->with('success-message', 'Record Added Successfully.');
    }


    //edit facility
    public function edit($id)
    {
        $facility = Facility::find($id);
        return view('admin.facility.edit', ['title' => 'Edit Facility', 'facility' => $facility]);
    }


    // update facility
    public function update(Request $request)
    {
        $facility = Facility::find($request->facility_id);

        $rules = [
            'title' => 'required|max:191|unique:facilities,title,'.$facility->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $facilityData = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->description,
            'status' => $request->status,
        ];

        $facility->update($facilityData);

        if ($request->hasFile('image')) {
            $facilityFolder = 'facilityImage';

            if (!Storage::exists($facilityFolder)) {
                Storage::makeDirectory($facilityFolder);
            }

            if(Storage::exists($facility->image)){
                Storage::delete($facility->image);
            }

            $imageUrl = Storage::putFile($facilityFolder, new File($request->file('image')));
            $facility->update(['image'=> $imageUrl]);
        }

        return redirect()->route('facilityList')->with('success-message', 'Record Updated Successfully.');
    }


    // delete facility
    public function delete(Request $request){

        $facility = Facility::find($request->id);

        if ($facility == null) {
            return response()->json(['status' => 0 ]);
        }

        $facility->delete();

        return response()->json(['status' => 1 ]);
    }

    public function changeFacilityStatus(Request $request)
    {
        $facility = Facility::find($request->id);

        if($facility == null) {
            return response()->json(['status' => 0]);
        }

        $facility->update(['status' => $request->status]);

        return response()->json(['status' => 1]);
    }

}

@extends('layouts.practitioner')

@section('extra-css')
    <style>
        .input-group-addon {
            padding: 0px;
            border: 0px;
        }
    </style>
@endsection

@section('main-content')
     <div class="content-wrapper">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <span><strong>Patient Detail</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row" style="width:100%">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Name: </strong></span> <span>{{$patient->name}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Email: </strong></span> <span>{{$patient->email}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Phone: </strong></span> <span>{{$patient->phone}}</span>
                                </div>
                                
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Age: </strong></span> <span>{{\Carbon\Carbon::parse($patient->dob)->diff(\Carbon\Carbon::now())->format('%y years')}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Gender: </strong></span> <span>@if($patient->gender==1)Male @elseif($patient->gender==2) Female @else Other @endif</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Address: </strong></span> <span>{{$patient->address}}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Patient Prescription</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerPrescriptionStore') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

            
                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Clinics <span style="color:red">*</span></label>
                                                <select name="clinic_id" required id="clinic_id" class="form-control {{ $errors->has('clinic_id') ? ' is-invalid' : '' }}" title="Select Clinic" >
                                                    <option value="" selected disabled>Select Clinic</option>
                                                    @foreach($clinics as $clinic)
                                                        <option value="{{ $clinic->id }}" >{{ $clinic->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('clinic_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('clinic_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Follow Up</label>
                                            <div class="input-group date">
                                                <input type="text" name="follow_up" id="follow_up"
                                                    class="form-control {{ $errors->has('follow_up') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Follow Up Date" value="{{ old('follow_up') }}" >
                                                <span class="input-group-addon">
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                                @if ($errors->has('follow_up'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('follow_up') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Medicines <span style="color:red">*</span></label>
                                                <div class="cleafix"></div>
                                                <select name="medications[]" id="medications" required multiple="multiple" class="selectpicker form-control {{ $errors->has('medications') ? ' is-invalid' : '' }}" title="Select Medications" >
                                                    @foreach($medications as $medication)
                                                        <option value="{{ $medication->id }}" 

                                                            @foreach(old('medications', ['value']) as $id)
                                                                @if($medication->id == $id) selected @endif
                                                            @endforeach

                                                        >{{ $medication->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('medications'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('medications') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Allergies <span style="color:red">*</span></label>
                                                <div class="cleafix"></div>
                                                <select name="allergies[]" id="allergies" required multiple="multiple" class="selectpicker form-control {{ $errors->has('allergies') ? ' is-invalid' : '' }}" title="Select allergies" >
                                                    @foreach($allergies as $allergy)
                                                        <option value="{{ $allergy->id }}"
                                                            @foreach(old('allergies', ['value']) as $id)
                                                                @if($allergy->id == $id) selected @endif
                                                            @endforeach
                                                            
                                                        >{{ $allergy->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('allergies'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('allergies') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Clinical Examinations <span style="color:red">*</span></label>
                                                <textarea rows="3" class="form-control {{ $errors->has('clinical_examinations') ? ' is-invalid' : '' }}" name="clinical_examinations" style="width:100% !important" required>{{ old('clinical_examinations') }}</textarea>
                                                @if ($errors->has('clinical_examinations'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('clinical_examinations') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Illness History</label>
                                                <textarea rows="3" class="form-control {{ $errors->has('illness_history') ? ' is-invalid' : '' }}" name="illness_history" style="width:100% !important">{{ old('illness_history') }}</textarea>
                                                @if ($errors->has('illness_history'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('illness_history') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Vital Assessments</label>
                                                <textarea rows="3" class="form-control {{ $errors->has('vital_assessments') ? ' is-invalid' : '' }}" name="vital_assessments" style="width:100% !important">{{ old('vital_assessments') }}</textarea>
                                                @if ($errors->has('vital_assessments'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('vital_assessments') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Presenting Complaints</label>
                                                <textarea rows="3" class="form-control {{ $errors->has('presenting_complaints') ? ' is-invalid' : '' }}" name="presenting_complaints" style="width:100% !important">{{ old('presenting_complaints') }}</textarea>
                                                @if ($errors->has('presenting_complaints'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('presenting_complaints') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Diagnosis</label>
                                                <textarea rows="3" class="form-control {{ $errors->has('diagnosis') ? ' is-invalid' : '' }}" name="diagnosis" style="width:100% !important">{{ old('diagnosis') }}</textarea>
                                                @if ($errors->has('diagnosis'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('diagnosis') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Investigations</label>
                                                <textarea rows="3" class="form-control {{ $errors->has('investigations') ? ' is-invalid' : '' }}" name="investigations" style="width:100% !important">{{ old('investigations') }}</textarea>
                                                @if ($errors->has('investigations'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('investigations') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                       

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Family History</label>
                                                <textarea rows="3" class="form-control {{ $errors->has('family_history') ? ' is-invalid' : '' }}" name="family_history" style="width:100% !important">{{ old('family_history') }}</textarea>
                                                @if ($errors->has('family_history'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('family_history') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Referral</label>
                                                <textarea rows="3" class="form-control {{ $errors->has('referral') ? ' is-invalid' : '' }}" name="referral" style="width:100% !important">{{ old('referral') }}</textarea>
                                                @if ($errors->has('referral'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('referral') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
            
                                    </div>

                                
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <input name="patient_id" type="hidden" value="{{$patient->id}}">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/admin/js/prescription.js')}}"></script>
@endsection



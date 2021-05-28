@extends('layouts.patient')

@section('extra-css')
    <style>
        .required-star{
            color: red;
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
                            <li class="breadcrumb-item"><a href="{{route('patientDashboard')}}">Home</a></li>
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
                            <h3 class="card-title">Detail Patient Prescription</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row"  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">
                                    
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label>Follow Up</label>
                                        <div class="input-group date">
                                            <input readonly type="text" name="follow_up" id="follow_up"
                                                class="form-control {{ $errors->has('follow_up') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Follow Up Date" @if($prescription->follow_up) value="{{date('m/d/Y', strtotime($prescription->follow_up)) }}" @endif >
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
                                            <select readonly name="medications[]" id="medications" multiple data-live-search="true"
                                                class="selectpicker form-control" >
                                                @foreach($medications as $medication)
                                                    <option disabled value="{{$medication->id}}"
                                                        @foreach($prescription->medications as $prescriptionMedication)
                                                            @if($medication->id == $prescriptionMedication->id) selected @endif
                                                        @endforeach
                                                        >
                                                        {{ $medication->title }}
                                                    </option>
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
                                            <label>allergies <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select readonly name="allergies[]" id="allergies" multiple data-live-search="true"
                                                class="selectpicker form-control" >
                                                @foreach($allergies as $allergy)
                                                    <option disabled value="{{$allergy->id}}"
                                                        @foreach($prescription->allergies as $prescriptionAllergy)
                                                            @if($allergy->id == $prescriptionAllergy->id) selected @endif
                                                        @endforeach
                                                        >
                                                        {{ $allergy->title }}
                                                    </option>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('clinical_examinations') ? ' is-invalid' : '' }}" name="clinical_examinations" style="width:100% !important" required>{{ $prescription->clinical_examinations }}</textarea>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('illness_history') ? ' is-invalid' : '' }}" name="illness_history" style="width:100% !important">{{ $prescription->illness_history }}</textarea>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('vital_assessments') ? ' is-invalid' : '' }}" name="vital_assessments" style="width:100% !important">{{ $prescription->vital_assessments }}</textarea>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('presenting_complaints') ? ' is-invalid' : '' }}" name="presenting_complaints" style="width:100% !important">{{ $prescription->presenting_complaints }}</textarea>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('diagnosis') ? ' is-invalid' : '' }}" name="diagnosis" style="width:100% !important">{{ $prescription->diagnosis }}</textarea>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('investigations') ? ' is-invalid' : '' }}" name="investigations" style="width:100% !important">{{ $prescription->investigations }}</textarea>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('family_history') ? ' is-invalid' : '' }}" name="family_history" style="width:100% !important">{{ $prescription->family_history }}</textarea>
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
                                            <textarea readonly rows="3" class="form-control {{ $errors->has('referral') ? ' is-invalid' : '' }}" name="referral" style="width:100% !important">{{ $prescription->referral }}</textarea>
                                            @if ($errors->has('referral'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('referral') }}</strong>
                                                </span>
                                            @endif
                                        </div>
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




@extends('layouts.practitioner')

@section('extra-css')

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
                            <h3 class="card-title">Create Appointment</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerAppointmentStore') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}


                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Patients <span style="color:red">*</span></label>
                                            <select name="patient_id" required id="patient_id" class="form-control {{ $errors->has('patient_id') ? ' is-invalid' : '' }}" title="Select Patient" >
                                                <option value="" disabled>Select Patient</option>
                                                <option value="{{ $patient->id }}" selected>{{ $patient->name }}</option>
                                            </select>
                                            @if ($errors->has('patient_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('patient_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


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
                                        <div class="form-group ">
                                            <label>Appointment Type <span style="color:red">*</span></label>
                                            <select name="type" id="type"
                                                class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Type</option>
                                                <option value="0" {{ (old('type') == '0') ? 'selected' : '' }}>Physical</option>
                                                <option value="1" {{ (old('type') == '1') ? 'selected' : '' }}>Online</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label>Date <span style="color:red">*</span></label>
                                        <div class="input-group date">
                                            <input type="text" name="date" id="date" 
                                                class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Appointment Date" value="{{ old('date') }}" required>
                                            <span class="input-group-addon">
                                                <button class="btn btn-outline-secondary" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Time Slot <span style="color:red">*</span></label>
                                            <select name="time_slot" required id="time_slot" class="form-control {{ $errors->has('time_slot') ? ' is-invalid' : '' }}" title="Select Time Slot" >
                                                <option value="" selected disabled>Select Time Slot</option>
                                            </select>
                                            @if ($errors->has('time_slot'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('time_slot') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Appointment Status <span style="color:red">*</span></label>
                                            <select name="status" id="status"
                                                class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Status</option>
                                                <option value="0" {{ (old('status') == '0') ? 'selected' : '' }}>Under Process</option>
                                                <option value="1" {{ (old('status') == '1') ? 'selected' : '' }}>Accepted</option>
                                                <option value="2" {{ (old('status') == '2') ? 'selected' : '' }}>Rejected</option>
                                                <option value="3" {{ (old('status') == '3') ? 'selected' : '' }}>Check In</option>
                                                <option value="4" {{ (old('status') == '4') ? 'selected' : '' }}>Completed</option>


                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                </div>

                                   
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="appointment_id" name="appointment_id" value="0" />
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
    <script src="{{asset('public/practitioner/js/appointment.js')}}"></script>
@endsection



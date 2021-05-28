@extends('layouts.backend')

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
                            <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
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
                            <h3 class="card-title">Edit Appointment</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('appointmentUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                        <div class="form-group">
                                            <label>Patients <span style="color:red">*</span></label>
                                            <select name="patient_id" required id="patient_id" class="form-control {{ $errors->has('patient_id') ? ' is-invalid' : '' }}" title="Select Patient" >
                                                <option value="" selected disabled>Select Patient</option>
                                                @foreach($patients as $patient)
                                                    <option value="{{ $patient->id }}" {{ ($appointment->patient_id == $patient->id) ? 'selected' : '' }}>{{ $patient->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('patient_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('patient_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                        <div class="form-group">
                                            <label>Patient Types <span style="color:red">*</span></label>
                                            <select name="patient_type_id" required id="patient_type_id" class="form-control {{ $errors->has('patient_type_id') ? ' is-invalid' : '' }}">
                                                <option value="" selected disabled>Select Patient Type</option>
                                                @foreach($patientTypes as $patientType)
                                                    <option value="{{ $patientType->id }}" {{ ($appointment->patient_type_id == $patientType->id) ? 'selected' : '' }}>{{ $patientType->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('patient_type_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('patient_type_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                        <div class="form-group">
                                            <label>Practitioners <span style="color:red">*</span></label>
                                            <select name="practitioner_id" required id="practitioner_id" class="form-control {{ $errors->has('practitioner_id') ? ' is-invalid' : '' }}" title="Select Practitioner" >
                                                <option value="" selected disabled>Select Practitioner</option>
                                                @foreach($practitioners as $practitioner)
                                                    <option value="{{ $practitioner->id }}" {{ ($appointment->practitioner_id == $practitioner->id) ? 'selected' : '' }}>{{ $practitioner->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('practitioner_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('practitioner_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                        <div class="form-group">
                                            <label>Clinics <span style="color:red">*</span></label>
                                            <select name="clinic_id" required id="clinic_id" class="form-control {{ $errors->has('clinic_id') ? ' is-invalid' : '' }}" title="Select Clinic" >
                                                <option value="" selected disabled>Select Clinic</option>
                                                @foreach($clinics as $clinic)
                                                    <option value="{{ $clinic->id }}" {{ ($appointment->clinic_id == $clinic->id) ? 'selected' : '' }}>{{ $clinic->name }}</option>
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
                                                <option value="0" {{ ($appointment->type == '0') ? 'selected' : '' }}>Physical</option>
                                                <option value="1" {{ ($appointment->type == '1') ? 'selected' : '' }}>Online</option>
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
                                                placeholder="Enter Appointment Date" value="{{date('m/d/Y', strtotime($appointment->date)) }}" required>
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
        
                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                        <div class="form-group">
                                            <label>Time Slot <span style="color:red">*</span></label>
                                            <select name="time_slot" required id="time_slot" class="form-control {{ $errors->has('time_slot') ? ' is-invalid' : '' }}" title="Select Time Slot" >
                                                <option value="" selected disabled>Select Time Slot</option>
                                                @foreach($time_slots as $time_slot)
                                                    <option value="{{ $time_slot['key'] }}" {{ ($appointment->time_slot == $time_slot['key']) ? 'selected' : '' }}>{{ $time_slot['value'] }}</option>
                                                @endforeach
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
                                                <option value="0" {{ ($appointment->status == '0') ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ ($appointment->status == '1') ? 'selected' : '' }}>Under Process</option>
                                                <option value="2" {{ ($appointment->status == '2') ? 'selected' : '' }}>Accepted</option>
                                                <option value="3" {{ ($appointment->status == '3') ? 'selected' : '' }}>Rejected</option>
                                                <option value="4" {{ ($appointment->status == '4') ? 'selected' : '' }}>Check In</option>
                                                <option value="5" {{ ($appointment->status == '5') ? 'selected' : '' }}>Completed</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Payable </label>
                                            <input type="number" name="fee" id="fee"
                                                class="form-control {{ $errors->has('fee') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Payable" @if(isset($appointment->payment->amount)) value="{{ $appointment->payment->amount }}" @else value="" @endif>
                                            @if ($errors->has('fee'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fee') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Payment Method </label>
                                            <select name="payment_method" id="payment_method"
                                                class="form-control {{ $errors->has('payment_method') ? ' is-invalid' : '' }}">
                                                <option value="" selected disabled>Select Payment Method</option>
                                                <option value="Cash" @if(isset($appointment->payment->payment_method)) {{ ($appointment->payment->payment_method == 'Cash') ? 'selected' : '' }} @endif>Cash</option>
                                                <option value="Online" @if(isset($appointment->payment->payment_method)) {{ ($appointment->payment->payment_method == 'Online') ? 'selected' : '' }} @endif>Online</option>
                                            </select>
                                            @if ($errors->has('payment_method'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('payment_method') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Payment Status </label>
                                            <select name="payment_status" id="payment_status"
                                                class="form-control {{ $errors->has('payment_status') ? ' is-invalid' : '' }}">
                                                <option value="" selected disabled>Select Payment Status</option>
                                                <option value="Paid" @if(isset($appointment->payment->payment_status)) {{ ($appointment->payment->payment_status == 'Paid') ? 'selected' : '' }} @endif>Paid</option>
                                                <option value="Unpaid" @if(isset($appointment->payment->payment_status)) {{ ($appointment->payment->payment_status == 'Unpaid') ? 'selected' : '' }} @endif>Unpaid</option>
                                            </select>
                                            @if ($errors->has('payment_status'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('payment_status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                </div>


                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="appointment_id" name="appointment_id" value="{{$appointment->id}}" />
                                        <button type="submit" class="btn btn-primary">Update</button>
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
    <script src="{{asset('public/admin/js/appointment.js')}}"></script>
@endsection




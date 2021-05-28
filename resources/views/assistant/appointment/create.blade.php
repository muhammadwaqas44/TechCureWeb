@extends('layouts.assistant')

@section('extra-css')
<style>
    .full-width-select .select2-container, .full-width-select .selection {
        width: 100% !important;
    }
    .select2-container {
        width: 100% !important;
    }
    .selection {
        width: 100% !important;
    }
</style>
@endsection

@section('main-content')
     <div class="content-wrapper m-3">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('assistantDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('assistantPatientCreate', ['fromAppointment'=> 1]) }}" class="btn btn-primary pull-right">Add Paitent</a>
                            <h3 class="card-title">Create Appointment</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('assistantAppointmentStore') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                        <div class="form-group">
                                            <label>Patients <span style="color:red">*</span></label>
                                            <select name="patient_id" required id="patient_id" class="form-control {{ $errors->has('patient_id') ? ' is-invalid' : '' }}" title="Select Patient" >
                                                <option value="" selected disabled>Select Patient</option>
                                                @foreach($patients as $patient)
                                                    <option value="{{ $patient->id }}" >{{ $patient->name }}</option>
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
                                                    <option value="{{ $patientType->id }}">{{ $patientType->title }}</option>
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
                                                    <option value="{{ $practitioner->id }}" >{{ $practitioner->name }}</option>
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
{{--                                                @foreach($practitioners as $practitioner)--}}
{{--                                                    <option value="{{ $practitioner->id }}" >{{ $practitioner->name }}</option>--}}
{{--                                                @endforeach--}}
                                            </select>
                                            @if ($errors->has('clinic_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('clinic_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
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
{{--                                    <div class="col-sm-12 col-md-6 col-lg-6" >--}}
{{--                                        <label>Date <span style="color:red">*</span></label>--}}
{{--                                        <div class="input-group date">--}}
{{--                                            <input type="text" name="date" id="date"--}}
{{--                                                class="form-control date {{ $errors->has('date') ? ' is-invalid' : '' }} datetimepicker"--}}
{{--                                                placeholder="Enter Appointment Date" value="{{ old('date') }}" required>--}}
{{--                                            <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">--}}
{{--                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                            </div>--}}
{{--                                            @if ($errors->has('date'))--}}
{{--                                                <span class="invalid-feedback" role="alert">--}}
{{--                                                    <strong>{{ $errors->first('date') }}</strong>--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-sm-12 col-md-6 col-lg-6" >
                                        <label>Date <span style="color:red">*</span></label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" name="date" id="date" autocomplete="off"
                                                   class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Appointment Date" data-target="#date" value="{{ old('date') }}" required>
                                            <span class="input-group-addon" data-target="#date">
                                                <button class="btn btn-outline-secondary" type="button" >
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
                                                <option value="" disabled>Select Status</option>
                                                <option value="0" {{ (old('status') == '0') ? 'selected' : '' }} selected>Pending</option>
                                                <option value="1" {{ (old('status') == '1') ? 'selected' : '' }}>Under Process</option>
                                                <option value="2" {{ (old('status') == '2') ? 'selected' : '' }}>Accepted</option>
                                                <option value="3" {{ (old('status') == '3') ? 'selected' : '' }}>Rejected</option>
                                                <option value="4" {{ (old('status') == '4') ? 'selected' : '' }}>Check In</option>
                                                <option value="5" {{ (old('status') == '5') ? 'selected' : '' }}>Completed</option>
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
                                                   placeholder="Enter Payable" value="{{ old('fee') }}">
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
                                                <option value="Cash" {{ (old('payment_method') == 'Cash') ? 'selected' : '' }}>Cash</option>
                                                <option value="Online" {{ (old('payment_method') == 'Online') ? 'selected' : '' }}>Online</option>
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
                                                <option value="Paid" {{ (old('payment_status') == 'Paid') ? 'selected' : '' }}>Paid</option>
                                                <option value="Unpaid" {{ (old('payment_status') == 'Unpaid') ? 'selected' : '' }}>Unpaid</option>
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
<script src="{{asset('public/assistant/js/appointment.js')}}"></script>

@if(Session::has('success-message'))
<script>
    toastr.success('{{ Session::get('success-message') }}')
</script>
@endif

@endsection



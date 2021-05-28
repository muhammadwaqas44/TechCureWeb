@extends('layouts.backend')

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
                            <h3 class="card-title">Edit Medication</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('medicationUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                        
                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Title <span style="color:red">*</span></label>
                                                <input type="text" name="title" id="title"
                                                    class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Title" value="{{ $medication->title }}" required>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Generic Name </label>
                                                <input type="text" name="generic_name" id="generic_name"
                                                    class="form-control {{ $errors->has('generic_name') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Generic Name" value="{{ $medication->generic_name }}">
                                                @if ($errors->has('generic_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('generic_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                            <label>Doses <span style="color:red">*</span></label>
                                            <select name="dose_id" id="dose_id" class="form-control {{ $errors->has('dose_id') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Dose</option>
                                                @foreach ($doses as $dose)
                                                    <option {{ ($medication->dose_id == $dose->id)? 'selected':'' }} value="{{ $dose->id }}">{{ $dose->dose }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('dose_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dose_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                            <label>Units <span style="color:red">*</span></label>
                                            <select name="unit_id" id="unit_id" class="form-control {{ $errors->has('unit_id') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Unit</option>
                                                @foreach ($units as $unit)
                                                    <option {{ ($medication->unit_id == $unit->id)? 'selected':'' }} value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('unit_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('unit_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options mt-3">
                                            <label>Frequencies <span style="color:red">*</span></label>
                                            <select name="frequency_id" id="frequency_id" class="form-control {{ $errors->has('frequency_id') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Frequency</option>
                                                @foreach ($frequencies as $frequency)
                                                    <option {{ ($medication->frequency_id == $frequency->id)? 'selected':'' }} value="{{ $frequency->id }}">{{ $frequency->frequency }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('frequency_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('frequency_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3 multiselect-options">
                                            <label>Durations <span style="color:red">*</span></label>
                                            <select name="duration_id" id="duration_id" class="form-control {{ $errors->has('duration_id') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Duration</option>
                                                @foreach ($durations as $duration)
                                                    <option {{ ($medication->duration_id == $duration->id)? 'selected':'' }} value="{{ $duration->id }}">{{ $duration->duration }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('duration_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('duration_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3 multiselect-options">
                                            <label>Diagnosis Types <span style="color:red">*</span></label>
                                            <select name="diagnosis_type_id" id="diagnosis_type_id" class="form-control {{ $errors->has('diagnosis_type_id') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Diagnosis Type</option>
                                                @foreach ($diagnosisTypes as $diagnosisType)
                                                    <option {{ ($medication->diagnosis_type_id == $diagnosisType->id)? 'selected':'' }} value="{{ $diagnosisType->id }}">{{ $diagnosisType->type }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('diagnosis_type_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('diagnosis_type_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                                            <div class="form-group ">
                                                <label>Status <span style="color:red">*</span></label>
                                                <select name="status" id="status"
                                                    class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Select Option</option>
                                                    <option {{ ($medication->status == 1)? 'Selected':'' }} value="1">Active
                                                    </option>
                                                    <option {{ ($medication->status == 0)? 'Selected':'' }} value="0">In-Active
                                                    </option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                        
                                    </div>


                                <div class="col-lg-12" >
                                    <input type="hidden" name="medication_id" value="{{$medication->id}}">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
    <script src="{{asset('public/admin/js/medication.js')}}"></script>
@endsection



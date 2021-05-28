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
                            <h3 class="card-title">Edit Hospital Configuration</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('hospitalConfigurationUpdate') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <span style="color:red">*</span></label>
                                            <input type="text" name="title" id="title"
                                                   class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Name" value="{{ $hospitalConfig->key }}" required>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Hospital <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="hospital_id" id="hospital_id"
                                                    class="form-control {{ $errors->has('hospital_id') ? ' is-invalid' : '' }}"
                                                    title="Select Hospital" required>
                                                @foreach($hospitals as $hospital)
                                                    <option
                                                        value="{{ $hospital->id }}" {{($hospitalConfig->hospital_id ==$hospital->id )? "selected":''}} >{{ $hospital->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('hospital_id'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('hospital_id') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div> --}}

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Lab Tests <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="lab_tests[]" id="lab_tests" multiple="multiple"
                                                    class="selectpicker form-control {{ $errors->has('lab_tests') ? ' is-invalid' : '' }}"
                                                    title="Select Lab Tests" required>
                                                @foreach($labTests as $labTest)
                                                    <option value="{{ $labTest->id }}"
                                                            @foreach($hospitalConfig->latTests as $item)
                                                            @if($item->lab_test_id == $labTest->id) selected @endif
                                                        @endforeach
                                                    >{{ $labTest->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('lab_tests'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lab_tests') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Facilities <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="facilities[]" id="facilities" multiple="multiple"
                                                    class="selectpicker form-control {{ $errors->has('facilities') ? ' is-invalid' : '' }}"
                                                    title="Select Facilities" required>
                                                @foreach($facilities as $facility)
                                                    <option value="{{ $facility->id }}"
                                                            @foreach($hospitalConfig->facilities as $item)
                                                            @if($item->facility_id == $facility->id) selected @endif
                                                        @endforeach
                                                    >{{ $facility->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('facilities'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('facilities') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Medication <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="medications[]" id="medications" multiple="multiple"
                                                    class="selectpicker form-control {{ $errors->has('medications') ? ' is-invalid' : '' }}"
                                                    title="Select Medication" required>
                                                @foreach($medications as $medication)
                                                    <option value="{{ $medication->id }}"
                                                            @foreach($hospitalConfig->medications as $item)
                                                            @if($item->medication_id == $medication->id) selected @endif
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
                                </div>

                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Specialties <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="specialties[]" id="specialties" multiple="multiple"
                                                    class="selectpicker form-control {{ $errors->has('specialties') ? ' is-invalid' : '' }}"
                                                    title="Select Specialties" required>
                                                @foreach($specialties as $specialty)
                                                    <option value="{{ $specialty->id }}"
                                                            @foreach($hospitalConfig->specialties as $item)
                                                            @if($item->specialty_id == $specialty->id) selected @endif
                                                        @endforeach
                                                    >{{ $specialty->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('specialties'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('specialties') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <input type="hidden" name="hospital_config_id" value="{{$hospitalConfig->id}}">
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
    <script src="{{asset('public/admin/js/hospitalConfiguration.js')}}"></script>
@endsection



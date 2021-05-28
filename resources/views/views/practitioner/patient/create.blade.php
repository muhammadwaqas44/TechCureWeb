@extends('layouts.practitioner')

@section('extra-css')
    <style>
        .input-group-addon {
            padding: 0px;
            border: 0px;
        }

        .dropify-wrapper{
            height:120px !important;
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
                            <h3 class="card-title">Create Patient</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerPatientStore') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Name <span style="color:red">*</span></label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Name" value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Email <span style="color:red">*</span></label>
                                                <input type="email" name="email" id="email"
                                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Email" value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Phone <span style="color:red">*</span></label>
                                                <input type="text" placeholder="Enter Phone " data-inputmask="'mask': '0999-9999999'" maxlength="12" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                                    class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    value="{{ old('phone') }}" required>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Date of Birth<span style="color:red">*</span></label>
                                            <div class="input-group date">
                                                <input type="text" name="dob" id="dob"
                                                    class="form-control {{ $errors->has('dob') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter DOB" value="{{ old('dob') }}" required>
                                                <span class="input-group-addon">
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                                @if ($errors->has('dob'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('dob') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Gender <span style="color:red">*</span></label>
                                                <select name="gender" id="gender"
                                                    class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Gender</option>
                                                    <option value="1" {{ (old('gender') == '1') ? 'selected' : '' }}>Male</option>
                                                    <option value="2" {{ (old('gender') == '2') ? 'selected' : '' }}>Female</option>
                                                    <option value="3" {{ (old('gender') == '3') ? 'selected' : '' }}>Other</option>

                                                </select>
                                                @if ($errors->has('gender'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>

            
                                    <div class="row" style="width:100%">

                                        <div class="form-group col-lg-6">
                                            <label>Password <span style="color:red">*</span></label>
                                            <input type="password" name="password" id="password"
                                                class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Password" value="{{ old('password') }}" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
            
                                        <div class="form-group col-lg-6">
                                            <label>Confirm Password <span style="color:red">*</span></label>
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}" required>
                                            @if ($errors->has('confirm_password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
            
                                    <div class="row" style="width:100%">

                                        
                                        
                                        <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                            <div class="form-group ">
                                                <label>Address</label>
                                                <textarea rows="5" name="address" style="width:100% !important">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
            
                                    </div>

                                    <div class="row" style="width:100%">
                                        <div class="card-header" style="width:100%;padding:10px">
                                            <h3 class="card-title">Patient Reports</h3>
                                        </div>
                                    </div>

                                    <div class="row mt-3" style="width:100%">
                                        <div class="repeater-default" style="width:100%">
                                            <div data-repeater-list="patient_reports" style="padding-left: 10px;
                                            padding-right: 10px;">
                                                <div data-repeater-item class="row">

                                                    <div class="col-sm-12 col-md-11 col-lg-11">
                                                        <div class="form-group">
                                                            <label>Title <span style="color:red">*</span></label>
                                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"  required>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-1 col-lg-1" style="text-align:center">
                                                        <button style="margin-top:30px" type="button" class="btn btn-danger" data-repeater-delete> <i class="fa fa-trash"></i> </button>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label for="customFile">Image/File <span style="color:red">*</span></label>
                                                            <input  type="file" class="form-control dropify" name="image_url" required>
                                                            
                                                          </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="form-group overflow-hidden">
                                                <div class="col-12" style="text-align:end">
                                                    <button style="margin-right:12px" data-repeater-create class="btn btn-primary" type="button"> <i class="fa fa-plus"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="lastValueDropify" value="">


                                <div class="col-lg-12">
                                    <div class="col-lg-6">
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
    <script src="{{asset('public/admin/js/patient.js')}}"></script>
@endsection



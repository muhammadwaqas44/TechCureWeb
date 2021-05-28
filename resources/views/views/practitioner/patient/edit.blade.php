@extends('layouts.practitioner')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('public/admin/plugins/lightbox/lightbox.min.css')}}">
    <style>
        .required-star{
            color: red;
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
                            <h3 class="card-title">Edit Patient</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerPatientUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                        
                                <div class="row" style="width:100%">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <span class="required-star">*</span></label>
                                            <input type="text" name="name" id="name"
                                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Name" value="{{$patient->name}}" required>
                                            
                                        </div>
                                    </div>
        
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Email <span class="required-star">*</span></label>
                                            <input type="text" name="email" id="email" disabled
                                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Email" value="{{ $patient->email }}" required>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone <span style="color:red">*</span></label>
                                            <input type="text" placeholder="Enter Phone " data-inputmask="'mask': '0999-9999999'" maxlength="12" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                                class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                value="{{ $patient->phone }}" required>
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
                                                placeholder="Enter DOB" value="{{ date('m/d/Y', strtotime($patient->dob)) }}" required>
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
                                                <option value="1" {{ ($patient->gender == 1) ? 'selected' : '' }}>Male</option>
                                                <option value="2" {{ ($patient->gender == 2) ? 'selected' : '' }}>Female</option>
                                                <option value="3" {{ ($patient->gender == 3) ? 'selected' : '' }}>Other</option>

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
    

                                    <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                        <div class="form-group ">
                                            <label>Address</label>
                                            <textarea rows="5" name="address" style="width:100% !important">{{ $patient->address }}</textarea>
                                        </div>
                                    </div>

                                </div>

                                @if(count($patient->reports)>0)
                                    <div class="row" style="width:100%">
                                        <div class="card-header" style="width:100%;padding:10px">
                                            <h3 class="card-title">Previous Reports</h3>
                                        </div>
                                    </div>
                                @endif

                                <div class="row" style="width:100%">
                                    @foreach ($patient->reports as $item)
                                        <div class="item col-xs-2 col-lg-2 target del" data-id={{ $item->id }}>
                                            <div class="thumbnail card">
                                                <a class="img-event" style="text-align:center" href="{{asset('storage/app/public/'.$item->image_url)}}" target="_blank">
                                                    <i class="fa fa-image fa-5x group list-group-image img-fluid"></i>
                                                </a>
                                                <div  style="text-align:center">{{ $item->title }}</div>
                                                <div  style="text-align:center">
                                    
                                                    <button type="button" onclick="reportDeleteFunction('{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                       
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
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

                                <br/>
                                <div class="col-md-12" style="width:100%">
                                    <label> Change Password? </label>
                                    <input type="checkbox" id="change_password" onclick="patientChangePassword()">
                                </div>

                                <br/>
                                <div class="row" id="password_box" style="width:100%;display:none;">
                                    <div class="form-group col-lg-6">
                                        <label>Password <span class="required-star"></span></label>
                                        <input type="password" name="password" id="password"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            placeholder="Enter Password" value="{{ old('password') }}" >
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
        
                                    <div class="form-group col-lg-6">
                                        <label>Confirm Password <span class="required-star"></span></label>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                                            placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}" >
                                        @if ($errors->has('confirm_password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="patient_id" value="{{$patient->id}}" />
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
    <script src="{{asset('public/admin/plugins/lightbox/lightbox.min.js')}}"></script>
    <script src="{{asset('public/admin/js/patient.js')}}"></script>
@endsection




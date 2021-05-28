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
                            <h3 class="card-title">Edit Clinic</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('clinicUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">
                                    <div class="col-md-12">
                                        @if($clinic->all_day==1)
                                        Timings- 24/7 <br>
                                        @else
                                        <span>Timings-  ( {{ $clinic->from_day }} to {{ $clinic->to_day }} )  ( {{ date("h:i a", strtotime($clinic->opening_time)) }} to {{ date("h:i a", strtotime($clinic->closing_time)) }} )</span>
                                        <br>
                                        @endif
                                        
                                    </div>
                                </div>
                        
                                <div class="row" style="width:100%">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <span class="required-star">*</span></label>
                                            <input type="text" name="name" id="name"
                                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Name" value="{{$clinic->name}}" required>
                                            
                                        </div>
                                    </div>
        
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>UserName <span class="required-star">*</span></label>
                                            <input type="text" name="email" id="email" disabled
                                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Email" value="{{ $clinic->email }}" required>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone <span style="color:red">*</span></label>
                                            <input type="text" placeholder="Enter Phone " data-inputmask="'mask': '0999-9999999'" maxlength="12" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                                class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                value="{{ $clinic->phone }}" required>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Status <span style="color:red">*</span></label>
                                        <select name="status" id="status"
                                            class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                            <option value="" selected disabled>Select Option</option>
                                            <option {{ ($clinic->status == 1)? 'Selected':'' }} value="1">Active
                                            </option>
                                            <option {{ ($clinic->status == 0)? 'Selected':'' }} value="0">In-Active
                                            </option>
                                        </select>
                                       
                                    </div>

                                </div>

                                {{-- <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>From Day <span style="color:red">*</span></label>
                                            <select name="from_day" id="from_day"
                                                class="form-control {{ $errors->has('from_day') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>From Day</option>
                                                <option value="monday" {{ ($clinic->from_day == 'monday') ? 'selected' : '' }}>Monday</option>
                                                <option value="tuesday" {{ ($clinic->from_day == 'tuesday') ? 'selected' : '' }}>Tuesday</option>
                                                <option value="wednesday" {{ ($clinic->from_day == 'wednesday') ? 'selected' : '' }}>Wednesday</option>
                                                <option value="thursday" {{ ($clinic->from_day == 'thursday') ? 'selected' : '' }}>Thursday</option>
                                                <option value="friday" {{ ($clinic->from_day == 'friday') ? 'selected' : '' }}>Friday</option>
                                                <option value="saturday" {{ ($clinic->from_day == 'saturday') ? 'selected' : '' }}>Saturday</option>
                                                <option value="sunday" {{ ($clinic->from_day == 'sunday') ? 'selected' : '' }}>Sunday</option>
                                            </select>
                                            @if ($errors->has('from_day'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('from_day') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>To Day <span style="color:red">*</span></label>
                                            <select name="to_day" id="to_day"
                                                class="form-control {{ $errors->has('to_day') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>To Day</option>
                                                <option value="monday" {{ ($clinic->to_day == 'monday') ? 'selected' : '' }}>Monday</option>
                                                <option value="tuesday" {{ ($clinic->to_day == 'tuesday') ? 'selected' : '' }}>Tuesday</option>
                                                <option value="wednesday" {{ ($clinic->to_day == 'wednesday') ? 'selected' : '' }}>Wednesday</option>
                                                <option value="thursday" {{ ($clinic->to_day == 'thursday') ? 'selected' : '' }}>Thursday</option>
                                                <option value="friday" {{ ($clinic->to_day == 'friday') ? 'selected' : '' }}>Friday</option>
                                                <option value="saturday" {{ ($clinic->to_day == 'saturday') ? 'selected' : '' }}>Saturday</option>
                                                <option value="sunday" {{ ($clinic->to_day == 'sunday') ? 'selected' : '' }}>Sunday</option>
                                            </select>
                                            @if ($errors->has('to_day'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('to_day') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label>Opening Time <span style="color:red">*</span></label>
                                                <div class="input-group date"  id="opening_time" data-target-input="nearest">
                                                    <input type="text" name="opening_time" class="form-control datetimepicker-input" data-target="#opening_time" value="{{ $clinic->opening_time }}" required/>
                                                    <div class="input-group-append" data-target="#opening_time" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label>Closing Time <span style="color:red">*</span></label>
                                                <div class="input-group date" id="closing_time" data-target-input="nearest">
                                                    <input type="text" name="closing_time" class="form-control datetimepicker-input" data-target="#closing_time" value="{{ $clinic->closing_time }}" required/>
                                                    <div class="input-group-append" data-target="#closing_time" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div> --}}
                                
                                <div class="row" style="width:100%">

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Specialties </label>
                                            <div class="cleafix"></div>
                                            <select name="specialties[]" id="specialties" multiple data-live-search="true"
                                                class="selectpicker form-control" >
                                                @foreach($specialties as $specialty)
                                                    <option value="{{$specialty->id}}"
                                                        @foreach($clinic->specialties as $clinicSpecialty)
                                                            @if($specialty->id == $clinicSpecialty->id) selected @endif
                                                        @endforeach
                                                        >
                                                        {{ $specialty->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Facilities </label>
                                            <div class="cleafix"></div>
                                            <select name="facilities[]" id="facilities" multiple data-live-search="true"
                                                class="selectpicker form-control" >
                                                @foreach($facilities as $facility)
                                                    <option value="{{$facility->id}}"
                                                        @foreach($clinic->facilities as $clinicFacility)
                                                            @if($facility->id == $clinicFacility->id) selected @endif
                                                        @endforeach
                                                        >
                                                        {{ $facility->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Address</label>
                                            <textarea rows="5" name="address" style="width:100% !important">{{ $clinic->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Upload Logo</label>
                                            <input accept="image/*" type="file" class="form-control dropify" name="logo" @if ($clinic->logo) 
                                            data-default-file="{{asset('storage/app/public/'.$clinic->logo)}}" @endif>
                                        </div>
                                    </div>

                                </div>

                                <br/>
                                <div class="col-md-12" style="width:100%">
                                    <label> Change Password? </label>
                                    <input type="checkbox" id="change_password" onclick="clinicChangePassword()">
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
                                        <input type="hidden" name="clinic_id" value="{{$clinic->id}}" />
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
    <script src="{{asset('public/admin/js/clinic.js')}}"></script>
@endsection




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
                            <h3 class="card-title">Create Practitioner</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerStore') }}" method="post" enctype="multipart/form-data">
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
                                            <div class="form-group ">
                                                <label>Status <span style="color:red">*</span></label>
                                                <select name="status" id="status"
                                                    class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Status</option>
                                                    <option value="1" {{ (old('status') == '1') ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ (old('status') == '0') ? 'selected' : '' }}>In-Active</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
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
                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
                                            <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            @if ($errors->has('confirm_password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                            <div class="form-group">
                                                <label>Qualification <span style="color:red">*</span></label>
                                                <select name="qualification_id" id="qualification_id" class="form-control {{ $errors->has('qualification_id') ? ' is-invalid' : '' }}" title="Select Qualification" required>
                                                    <option value="" selected disabled>Select Qualification</option>
                                                    @foreach($qualifications as $qualification)
                                                        <option value="{{ $qualification->id }}" {{ (old('qualification_id') == $qualification->id) ? 'selected' : '' }}>{{ $qualification->title }}</option>
                                                    @endforeach
                                                </select>
                                                 @if ($errors->has('qualification_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('qualification_id') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Specialties </label>
                                                <div class="cleafix"></div>
                                                <select name="specialties[]" id="specialties" multiple="multiple" class="selectpicker form-control {{ $errors->has('specialties') ? ' is-invalid' : '' }}" title="Select Specialties" >
                                                    @foreach($specialties as $specialty)
                                                        <option value="{{ $specialty->id }}"
                                                            @foreach(old('specialties', ['value']) as $id)
                                                                @if($specialty->id == $id) selected @endif
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

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>License No. <span style="color:red">*</span></label>
                                                <input type="text" name="license_no" id="license_no"
                                                    class="form-control {{ $errors->has('license_no') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter License No." value="{{ old('license_no') }}" required>
                                                @if ($errors->has('license_no'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('license_no') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Agora App Id </label>
                                                <input type="text" name="agora_app_id" id="agora_app_id"
                                                    class="form-control {{ $errors->has('agora_app_id') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Agora App Id ." value="{{ old('agora_app_id') }}">
                                                @if ($errors->has('agora_app_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('agora_app_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Agora App Certificate </label>
                                                <input type="text" name="agora_app_certificate" id="agora_app_certificate"
                                                       class="form-control {{ $errors->has('agora_app_certificate') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Agora App Certificate ." value="{{ old('agora_app_certificate') }}" required>
                                                @if ($errors->has('agora_app_certificate'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('agora_app_certificate') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div> <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Agora App Channel </label>
                                                <input type="text" name="agora_app_channel" id="agora_app_channel"
                                                       class="form-control {{ $errors->has('agora_app_channel') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Agora App Channel ." value="{{ old('agora_app_channel') }}" required>
                                                @if ($errors->has('agora_app_channel'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('agora_app_channel') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Practitioner License Image  <span style="color:red">*</span></label>
                                                <input accept="image/*" type="file" class="form-control dropify" name="license_image" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Address</label>
                                                <textarea rows="5" name="address" style="width:100% !important">{{ old('address') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Description</label>
                                                <textarea rows="5" name="description" style="width:100% !important">{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Practitioner Profile Image</label>
                                                <input accept="image/*" type="file" class="form-control dropify" name="image">
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-12 col-md-12 col-lg-12 mt-3 mb-4">
                                            <div class="form-group">
                                                <label class="float-left checkbox-design">
                                                    <input type="checkbox" name="online_clinic" id="online_clinic"><span class="checkmark"></span><p class="m-0">Online Clinic</p>
                                                </label>
                                            </div>
                                        </div> --}}

                                    </div>

                                    @php
                                        $idCount = 0;
                                        $old_clinics = session()->get('old_practitioner_clinics');
                                    @endphp

                                    @if(!empty($old_clinics))
                                        <div class="row" style="width:100%">

                                            <input type="hidden" id="totalOldClinics" value="{{ count($old_clinics) }}">
                                            <input type="hidden" id="lastValueDays" value="{{ count($old_clinics) }}">
                                            <input type="hidden" id="lastValueToTime" value="{{ count($old_clinics) }}">
                                            <input type="hidden" id="lastValueFromTime" value="{{ count($old_clinics) }}">
                                            <input type="hidden" id="lastValueFromOnlineClinic" value="{{ count($old_clinics) }}">

                                            <div class="repeater-default" style="width:100%">
                                                <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                                padding-right: 10px;">
                                                    {{-- {{dd($old_clinics)}} --}}
                                                    @for ($i = 0; $i < count($old_clinics[0]); $i++)

                                                        <div data-repeater-item class="row">

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Clinics old <span style="color:red">*</span></label>
                                                                    <select name="clinic" id="clinic" class="form-control online-select-clinic{{$idCount}} {{ $errors->has('specialties') ? ' is-invalid' : '' }}" title="Select Clinic" required>
                                                                        <option value="" selected disabled>Select Clinic</option>
                                                                        @foreach($clinics as $clinic)
                                                                            <option value="{{ $clinic->id }}" {{ ($old_clinics[0][$i]['clinic'] == $clinic->id) ? 'selected' : '' }}>{{ $clinic->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Clinic Days <span style="color:red">*</span></label>
                                                                    <select name="days" id="days_{{$idCount}}" multiple="multiple" class="selectpicker day form-control {{ $errors->has('days') ? ' is-invalid' : '' }}" title="Select days" required>

                                                                        <option value="monday"
                                                                            @for ($j = 0; $j < count($old_clinics[0][$i]['days']); $j++)
                                                                                @if($old_clinics[0][$i]['days'][$j] == "monday") selected @endif
                                                                            @endfor>
                                                                            Monday
                                                                        </option>
                                                                        <option value="tuesday"
                                                                        @for ($j = 0; $j < count($old_clinics[0][$i]['days']); $j++)
                                                                        @if($old_clinics[0][$i]['days'][$j] == "tuesday") selected @endif
                                                                    @endfor>
                                                                            Tuesday
                                                                        </option>
                                                                        <option value="wednesday"
                                                                        @for ($j = 0; $j < count($old_clinics[0][$i]['days']); $j++)
                                                                        @if($old_clinics[0][$i]['days'][$j] == "wednesday") selected @endif
                                                                    @endfor>
                                                                            Wednesday
                                                                        </option>
                                                                        <option value="thursday"
                                                                        @for ($j = 0; $j < count($old_clinics[0][$i]['days']); $j++)
                                                                        @if($old_clinics[0][$i]['days'][$j] == "thursday") selected @endif
                                                                    @endfor>
                                                                            Thursday
                                                                        </option>
                                                                        <option value="friday"
                                                                        @for ($j = 0; $j < count($old_clinics[0][$i]['days']); $j++)
                                                                        @if($old_clinics[0][$i]['days'][$j] == "friday") selected @endif
                                                                    @endfor>
                                                                            Friday
                                                                        </option>
                                                                        <option value="saturday"
                                                                        @for ($j = 0; $j < count($old_clinics[0][$i]['days']); $j++)
                                                                        @if($old_clinics[0][$i]['days'][$j] == "saturday") selected @endif
                                                                    @endfor>
                                                                            Saturday
                                                                        </option>
                                                                        <option value="sunday"
                                                                        @for ($j = 0; $j < count($old_clinics[0][$i]['days']); $j++)
                                                                        @if($old_clinics[0][$i]['days'][$j] == "sunday") selected @endif
                                                                    @endfor>
                                                                            Sunday
                                                                        </option>

                                                                    </select>
                                                                    @if ($errors->has('days'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('days') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="bootstrap-timepicker">
                                                                    <div class="form-group">
                                                                        <label>Opening Time <span style="color:red">*</span></label>
                                                                        <div class="input-group date from_time"  id="from_time_{{$idCount}}" data-target-input="nearest">
                                                                            <input type="text" name="from_time" class="form-control datetimepicker-input" data-target="#from_time_{{$idCount}}" value="{{ $old_clinics[0][$i]['from_time'] }}" required/>
                                                                            <div class="input-group-append" data-target="#from_time_{{$idCount}}" data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="bootstrap-timepicker">
                                                                    <div class="form-group">
                                                                        <label>Closing Time <span style="color:red">*</span></label>
                                                                        <div class="input-group date to_time" id="to_time_{{$idCount}}" data-target-input="nearest">
                                                                            <input type="text" name="to_time" class="form-control datetimepicker-input" data-target="#to_time_{{$idCount}}" value="{{ $old_clinics[0][$i]['to_time'] }}" required/>
                                                                            <div class="input-group-append" data-target="#to_time_{{$idCount}}" data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <label class="online-physical-fee-span{{$idCount}}">Fee (PKR) (Physical) @if(isset($old_clinics[0][$i]['online_clinic']) && $old_clinics[0][$i]['online_clinic']) @else <span style="color:red">*</span> @endif </label>
                                                                    <input type="number" min="0" name="physical_fee" class="form-control online-physical-fee{{$idCount}}" value="{{ $old_clinics[0][$i]['physical_fee'] }}" @if(isset($old_clinics[0][$i]['online_clinic']) && $old_clinics[0][$i]['online_clinic']) @else required @endif/>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Fee (PKR) (Online) <span style="color:red">*</span></label>
                                                                    <input type="number" min="0" name="online_fee" class="form-control " value="{{ $old_clinics[0][$i]['online_fee'] }}" required/>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="online_clinic" class="online_clinic{{$idCount}}" value="1" @if(isset($old_clinics[0][$i]['online_clinic']) && $old_clinics[0][$i]['online_clinic']) checked @endif onclick="onlineClinicCheckbox($(this))"> Online Clinic
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:right">
                                                                <button style="margin-right:10px" type="button" class="btn btn-danger" data-repeater-delete> <i class="fa fa-trash"></i> </button>
                                                            </div>

                                                        </div>

                                                        @php
                                                            $idCount = $idCount+1;
                                                        @endphp

                                                    @endfor

                                                </div>
                                                <div class="form-group overflow-hidden mt-2">
                                                    <div class="col-12" style="text-align:end">
                                                        <button style="margin-right:12px" data-repeater-create class="btn btn-primary" type="button"> <i class="fa fa-plus"></i> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(empty($old_clinics))
                                        <div class="row" style="width:100%">
                                            <div class="repeater-default" style="width:100%">
                                                <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                                padding-right: 10px;">

                                                    <div data-repeater-item class="row">

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinics <span style="color:red">*</span></label>
                                                                <select name="clinic" id="clinic" class="form-control online-select-clinic {{ $errors->has('clinic') ? ' is-invalid' : '' }}" title="Select Clinic" required>
                                                                    <option value="" selected disabled>Select Clinic</option>
                                                                    @foreach($clinics as $clinic)
                                                                        <option value="{{ $clinic->id }}" >{{ $clinic->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinic Days <span style="color:red">*</span></label>
                                                                <select name="days" id="days_0" multiple="multiple" class="selectpicker day form-control {{ $errors->has('days') ? ' is-invalid' : '' }}" title="Select days" required>

                                                                    <option value="monday" {{ (old('to_day') == 'monday') ? 'selected' : '' }}>Monday</option>
                                                                    <option value="tuesday" {{ (old('to_day') == 'tuesday') ? 'selected' : '' }}>Tuesday</option>
                                                                    <option value="wednesday" {{ (old('to_day') == 'wednesday') ? 'selected' : '' }}>Wednesday</option>
                                                                    <option value="thursday" {{ (old('to_day') == 'thursday') ? 'selected' : '' }}>Thursday</option>
                                                                    <option value="friday" {{ (old('to_day') == 'friday') ? 'selected' : '' }}>Friday</option>
                                                                    <option value="saturday" {{ (old('to_day') == 'saturday') ? 'selected' : '' }}>Saturday</option>
                                                                    <option value="sunday" {{ (old('to_day') == 'sunday') ? 'selected' : '' }}>Sunday</option>

                                                                </select>
                                                                @if ($errors->has('days'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('days') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <label>Opening Time <span style="color:red">*</span></label>
                                                                    <div class="input-group date from_time"  id="from_time_0" data-target-input="nearest">
                                                                        <input type="text" name="from_time" class="form-control datetimepicker-input" data-target="#from_time_0" value="{{ old('from_time') }}" required/>

                                                                        <div class="input-group-append" data-target="#from_time_0" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <label>Closing Time <span style="color:red">*</span></label>
                                                                    <div class="input-group date to_time" id="to_time_0" data-target-input="nearest">
                                                                        <input type="text" name="to_time" class="form-control datetimepicker-input" data-target="#to_time_0" value="{{ old('to_time') }}" required/>

                                                                        <div class="input-group-append" data-target="#to_time_0" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label class="online-physical-fee-span">Fee (PKR) (Physical) <span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="physical_fee" class="form-control online-physical-fee" value="{{ old('physical_fee') }}" required/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Fee (PKR) (Online) <span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="online_fee" class="form-control" value="{{ old('online_fee') }}" required/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <input type="checkbox" name="online_clinic" class="online_clinic" value="1" {{ old('online_clinic') ? 'checked': '' }} onclick="onlineClinicCheckbox($(this))"> Online Clinic
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:right">
                                                            <button style="margin-right:10px" type="button" class="btn btn-danger" data-repeater-delete> <i class="fa fa-trash"></i> </button>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group overflow-hidden mt-2">
                                                    <div class="col-12" style="text-align:end">
                                                        <button style="margin-right:12px" data-repeater-create class="btn btn-primary" type="button"> <i class="fa fa-plus"></i> </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="lastValueDays" value="">
                                            <input type="hidden" id="lastValueFromTime" value="">
                                            <input type="hidden" id="lastValueToTime" value="">
                                            <input type="hidden" id="lastValueFromOnlineClinic" value="">
                                        </div>
                                    @endif


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
    {{-- <script src="{{asset('public/admin/js/practitioner.js')}}"></script> --}}
    <script>
    $(document).ready( function () {
        $('#specialties').select2();
        $('#qualification_id').select2();
        $('.clinic').select2();
        $('.dropify').dropify();

        if($('.online_clinic').length > 0)
        {
            $('#lastValueDays').val($('select.selectpicker.day').length);
            $('#lastValueToTime').val($('div.date.to_time').length);
            $('#lastValueFromTime').val($('div.date.to_time').length);
            $('#lastValueFromOnlineClinic').val($('.online_clinic').length);
        }
        else
        {
            var totalLength = ($('select.selectpicker.day').length);
            $('#lastValueDays').val(totalLength);
            $('#lastValueToTime').val(totalLength);
            $('#lastValueFromTime').val(totalLength);
            $('#lastValueFromOnlineClinic').val(totalLength);
        }

        var toTimeVal;
        var fromTimeVal;
        var dayVal;
        var onlineClinic;

        $('.repeater-default').repeater({
            show: function () {
            $(this).slideDown();

                toTimeVal = $('#lastValueToTime').val();
                fromTimeVal = $('#lastValueFromTime').val();
                dayVal = $('#lastValueDays').val();
                onlineClinic = $('#lastValueFromOnlineClinic').val();
                $(this).find('select.selectpicker.day').removeAttr('id').attr('id', 'day_'+dayVal);
                $(this).find('div.date.to_time').removeAttr('id').attr('id', 'to_time_'+toTimeVal);
                $(this).find('input[data-target="#to_time_0"]').removeAttr('data-target').attr('data-target', '#to_time_'+toTimeVal);
                $(this).find('div[data-target="#to_time_0"]').removeAttr('data-target').attr('data-target', '#to_time_'+toTimeVal);

                $(this).find('div.date.from_time').removeAttr('id').attr('id', 'from_time_'+fromTimeVal);
                $(this).find('input[data-target="#from_time_0"]').removeAttr('data-target').attr('data-target', '#from_time_'+fromTimeVal);
                $(this).find('div[data-target="#from_time_0"]').removeAttr('data-target').attr('data-target', '#from_time_'+fromTimeVal);

                if($('.online_clinic').length > 0)
                {
                    $('.online_clinic').last().removeClass('online_clinic').addClass('online_clinic' + onlineClinic);
                    $('.online-select-clinic').last().removeClass('online-select-clinic').addClass('online-select-clinic' + onlineClinic);
                    $('.online-physical-fee-span').last().removeClass('online-physical-fee-span').addClass('online-physical-fee-span' + onlineClinic);
                    $('.online-physical-fee').last().removeClass('online-physical-fee').addClass('online-physical-fee' + onlineClinic);
                }
                else
                {
                    $('.online_clinic0').last().removeClass('online_clinic0').addClass('online_clinic' + onlineClinic);
                    $('.online-select-clinic0').last().removeClass('online-select-clinic0').addClass('online-select-clinic' + onlineClinic);
                    $('.online-physical-fee-span0').last().removeClass('online-physical-fee-span0').addClass('online-physical-fee-span' + onlineClinic);
                    $('.online-physical-fee0').last().removeClass('online-physical-fee0').addClass('online-physical-fee' + onlineClinic);
                }


                $('#lastValueToTime').val(parseInt(toTimeVal)+1);
                $('#lastValueFromTime').val(parseInt(fromTimeVal)+1);
                $('#lastValueDays').val(parseInt(dayVal)+1);
                $('#lastValueFromOnlineClinic').val(parseInt(onlineClinic)+1);

                $('#day_'+dayVal).select2();

                $('#from_time_'+fromTimeVal).datetimepicker({
                    format: 'LT',
                    pickDate: false,
                    pickTime: true,
                    // useSeconds: false,
                    // format: 'hh:mm',
                    stepping: 10 //will change increments to 10m, default is 1m
                })
                $('#to_time_'+toTimeVal).datetimepicker({
                    format: 'LT',
                    pickDate: false,
                    pickTime: true,
                    // useSeconds: false,
                    // format: 'hh:mm',
                    stepping: 10 //will change increments to 10m, default is 1m
                });


            },
            hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this clinic timings?')) {
                $(this).slideUp(deleteElement);
            }
            },
            isFirstItemUndeletable: true
        });

        $(':input').inputmask();
        for(var i = 0; i < $('div.date.to_time').length; i++){
            $('#from_time_'+i).datetimepicker({
                format: 'LT',
                pickDate: false,
                pickTime: true,
                // useSeconds: false,
                // format: 'hh:mm',
                stepping: 10 //will change increments to 10m, default is 1m
            })
            $('#to_time_'+i).datetimepicker({
                format: 'LT',
                pickDate: false,
                pickTime: true,
                // useSeconds: false,
                // format: 'hh:mm',
                stepping: 10 //will change increments to 10m, default is 1m
            })
        }

        for(var j=0; j< $('select.selectpicker.day').length; j++){
            $('#days_'+j).select2();
        }
    });

    function onlineClinicCheckbox(element)
    {
        var onlineClinicClasses = element.get(0).className;
        var specificOnlineClinicClass = onlineClinicClasses.split(' ')[0];
        var onlineClinicClassFinal = specificOnlineClinicClass.replace(/[^\d.]/g, '');
        var onlineClinicClassFinalInt = parseInt(onlineClinicClassFinal);

        if (isNaN(onlineClinicClassFinalInt)) {
            var count = "";
        } else {
            var count = parseInt(onlineClinicClassFinalInt);
        }

        if ($('.'+onlineClinicClasses).is(':checked'))
        {
            $('.online-select-clinic'+count).val(1).attr('selected', 'true');
            $('.online-physical-fee'+count).prop('required', false);
            $('.online-physical-fee-span'+count).find("span").remove();
        }
        if (!$('.'+onlineClinicClasses).is(':checked'))
        {
            $('.online-select-clinic'+count).val(1).removeAttr('selected', 'true');
            $('.online-select-clinic'+count).val('').attr('selected', 'true');
            $('.online-physical-fee'+count).prop('required', true);
            $('.online-physical-fee-span'+count).append("<span style='color:red'>*</span");
        }
    };

    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    </script>
@endsection



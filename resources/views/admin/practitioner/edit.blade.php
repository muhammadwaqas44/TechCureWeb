@extends('layouts.backend')

@section('extra-css')
    <style>
        .required-star {
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
                            <h3 class="card-title">Edit Practitioner</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerUpdate') }}" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <span class="required-star">*</span></label>
                                            <input type="text" name="name" id="name"
                                                   class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Name" value="{{$practitioner->name}}" required>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Email <span class="required-star">*</span></label>
                                            <input type="text" name="email" id="email" disabled
                                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Email" value="{{ $practitioner->email }}"
                                                   required>

                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone <span style="color:red">*</span></label>
                                            <input type="text" placeholder="Enter Phone "
                                                   data-inputmask="'mask': '0999-9999999'" maxlength="12"
                                                   class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                   name="phone"
                                                   class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                   value="{{ $practitioner->phone }}" required>
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
                                                class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                required>
                                            <option value="" selected disabled>Select Option</option>
                                            <option {{ ($practitioner->status == 1)? 'Selected':'' }} value="1">Active
                                            </option>
                                            <option {{ ($practitioner->status == 0)? 'Selected':'' }} value="0">
                                                In-Active
                                            </option>
                                        </select>

                                    </div>

                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                        <div class="form-group">
                                            <label>Qualification <span style="color:red">*</span></label>
                                            <select name="qualification_id" id="qualification_id"
                                                    class="form-control {{ $errors->has('qualification_id') ? ' is-invalid' : '' }}"
                                                    title="Select Qualification" required>
                                                <option value="" selected disabled>Select Qualification</option>
                                                @foreach($qualifications as $qualification)
                                                    <option
                                                        value="{{ $qualification->id }}" {{ ($practitioner->qualification_id == $qualification->id) ? 'selected' : '' }}>{{ $qualification->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('qualification_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qualification_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Specialties </label>
                                            <div class="cleafix"></div>
                                            <select name="specialties[]" id="specialties" multiple
                                                    data-live-search="true"
                                                    class="selectpicker form-control">
                                                @foreach($specialties as $specialty)
                                                    <option value="{{$specialty->id}}"
                                                            @foreach($practitioner->specialties as $practitionerSpecialty)
                                                            @if($specialty->id == $practitionerSpecialty->id) selected @endif
                                                        @endforeach
                                                    >
                                                        {{ $specialty->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>License No. <span style="color:red">*</span></label>
                                            <input type="text" name="license_no" id="license_no"
                                                   class="form-control {{ $errors->has('license_no') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter License No."
                                                   value="{{ $practitioner->license_no }}" required>
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
                                                   placeholder="Enter Agora App Id ."
                                                   value="{{ $practitioner->agora_app_id }}">
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
                                                   placeholder="Enter Agora App Certificate ."
                                                   value="{{ $practitioner->agora_app_certificate }}" required>
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
                                                   placeholder="Enter Agora App Channel ."
                                                   value="{{ $practitioner->agora_app_channel }}" required>
                                            @if ($errors->has('agora_app_channel'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('agora_app_channel') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Practitioner License Image</label>
                                            <input accept="image/*" type="file" class="form-control dropify"
                                                   name="license_image" @if ($practitioner->license_image)
                                                   data-default-file="{{asset('storage/app/public/'.$practitioner->license_image)}}" @endif>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Address</label>
                                            <textarea rows="5" name="address"
                                                      style="width:100% !important">{{ $practitioner->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Description</label>
                                            <textarea rows="5" name="description"
                                                      style="width:100% !important">{{ $practitioner->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Practitioner Profile Image</label>
                                            <input accept="image/*" type="file" class="form-control dropify"
                                                   name="image" @if ($practitioner->image)
                                                   data-default-file="{{asset('storage/app/public/'.$practitioner->image)}}" @endif>
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-12 col-md-12 col-lg-12 mt-3 mb-4">
                                        <div class="form-group">
                                            <label class="float-left checkbox-design">
                                                <input type="checkbox" name="online_clinic" id="online_clinic" @if($practitioner->online_clinic == 1) checked @endif><span class="checkmark"></span><p class="m-0">Online Clinic</p>
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
                                        <input type="hidden" id="lastValueDays"
                                               value="{{count($old_clinics)+count($practitioner->clinics)}}">
                                        <input type="hidden" id="lastValueToTime"
                                               value="{{count($old_clinics)+count($practitioner->clinics)}}">
                                        <input type="hidden" id="lastValueFromTime"
                                               value="{{count($old_clinics)+count($practitioner->clinics)}}">
                                        <input type="hidden" id="lastValueFromOnlineClinic"
                                               value="{{count($old_clinics)+count($practitioner->clinics)}}">

                                        <div class="repeater-default" style="width:100%">
                                            <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                            padding-right: 10px;">
                                                {{-- {{dd($old_clinics)}} --}}
                                                @for ($i = 0; $i < count($old_clinics[0]); $i++)

                                                    <div data-repeater-item class="row">

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinics old <span
                                                                        style="color:red">*</span></label>
                                                                <select name="clinic" id="clinic"
                                                                        class="form-control online-select-clinic{{$idCount}} {{ $errors->has('specialties') ? ' is-invalid' : '' }}"
                                                                        title="Select Clinic" required>
                                                                    <option value="" selected disabled>Select Clinic
                                                                    </option>
                                                                    @foreach($clinics as $clinic)
                                                                        <option
                                                                            value="{{ $clinic->id }}" {{ ($old_clinics[0][$i]['clinic'] == $clinic->id) ? 'selected' : '' }}>{{ $clinic->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinic Days <span
                                                                        style="color:red">*</span></label>
                                                                <select name="days" id="days_{{$idCount}}"
                                                                        multiple="multiple"
                                                                        class="selectpicker day form-control {{ $errors->has('days') ? ' is-invalid' : '' }}"
                                                                        title="Select days" required>

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
                                                                    <div class="input-group date from_time"
                                                                         id="from_time_{{$idCount}}"
                                                                         data-target-input="nearest">
                                                                        <input type="text" name="from_time"
                                                                               class="form-control datetimepicker-input"
                                                                               data-target="#from_time_{{$idCount}}"
                                                                               value="{{ $old_clinics[0][$i]['from_time'] }}"
                                                                               required/>
                                                                        <div class="input-group-append"
                                                                             data-target="#from_time_{{$idCount}}"
                                                                             data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i
                                                                                    class="far fa-clock"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <label>Closing Time <span style="color:red">*</span></label>
                                                                    <div class="input-group date to_time"
                                                                         id="to_time_{{$idCount}}"
                                                                         data-target-input="nearest">
                                                                        <input type="text" name="to_time"
                                                                               class="form-control datetimepicker-input"
                                                                               data-target="#to_time_{{$idCount}}"
                                                                               value="{{ $old_clinics[0][$i]['to_time'] }}"
                                                                               required/>
                                                                        <div class="input-group-append"
                                                                             data-target="#to_time_{{$idCount}}"
                                                                             data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i
                                                                                    class="far fa-clock"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label class="online-physical-fee-span{{$idCount}}">Fee
                                                                    (PKR)
                                                                    (Physical) @if(isset($old_clinics[0][$i]['online_clinic']) && $old_clinics[0][$i]['online_clinic']) @else
                                                                        <span style="color:red">*</span> @endif </label>
                                                                <input type="number" min="0" name="physical_fee"
                                                                       class="form-control online-physical-fee{{$idCount}}"
                                                                       value="{{ $old_clinics[0][$i]['physical_fee'] }}"
                                                                       @if(isset($old_clinics[0][$i]['online_clinic']) && $old_clinics[0][$i]['online_clinic']) @else required @endif/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Fee (PKR) (Online) <span
                                                                        style="color:red">*</span></label>
                                                                <input type="number" min="0" name="online_fee"
                                                                       class="form-control "
                                                                       value="{{ $old_clinics[0][$i]['online_fee'] }}"
                                                                       required/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <input type="checkbox" name="online_clinic"
                                                                       class="online_clinic{{$idCount}}" value="1"
                                                                       @if(isset($old_clinics[0][$i]['online_clinic']) && $old_clinics[0][$i]['online_clinic']) checked
                                                                       @endif onclick="onlineClinicCheckbox($(this))">
                                                                Online Clinic
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-12 col-lg-12"
                                                             style="text-align:right">
                                                            <button style="margin-right:10px" type="button"
                                                                    class="btn btn-danger" data-repeater-delete><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>

                                                    </div>

                                                    @php
                                                        $idCount = $idCount+1;
                                                    @endphp

                                                @endfor

                                            </div>
                                            <div class="form-group overflow-hidden mt-2">
                                                <div class="col-12" style="text-align:end">
                                                    <button style="margin-right:12px" data-repeater-create
                                                            class="btn btn-primary" type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(empty($old_clinics))
                                    <div class="row" style="width:100%">
                                        <input type="hidden" id="lastValueDays"
                                               value="{{count($practitioner->clinics)}}">
                                        <input type="hidden" id="lastValueToTime"
                                               value="{{count($practitioner->clinics)}}">
                                        <input type="hidden" id="lastValueFromTime"
                                               value="{{count($practitioner->clinics)}}">
                                        <input type="hidden" id="lastValueFromOnlineClinic"
                                               value="{{count($practitioner->clinics)}}">
                                        <div class="repeater-default" style="width:100%">
                                            <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                            padding-right: 10px;">

                                                @foreach ($practitioner->clinics as $item)
                                                    <div data-repeater-item class="row">

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinics <span style="color:red">*</span></label>
                                                                <select name="clinic" id="clinic"
                                                                        class="form-control online-select-clinic{{$idCount}} {{ $errors->has('specialties') ? ' is-invalid' : '' }}"
                                                                        title="Select Clinic" required>
                                                                    <option value="" selected disabled>Select Clinic
                                                                    </option>
                                                                    @foreach($clinics as $clinic)
                                                                        <option
                                                                            value="{{ $clinic->id }}" {{ ($item->clinic_id == $clinic->id) ? 'selected' : '' }}>{{ $clinic->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>


                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinic Days <span
                                                                        style="color:red">*</span></label>
                                                                <select name="days" id="days_{{$idCount}}"
                                                                        multiple="multiple"
                                                                        class="selectpicker day form-control {{ $errors->has('days') ? ' is-invalid' : '' }}"
                                                                        title="Select days" required>

                                                                    <option value="monday"
                                                                            @foreach($item->days as $day)
                                                                            @if($day->day == "monday") selected @endif
                                                                        @endforeach>
                                                                        Monday
                                                                    </option>
                                                                    <option value="tuesday"
                                                                            @foreach($item->days as $day)
                                                                            @if($day->day == "tuesday") selected @endif
                                                                        @endforeach>
                                                                        Tuesday
                                                                    </option>
                                                                    <option value="wednesday"
                                                                            @foreach($item->days as $day)
                                                                            @if($day->day == "wednesday") selected @endif
                                                                        @endforeach>
                                                                        Wednesday
                                                                    </option>
                                                                    <option value="thursday"
                                                                            @foreach($item->days as $day)
                                                                            @if($day->day == "thursday") selected @endif
                                                                        @endforeach>
                                                                        Thursday
                                                                    </option>
                                                                    <option value="friday"
                                                                            @foreach($item->days as $day)
                                                                            @if($day->day == "friday") selected @endif
                                                                        @endforeach>
                                                                        Friday
                                                                    </option>
                                                                    <option value="saturday"
                                                                            @foreach($item->days as $day)
                                                                            @if($day->day == "saturday") selected @endif
                                                                        @endforeach>
                                                                        Saturday
                                                                    </option>
                                                                    <option value="sunday"
                                                                            @foreach($item->days as $day)
                                                                            @if($day->day == "sunday") selected @endif
                                                                        @endforeach>
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
                                                                    <div class="input-group date from_time"
                                                                         id="from_time_{{$idCount}}"
                                                                         data-target-input="nearest">
                                                                        <input type="text" name="from_time"
                                                                               class="form-control datetimepicker-input"
                                                                               data-target="#from_time_{{$idCount}}"
                                                                               value="{{ $item->from_time }}" required/>
                                                                        <div class="input-group-append"
                                                                             data-target="#from_time_{{$idCount}}"
                                                                             data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i
                                                                                    class="far fa-clock"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <label>Closing Time <span style="color:red">*</span></label>
                                                                    <div class="input-group date to_time"
                                                                         id="to_time_{{$idCount}}"
                                                                         data-target-input="nearest">
                                                                        <input type="text" name="to_time"
                                                                               class="form-control datetimepicker-input"
                                                                               data-target="#to_time_{{$idCount}}"
                                                                               value="{{ $item->to_time }}" required/>
                                                                        <div class="input-group-append"
                                                                             data-target="#to_time_{{$idCount}}"
                                                                             data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i
                                                                                    class="far fa-clock"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label class="online-physical-fee-span{{$idCount}}">Fee
                                                                    (PKR)
                                                                    (Physical) @if(isset($item->clinic_id) && ($item->clinic_id == 1)) @else
                                                                        <span style="color:red">*</span> @endif </label>
                                                                <input type="number" min="0" name="physical_fee"
                                                                       class="form-control online-physical-fee{{$idCount}}"
                                                                       value="{{ $item->physical_fee }}"
                                                                       @if(isset($item->clinic_id) && ($item->clinic_id == 1)) @else required @endif/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Fee (PKR) (Online) <span
                                                                        style="color:red">*</span></label>
                                                                <input type="number" min="0" name="online_fee"
                                                                       class="form-control "
                                                                       value="{{ $item->online_fee }}" required/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <input type="checkbox" name="online_clinic"
                                                                       class="online_clinic{{$idCount}}" value="1"
                                                                       @if(isset($item->clinic_id) && ($item->clinic_id == 1)) checked
                                                                       @endif onclick="onlineClinicCheckbox($(this))">
                                                                Online Clinic
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-12 col-lg-12"
                                                             style="text-align:right">
                                                            <button style="margin-right:10px" type="button"
                                                                    class="btn btn-danger" data-repeater-delete><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>

                                                    </div>
                                                    @php
                                                        $idCount = $idCount+1;
                                                    @endphp
                                                @endforeach

                                            </div>

                                            <div class="form-group overflow-hidden mt-2">
                                                <div class="col-12" style="text-align:end">
                                                    <button style="margin-right:12px" data-repeater-create
                                                            class="btn btn-primary" type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <br/>
                                <div class="col-md-12" style="width:100%">
                                    <label> Change Password? </label>
                                    <input type="checkbox" id="change_password" onclick="practitionerChangePassword()">
                                </div>

                                <br/>
                                <div class="row" id="password_box" style="width:100%;display:none;">
                                    <div class="form-group col-lg-6">
                                        <label>Password <span class="required-star"></span></label>
                                        <input type="password" name="password" id="password"
                                               class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="Enter Password" value="{{ old('password') }}">
                                        <span toggle="#password"
                                              class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
                                               placeholder="Enter Confirm Password"
                                               value="{{ old('confirm_password') }}">
                                        <span toggle="#confirm_password"
                                              class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        @if ($errors->has('confirm_password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}"/>
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
    <script src="{{asset('public/admin/js/practitioner.js')}}"></script>
@endsection




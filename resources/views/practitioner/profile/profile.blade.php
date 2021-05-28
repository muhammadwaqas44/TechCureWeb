@extends('layouts.practitioner')

@section('extra-css')
     <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>

    <style>
        .required-star {
            color: red;
        }

        .full-width-select .select2-container, .full-width-select .selection {
            width: 100% !important;
        }

        .select2-container {
            width: 100% !important;
        }
        .selection{
            width: 100% !important;
        }

    </style>
@endsection

@section('main-content')
    <div class="m-3">
        <div class="content-wrapper">
            {{-- Header/BreadCrumbs --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Edit Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
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
                                <h3 class="card-title">Edit Profile</h3>
                            </div>

                            <div class="card-body">
                                <form role="form" class="row" action="{{ route('practitionerUpdateProfile') }}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    <div class="row" style="width:100%">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Name <span class="required-star">*</span></label>
                                                <input type="text" name="name" id="name"
                                                       class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Name"
                                                       value="{{Auth::guard('practitioner')->user()->name}}" required>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Email <span class="required-star">*</span></label>
                                                <input type="text" name="email" id="email" disabled
                                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Email"
                                                       value="{{ Auth::guard('practitioner')->user()->email }}"
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
                                                       value="{{ Auth::guard('practitioner')->user()->phone }}"
                                                       required>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 full-width-select">
                                            <div class="form-group">
                                                <label>Specialties </label>
                                                <div class="cleafix"></div>
                                                <select name="specialties[]" id="specialties" multiple
                                                        data-live-search="true"
                                                        class="selectpicker form-control  {{ $errors->has('specialties') ? ' is-invalid' : '' }} ">
                                                    @foreach($specialties as $specialty)
                                                        <option value="{{$specialty->id}}"
                                                                @foreach(Auth::guard('practitioner')->user()->specialties as $practitionerSpecialty)
                                                                @if($specialty->id == $practitionerSpecialty->id) selected @endif
                                                            @endforeach
                                                        >
                                                            {{ $specialty->title }}
                                                        </option>
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
                                                    placeholder="Enter License No." value="{{ Auth::guard('practitioner')->user()->license_no }}" required>
                                                @if ($errors->has('license_no'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('license_no') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Agora App Id <span style="color:red">*</span></label>
                                                <input type="text" name="agora_app_id" id="agora_app_id"
                                                       class="form-control {{ $errors->has('agora_app_id') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Agora App Id ." value="{{ Auth::guard('practitioner')->user()->agora_app_id }}" required>
                                                @if ($errors->has('agora_app_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('agora_app_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Agora App Certificate <span style="color:red">*</span></label>
                                                <input type="text" name="agora_app_certificate" id="agora_app_certificate"
                                                       class="form-control {{ $errors->has('agora_app_certificate') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Agora App Certificate ." value="{{ Auth::guard('practitioner')->user()->agora_app_certificate }}" required>
                                                @if ($errors->has('agora_app_certificate'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('agora_app_certificate') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Agora App Channel <span style="color:red">*</span></label>
                                                <input type="text" name="agora_app_channel" id="agora_app_channel"
                                                       class="form-control {{ $errors->has('agora_app_channel') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Agora App Channel ." value="{{ Auth::guard('practitioner')->user()->agora_app_channel }}" required>
                                                @if ($errors->has('agora_app_channel'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('agora_app_channel') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">License Image</label>
                                                <input accept="image/*" type="file" id="license_image" class="form-control dropify" name="license_image" @if (Auth::guard('practitioner')->user()->license_image)
                                                data-default-file="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->license_image)}}" @endif>
                                            </div>
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
                                                            value="{{ $qualification->id }}" {{ (Auth::guard('practitioner')->user()->qualification_id == $qualification->id) ? 'selected' : '' }}>{{ $qualification->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('qualification_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qualification_id') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                        </div>


                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Address</label>
                                                <textarea rows="3" name="address"
                                                          class=" {{ $errors->has('address') ? ' is-invalid' : '' }} "
                                                          style="width:100% !important">{{ Auth::guard('practitioner')->user()->address }}</textarea>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Description</label>
                                                <textarea rows="5" name="description"
                                                          class=" {{ $errors->has('description') ? ' is-invalid' : '' }} "
                                                          style="width:100% !important">{{ Auth::guard('practitioner')->user()->description }}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Profile Image</label>
                                                <input accept="image/*" type="file" id="image"
                                                       class="form-control  {{ $errors->has('image') ? ' is-invalid' : '' }} dropify"
                                                       name="image" @if (Auth::guard('practitioner')->user()->image)
                                                       data-default-file="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->image)}}" @endif>
                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 mt-2">
                                            <div class="form-group">
                                                <label for="">Upload Prescription Pad Header Image (Recommended Size 1348px x 130px)</label>
                                                <input accept="image/*" type="file" id="prescription_pad_header_image"
                                                        class="form-control  {{ $errors->has('prescription_pad_header_image') ? ' is-invalid' : '' }} dropify"
                                                        name="prescription_pad_header_image" @if (Auth::guard('practitioner')->user()->prescription_pad_header_image)
                                                        data-default-file="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->prescription_pad_header_image)}}" @endif>
                                                @if ($errors->has('prescription_pad_header_image'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('prescription_pad_header_image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 mt-2">
                                            <div class="form-group">
                                                <label for="">Upload Prescription Pad Footer Image (Recommended Size 1348px x 50px)</label>
                                                <input accept="image/*" type="file" id="prescription_pad_footer_image"
                                                        class="form-control  {{ $errors->has('prescription_pad_footer_image') ? ' is-invalid' : '' }} dropify"
                                                        name="prescription_pad_footer_image" @if (Auth::guard('practitioner')->user()->prescription_pad_footer_image)
                                                        data-default-file="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->prescription_pad_footer_image)}}" @endif>
                                                @if ($errors->has('prescription_pad_footer_image'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('prescription_pad_footer_image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 mt-2">
                                            <div class="form-group">
                                                <label for="">Upload Prescription Pad Sidebar Image (Recommended Size 200px x 1278px)</label>
                                                <input accept="image/*" type="file" id="prescription_pad_sidebar_image"
                                                        class="form-control  {{ $errors->has('prescription_pad_sidebar_image') ? ' is-invalid' : '' }} dropify"
                                                        name="prescription_pad_sidebar_image" @if (Auth::guard('practitioner')->user()->prescription_pad_sidebar_image)
                                                        data-default-file="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->prescription_pad_sidebar_image)}}" @endif>
                                                @if ($errors->has('prescription_pad_sidebar_image'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('prescription_pad_sidebar_image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 mt-2">
                                            <div class="form-group">
                                                <label for="">Upload Prescription Pad Other Image (Recommended Size 172px x 72px)</label>
                                                <input accept="image/*" type="file" id="prescription_pad_other_image"
                                                        class="form-control  {{ $errors->has('prescription_pad_other_image') ? ' is-invalid' : '' }} dropify"
                                                        name="prescription_pad_other_image" @if (Auth::guard('practitioner')->user()->prescription_pad_other_image)
                                                        data-default-file="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->prescription_pad_other_image)}}" @endif>
                                                @if ($errors->has('prescription_pad_other_image'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('prescription_pad_other_image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    {{-- <div class="row" style="width:100%">
                                        <div class="repeater-default" style="width:100%">
                                            <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                            padding-right: 10px;">

                                                <div data-repeater-item class="row">
                                                    <div class="col-sm-12 col-md-4 col-lg-4 full-width-select">
                                                        <div class="form-group">
                                                            <label>Days <span style="color:red">*</span></label>
                                                            <div class="cleafix"></div>
                                                            <select name="days[]" id="days" multiple="multiple"
                                                                    class="selectpicker form-control {{ $errors->has('days') ? ' is-invalid' : '' }}"
                                                                    title="Select days" required>

                                                                @foreach($days as $key=>$value)
                                                                    <option value="{{$value}}"
                                                                            @foreach(Auth::guard('practitioner')->user()->days as $day)
                                                                            @if($day->day == $value) selected @endif
                                                                        @endforeach
                                                                    >{{$value}}</option>
                                                                @endforeach
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
                                                                <label>Opening Time <span
                                                                        style="color:red">*</span></label>
                                                                <div class="input-group date from_time"
                                                                     id="from_time"
                                                                     data-target-input="nearest">
                                                                    <input type="text" name="from_time"
                                                                           class="form-control {{ $errors->has('from_time') ? ' is-invalid' : '' }} datetimepicker-input"
                                                                           data-target="#from_time"
                                                                           value="{{ Auth::guard('practitioner')->user()->from_time }}"
                                                                           required/>
                                                                    <div class="input-group-append"
                                                                         data-target="#from_time"
                                                                         data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i
                                                                                class="fa fa-clock-o"></i></div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('from_time'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('from_time') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="bootstrap-timepicker">
                                                            <div class="form-group">
                                                                <label>Closing Time <span
                                                                        style="color:red">*</span></label>
                                                                <div class="input-group date to_time" id="to_time"
                                                                     data-target-input="nearest">
                                                                    <input type="text" name="to_time"
                                                                           class="form-control {{ $errors->has('to_time') ? ' is-invalid' : '' }} datetimepicker-input"
                                                                           data-target="#to_time"
                                                                           value="{{ Auth::guard('practitioner')->user()->to_time }}"
                                                                           required/>
                                                                    <div class="input-group-append"
                                                                         data-target="#to_time"
                                                                         data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i
                                                                                class="fa fa-clock-o"></i></div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('to_time'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('to_time') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            <label>Fee (PKR) (Physical) <span
                                                                    style="color:red">*</span></label>
                                                            <input type="number" min="0" name="physical_fee"
                                                                   class="form-control {{ $errors->has('physical_fee') ? ' is-invalid' : '' }}  "
                                                                   value="{{ Auth::guard('practitioner')->user()->physical_fee }}"
                                                                   required/>
                                                            @if ($errors->has('physical_fee'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('physical_fee') }}</strong>
                                                                 </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            <label>Fee (PKR) (Online) <span
                                                                    style="color:red">*</span></label>
                                                            <input type="number" min="0" name="online_fee"
                                                                   class="form-control  {{ $errors->has('online_fee') ? ' is-invalid' : '' }} "
                                                                   value="{{ Auth::guard('practitioner')->user()->online_fee }}"
                                                                   required/>
                                                            @if ($errors->has('online_fee'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('online_fee') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div> --}}

                                @php
                                    $idCount = 0;
                                    $old_clinics = session()->get('old_practitioner_clinics');
                                    $practitioner = Auth::guard('practitioner')->user();
                                @endphp

                                @if(!empty($old_clinics))
                                <div class="row" style="width:100%">
                                    <input type="hidden" id="lastValueDays" value="{{count($old_clinics)+count($practitioner->clinics)}}">
                                    <input type="hidden" id="lastValueToTime" value="{{count($old_clinics)+count($practitioner->clinics)}}">
                                    <input type="hidden" id="lastValueFromTime" value="{{count($old_clinics)+count($practitioner->clinics)}}">
                                    <input type="hidden" id="lastValueFromOnlineClinic" value="{{count($old_clinics)+count($practitioner->clinics)}}">

                                    <div class="repeater-default" style="width:100%">
                                        <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                        padding-right: 10px;">
                                            {{-- {{dd($old_clinics)}} --}}
                                            @for ($i = 0; $i < count($old_clinics[0]); $i++)

                                                <div data-repeater-item class="row">

                                                    <div class="col-sm-12 col-md-2 col-lg-2 multiselect-options">
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
                                    <input type="hidden" id="lastValueDays" value="{{count($practitioner->clinics)}}">
                                    <input type="hidden" id="lastValueToTime" value="{{count($practitioner->clinics)}}">
                                    <input type="hidden" id="lastValueFromTime" value="{{count($practitioner->clinics)}}">
                                    <input type="hidden" id="lastValueFromOnlineClinic" value="{{count($practitioner->clinics)}}">
                                    <div class="repeater-default" style="width:100%">
                                        <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                        padding-right: 10px;">

                                            @foreach ($practitioner->clinics as $item)
                                                <div data-repeater-item class="row">
                                                    <div class="col-sm-12 col-md-2 col-lg-2 multiselect-options">
                                                        <div class="form-group">
                                                            <label>Clinics <span style="color:red">*</span></label>
                                                            <select name="clinic" id="clinic" class="form-control online-select-clinic{{$idCount}} {{ $errors->has('specialties') ? ' is-invalid' : '' }}" title="Select Clinic" required>
                                                                <option value="" selected disabled>Select Clinic</option>
                                                                @foreach($clinics as $clinic)
                                                                    <option value="{{ $clinic->id }}" {{ ($item->clinic_id == $clinic->id) ? 'selected' : '' }}>{{ $clinic->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            <label>Clinic Days <span style="color:red">*</span></label>
                                                            <select name="days" id="days_{{$idCount}}" multiple="multiple" class="selectpicker day form-control {{ $errors->has('days') ? ' is-invalid' : '' }}" title="Select days" required>

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
                                                                <div class="input-group date from_time"  id="from_time_{{$idCount}}" data-target-input="nearest">
                                                                    <input type="text" name="from_time" class="form-control datetimepicker-input" data-target="#from_time_{{$idCount}}" value="{{ $item->from_time }}" required/>
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
                                                                    <input type="text" name="to_time" class="form-control datetimepicker-input" data-target="#to_time_{{$idCount}}" value="{{ $item->to_time }}" required/>
                                                                    <div class="input-group-append" data-target="#to_time_{{$idCount}}" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            <label class="online-physical-fee-span{{$idCount}}">Fee (PKR) (Physical) @if(isset($item->clinic_id) && ($item->clinic_id == 1)) @else <span style="color:red">*</span> @endif </label>
                                                            <input type="number" min="0" name="physical_fee" class="form-control online-physical-fee{{$idCount}}" value="{{ $item->physical_fee }}" @if(isset($item->clinic_id) && ($item->clinic_id == 1)) @else required @endif/>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            <label>Fee (PKR) (Online) <span style="color:red">*</span></label>
                                                            <input type="number" min="0" name="online_fee" class="form-control " value="{{ $item->online_fee }}" required/>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" name="online_clinic" class="online_clinic{{$idCount}}" value="1" @if(isset($item->clinic_id) && ($item->clinic_id == 1)) checked @endif onclick="onlineClinicCheckbox($(this))"> Online Clinic
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:right">
                                                        <button style="margin-right:10px" type="button" class="btn btn-danger" data-repeater-delete> <i class="fa fa-trash"></i> </button>
                                                    </div>

                                                </div>
                                                @php
                                                $idCount = $idCount+1;
                                                @endphp
                                            @endforeach

                                        </div>

                                        <div class="form-group overflow-hidden mt-2">
                                            <div class="col-12" style="text-align:end">
                                                <button style="margin-right:12px" data-repeater-create class="btn btn-primary" type="button"> <i class="fa fa-plus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                    <div class="row" style="width:100%">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="practitioner_id"
                                                   value="{{Auth::guard('practitioner')->user()->id}}"/>
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
    </div>
@endsection

@section('scripts')
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="{{asset('public/practitioner/js/practitioner.js')}}"></script>
    <script>
        // $('#days').select2();
        // $('#specialties').select2();
        // $('.dropify').dropify();

        // $(':input').inputmask();
        // $('#from_time').datetimepicker({
        //     format: 'LT',
        //     pickDate: false,
        //     pickTime: true,
        //     // useSeconds: false,
        //     // format: 'hh:mm',
        //     stepping: 15 //will change increments to 15m, default is 1m
        // });
        // $('#to_time').datetimepicker({
        //     format: 'LT',
        //     pickDate: false,
        //     pickTime: true,
        //     // useSeconds: false,
        //     // format: 'hh:mm',
        //     stepping: 15 //will change increments to 15m, default is 1m
        // });
    </script>
@endsection




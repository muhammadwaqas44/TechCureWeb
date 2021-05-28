@extends('layouts.practitioner')

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
                            <h3 class="card-title">Edit Practitioner</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerUpdateData') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                    
                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Phone <span style="color:red">*</span></label>
                                            <input type="text" placeholder="Enter Phone " data-inputmask="'mask': '0999-9999999'" maxlength="12" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                                class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                value="{{ $practitioner->phone }}" required>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="form-group col-lg-6">
                                        <label>Status <span style="color:red">*</span></label>
                                        <select name="status" id="status"
                                            class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                            <option value="" selected disabled>Select Option</option>
                                            <option {{ ($practitioner->status == 1)? 'Selected':'' }} value="1">Active
                                            </option>
                                            <option {{ ($practitioner->status == 0)? 'Selected':'' }} value="0">In-Active
                                            </option>
                                        </select>
                                       
                                    </div> --}}

                                </div>
                                
                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Qualification <span style="color:red">*</span></label>
                                            <select name="qualification_id" id="qualification_id" class="form-control {{ $errors->has('qualification_id') ? ' is-invalid' : '' }}" title="Select Qualification" required>
                                                <option value="" selected disabled>Select Qualification</option>
                                                @foreach($qualifications as $qualification)
                                                    <option value="{{ $qualification->id }}" {{ ($practitioner->qualification_id == $qualification->id) ? 'selected' : '' }}>{{ $qualification->title }}</option>
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
                                            <select name="specialties[]" id="specialties" multiple data-live-search="true"
                                                class="selectpicker form-control" >
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

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Address</label>
                                            <textarea rows="5" name="address" style="width:100% !important">{{ $practitioner->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Professional Description</label>
                                            <textarea rows="5" name="description" style="width:100% !important">{{ $practitioner->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Upload Image</label>
                                            <input accept="image/*" type="file" class="form-control dropify" name="image" @if ($practitioner->image) 
                                            data-default-file="{{asset('storage/app/public/'.$practitioner->image)}}" @endif>
                                        </div>
                                    </div>

                                </div>

                                @php
                                    $idCount = 0;
                                    $old_clinics = session()->get('old_practitioner_clinics');
                                @endphp

                                @if(!empty($old_clinics))
                                    <div class="row" style="width:100%">
                                        <input type="hidden" id="lastValueDays" value="{{count($old_clinics)}}">
                                        <input type="hidden" id="lastValueToTime" value="{{count($old_clinics)}}">
                                        <input type="hidden" id="lastValueFromTime" value="{{count($old_clinics)}}">

                                        <div class="repeater-default" style="width:100%">
                                            <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                            padding-right: 10px;">
                                                {{-- {{dd($old_clinics)}} --}}
                                                @for ($i = 0; $i < count($old_clinics[0]); $i++)   

                                                    <div data-repeater-item class="row">

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinics old <span style="color:red">*</span></label>
                                                                <select name="clinic" id="clinic" class="form-control {{ $errors->has('specialties') ? ' is-invalid' : '' }}" title="Select Clinic" required>
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
                                                                <label>Fee (Physical)<span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="physical_fee" class="form-control " value="{{ $old_clinics[0][$i]['physical_fee'] }}" required/>
                                                                    
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Fee (Online)<span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="online_fee" class="form-control " value="{{ $old_clinics[0][$i]['online_fee'] }}" required/>
                                                                    
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
                                        <input type="hidden" id="lastValueFromTime" value="{{count($practitioner->clinics)}}">
                                        <input type="hidden" id="lastValueToTime" value="{{count($practitioner->clinics)}}">
                                        <div class="repeater-default" style="width:100%">
                                            <div data-repeater-list="practitioner_clinics" style="padding-left: 10px;
                                            padding-right: 10px;">
                                            
                                                @foreach ($practitioner->clinics as $item)
                                                    <div data-repeater-item class="row">

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Clinics <span style="color:red">*</span></label>
                                                                <select name="clinic" id="clinic" class="form-control {{ $errors->has('specialties') ? ' is-invalid' : '' }}" title="Select Clinic" required>
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
                                                                <label>Fee (Physical)<span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="physical_fee" class="form-control " value="{{ $item->physical_fee }}" required/>
                                                                    
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Fee (Online)<span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="online_fee" class="form-control " value="{{ $item->online_fee }}" required/>
                                                                    
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
                                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}" />
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

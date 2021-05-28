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

                                        <div class="col-sm-12 col-md-6 col-lg-6">
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
                                                <label for="">Upload Image</label>
                                                <input accept="image/*" type="file" class="form-control dropify" name="image">
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
                                                    @for ($i = 0; $i < count($old_clinics[0]); $i++)   

                                                        <div data-repeater-item class="row">

                                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label>Days <span style="color:red">*</span></label>
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
                                                                    <label>Fee (PKR) (Physical)  <span style="color:red">*</span></label>
                                                                    <input type="number" min="0" name="physical_fee" class="form-control " value="{{ $old_clinics[0][$i]['physical_fee'] }}" required/>
                                                                        
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Fee (PKR) (Online) <span style="color:red">*</span></label>
                                                                    <input type="number" min="0" name="online_fee" class="form-control " value="{{ $old_clinics[0][$i]['online_fee'] }}" required/>
                                                                        
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        @php
                                                            $idCount = $idCount+1;
                                                        @endphp

                                                    @endfor

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

                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label>Days <span style="color:red">*</span></label>
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
                                                                <label>Fee (PKR) (Physical) <span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="physical_fee" class="form-control " value="{{ old('physical_fee') }}" required/>
                                                                    
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                                            <div class="form-group">
                                                                <label>Fee (PKR) (Online) <span style="color:red">*</span></label>
                                                                <input type="number" min="0" name="online_fee" class="form-control " value="{{ old('online_fee') }}" required/>
                                                                    
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="lastValueDays" value="">
                                            <input type="hidden" id="lastValueFromTime" value="">
                                            <input type="hidden" id="lastValueToTime" value="">
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
    <script src="{{asset('public/admin/js/practitioner.js')}}"></script>
@endsection



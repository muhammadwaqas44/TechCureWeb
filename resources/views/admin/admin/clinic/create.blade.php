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
                            <h3 class="card-title">Create Clinic</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('clinicStore') }}" method="post" enctype="multipart/form-data">
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
                                                <label>UserName <span style="color:red">*</span></label>
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

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Clinic Timing <span style="color:red">*</span></label>
                                                <select name="all_day" id="all_day"
                                                    class="form-control {{ $errors->has('all_day') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Select Timing</option>
                                                    <option value="1" {{ (old('all_day') == '1') ? 'selected' : '' }}>24/7</option>
                                                    <option value="0" {{ (old('all_day') == '0') ? 'selected' : '' }}>Selective</option>
                                                </select>
                                                @if ($errors->has('all_day'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('all_day') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    @php
                                        $old = old('all_day');
                                    @endphp

                                    <div id="timing_div" @if($old != "") @if($old== '0') style="width:100%;display:block !important" @else style="width:100%;display:none !important" @endif @else style="width:100%;display:none !important"  @endif>
                                        <div class="row" style="width:100%">

                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group ">
                                                    <label>From Day <span style="color:red">*</span></label>
                                                    <select name="from_day" id="from_day"
                                                        class="form-control {{ $errors->has('from_day') ? ' is-invalid' : '' }}" >
                                                        <option value="" selected disabled>From Day</option>
                                                        <option value="monday" {{ (old('from_day') == 'monday') ? 'selected' : '' }}>Monday</option>
                                                        <option value="tuesday" {{ (old('from_day') == 'tuesday') ? 'selected' : '' }}>Tuesday</option>
                                                        <option value="wednesday" {{ (old('from_day') == 'wednesday') ? 'selected' : '' }}>Wednesday</option>
                                                        <option value="thursday" {{ (old('from_day') == 'thursday') ? 'selected' : '' }}>Thursday</option>
                                                        <option value="friday" {{ (old('from_day') == 'friday') ? 'selected' : '' }}>Friday</option>
                                                        <option value="saturday" {{ (old('from_day') == 'saturday') ? 'selected' : '' }}>Saturday</option>
                                                        <option value="sunday" {{ (old('from_day') == 'sunday') ? 'selected' : '' }}>Sunday</option>
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
                                                        class="form-control {{ $errors->has('to_day') ? ' is-invalid' : '' }}" >
                                                        <option value="" selected disabled>To Day</option>
                                                        <option value="monday" {{ (old('to_day') == 'monday') ? 'selected' : '' }}>Monday</option>
                                                        <option value="tuesday" {{ (old('to_day') == 'tuesday') ? 'selected' : '' }}>Tuesday</option>
                                                        <option value="wednesday" {{ (old('to_day') == 'wednesday') ? 'selected' : '' }}>Wednesday</option>
                                                        <option value="thursday" {{ (old('to_day') == 'thursday') ? 'selected' : '' }}>Thursday</option>
                                                        <option value="friday" {{ (old('to_day') == 'friday') ? 'selected' : '' }}>Friday</option>
                                                        <option value="saturday" {{ (old('to_day') == 'saturday') ? 'selected' : '' }}>Saturday</option>
                                                        <option value="sunday" {{ (old('to_day') == 'sunday') ? 'selected' : '' }}>Sunday</option>
                                                    </select>
                                                    @if ($errors->has('to_day'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('to_day') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                        <label>Opening Time <span style="color:red">*</span></label>
                                                        <div class="input-group date"  id="opening_time" data-target-input="nearest">
                                                            <input type="text" id="opening_time_input" name="opening_time" class="form-control datetimepicker-input" data-target="#opening_time" value="{{ old('opening_time') }}" />
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
                                                            <input type="text" id="closing_time_input" name="closing_time" class="form-control datetimepicker-input" data-target="#closing_time" value="{{ old('closing_time') }}" />
                                                            <div class="input-group-append" data-target="#closing_time" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <label>Facilities </label>
                                                <div class="cleafix"></div>
                                                <select name="facilities[]" id="facilities" multiple="multiple" class="selectpicker form-control {{ $errors->has('facilities') ? ' is-invalid' : '' }}" title="Select Facilities" >
                                                    @foreach($facilities as $facility)
                                                        <option value="{{ $facility->id }}" 

                                                            @foreach(old('facilities', ['value']) as $id)
                                                                @if($facility->id == $id) selected @endif
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

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Address</label>
                                                <textarea rows="5" name="address" style="width:100% !important">{{ old('address') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Upload Logo</label>
                                                <input accept="image/*" type="file" class="form-control dropify" name="logo" >
                                            </div>
                                        </div>
            
                                    </div>


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
    <script src="{{asset('public/admin/js/clinic.js')}}"></script>
@endsection




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EON Health-Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('public/admin/dist/img/favicon-32x32.png')}}" />
    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
    <style>
        .logo-div{
          position:fixed; top:15px; left:20px;
        }
      </style>
  </head>

  <body class="hold-transition " style="background:#e9ecef;display: flex; align-items: center;justify-content: center;">
    
    <div class="mt-5" style="width:50%">

      {{-- Main Content --}}
      <section class="content">
        <div class="container-fluid">
            {{-- Row For Profile Edit --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="text-align:center;width:100%">Registration Form</h3>
                        </div>
                        <form role="form" class="row" action="{{ route('clinicRegister') }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row mt-2" style="width:100%;padding-left: 20px;padding-right: 5px;">

                              <div class="col-sm-12 col-md-12 col-lg-12">
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


                                @php
                                    $old = old('all_day');
                                @endphp
                                
                                <div id="timing_div" @if($old != "") @if($old== '0') style="width:100%;display:block !important" @else style="width:100%;display:none !important" @endif @else style="width:100%;display:none !important"  @endif>
                                    <div class=" row " style="width:100%;padding-left: 10px;">
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
                                                        <input  type="text" id="opening_time_input" name="opening_time" class="form-control datetimepicker-input {{ $errors->has('opening_time') ? ' is-invalid' : '' }}" data-target="#opening_time" value="{{ old('opening_time') }}" />
                                                        <div class="input-group-append" data-target="#opening_time" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('opening_time'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('opening_time') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Closing Time <span style="color:red">*</span></label>
                                                    <div class="input-group date" id="closing_time" data-target-input="nearest">
                                                        <input  id="closing_time_input" type="text" name="closing_time" class="form-control datetimepicker-input {{ $errors->has('closing_time') ? ' is-invalid' : '' }}" data-target="#closing_time" value="{{ old('closing_time') }}" />
                                                        <div class="input-group-append" data-target="#closing_time" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('closing_time'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('closing_time') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>



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

                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-12" style="text-align:center">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                    <br>
                                    <a href="{{route('clinicLoginForm')}}" class="text-center">I already have a membership</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
      </section>

    </div>

     {{-- Scripts --}}
     @include('layouts.scripts')
     <script src="{{asset('public/admin/js/clinic.js')}}"></script>

  </body>

</html>

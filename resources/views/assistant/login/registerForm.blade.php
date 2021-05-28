
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tekcure-Practitioner Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('public/admin/dist/img/favicon-32x32.png')}}" />
    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('public/admin/dist/css/toastr1.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/toastr2.css')}}">
  </head>

  <body class="hold-transition" style="background:#e9ecef;display: flex; align-items: center;justify-content: center;">

    <div class="mt-4" style="width:80%;">

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
                        <form role="form" class="row" action="{{ route('assistantRegister') }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row mt-2" style="width:100%;padding-left: 20px;padding-right: 5px;">

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
                                        <label>Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="Enter Email" value="{{ old('email') }}" >
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
                                <div class="col-sm-12 col-md-6 col-lg-6 full-width-select">
                                    <div class="form-group">
                                        <label>Practitioners </label>
                                        <div class="cleafix"></div>
                                        <select name="practitioners[]" id="practitioners" multiple
                                                data-live-search="true"
                                                class="selectpicker form-control  {{ $errors->has('practitioners') ? ' is-invalid' : '' }} ">
                                            @foreach($practitioners as $specialty)
                                                <option value="{{$specialty->id}}">
                                                    {{ $specialty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('practitioners'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('practitioners') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
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
                                    <a href="{{route('assistantLoginForm')}}" class="text-center">I already have a membership</a>
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
     <script src="{{asset('public/admin/js/practitioner.js')}}"></script>

  </body>

</html>

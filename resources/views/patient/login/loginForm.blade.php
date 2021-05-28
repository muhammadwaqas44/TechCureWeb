<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tekcure-Patient Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('public/admin/dist/img/favicon-32x32.png')}}"/>
    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/toastr1.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/toastr2.css')}}">
    {{-- <style>
      .logo-div{
        position:fixed; top:15px; left:20px;
      }
    </style> --}}
</head>

<body class="hold-transition login-page">
<div class="logo-div"><a href="{{route('indexPage')}}"><img style="width:140px"
                                                             src="{{ asset('storage/app/public/logo.png') }}"></a></div>
<div class="login-box">
    <div class="login-logo">
{{--        <a href="{{route('indexPage')}}">--}}
            <b>Tekcure</b>-Patient Panel
{{--        </a>--}}
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in</p>

            <form method="POST" action="{{ route('patientLogin') }}">
                @csrf

                <div class="input-group mb-3">
                    <input autocomplete="input-feild" type="text"
                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter Email Or Phone"
                           name="email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="Password" name="password" id="password-field" required>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12" style="text-align:center">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        <br>
                        <a href="{{route('patientPasswordForgotForm')}}" class="text-center">Forgot Password?</a>
                        <br>
                       <p>Create an account? <a href="{{route('patientRegisterForm')}}" class="text-center">Sign Up.</a> </p>
                    </div>
                </div>

            </form>

        </div>

    </div>
</div>

{{-- Scripts --}}
@include('layouts.scripts')
<script>
    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>

</body>
</html>

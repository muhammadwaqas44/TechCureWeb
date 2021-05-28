
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EON Health-Clinic Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('public/admin/dist/img/favicon-32x32.png')}}" />
    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/admin/dist/css/toastr1.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/toastr2.css')}}">

    {{-- <style>
      .logo-div{
        position:fixed; top:15px; left:20px;
      }
    </style> --}}
  </head>

  <body class="hold-transition login-page">
    <div class="logo-div"><a href="{{route('homeScreen')}}"><img style="width:140px" src="{{ asset('storage/app/public/logo.png') }}"></a></div>
    <div class="login-box" >
      <div class="login-logo">
        <a href="{{route('homeScreen')}}"><b>EON Health</b>-Clinic Panel</a>
      </div>
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg">Reset Password</p>

          <form id="forgetPasswordForm" method="post">
            @csrf
           
            <div class="input-group mb-3">
              <input autocomplete="input-feild" type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required>
             
            </div>
            
            </div>
            <div class="row" style="margin-bottom:20px">
              <div class="col-12" style="text-align:center">
                <button onclick="forgetPassword(event);" type="button" id="forgetButton" class="btn btn-primary ">Send Reset Password Link</button>
                <br>
                <div id="forgot">

                </div>
                <br>or
                <br>
                <a href="{{route('clinicLoginForm')}}">Login</a>
              </div>
            </div>

          </form>

        </div>
        
      </div>
    </div>

    {{-- Scripts --}}
    @include('layouts.scripts')

    <script>
        var routes = {
            clinicPasswordForgotEmail : "{{route('clinicPasswordForgotEmail')}}",
        };
    </script>

    <script src="{{asset('public/clinic/js/passwordReset.js')}}"></script>

  </body>
</html>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EON Health-Patient Reset Password</title>
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
        <a href="{{route('homeScreen')}}"><b>EON Health</b>-Patient Panel</a>
      </div>

            
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('resetPasswordPatient') }}">
                            {{ csrf_field() }}
            
                            <input type="hidden" name="token" value="{{ $token }}">
            
                            <div class="form-group{{ $errors->has('is-invalid') ? ' has-error' : '' }}">
                                <label for="email" >E-Mail Address</label>
            
                                <div class="col-md-12">
                                    <input id="email" type="email"  placeholder="Email Address" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
            
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group{{ $errors->has('is-invalid') ? ' has-error' : '' }}">
                                <label for="password" >New Password</label>
            
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="New Password" name="password" required>
            
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                                <label for="password-confirm" >Confirm New Password</label>
                                <div class="col-md-12">
                                    <input id="password-confirm"  placeholder="Confirm New Password" type="password" class="form-control" name="password_confirmation" required>
            
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group">
                                <div class="col-md-12 right-w3l">
                                    <input type="submit" class="form-control btn btn-primary" value="Reset Password">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  {{-- Scripts --}}
  @include('layouts.scripts')

  <script src="{{asset('public/patient/js/passwordReset.js')}}"></script>

</body>
</html>

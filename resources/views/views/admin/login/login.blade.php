
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EON Health - Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('public/admin/dist/img/favicon-32x32.png')}}" />

    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>

  <body class="hold-transition login-page">
    <div class="logo-div"><a href="{{route('homeScreen')}}"><img style="width:140px" src="{{ asset('storage/app/public/logo.png') }}"></a></div>
    <div class="login-box">
      <div class="login-logo">
        <a href="{{route('adminDashboard')}}"><b>EON Health</b> - Admin Panel</a>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Admin Login</p>

          <form method="POST" action="{{ route('login') }}">
            @csrf
            @error('email')
              <h3 style="color:red;text-align:center;font-size:16px">{{ $message }}</h3>
            @enderror
            @if(session()->has('success-message'))
              <h3 style="color:green;text-align:center;font-size:16px"> {{ session()->get('success-message') }}</h3>
            @endif
            <div class="input-group mb-3">
              <input autocomplete="input-feild" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
            </div>

          </form>

        </div>
        
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('public/admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/admin/dist/js/adminlte.min.js')}}"></script>

  </body>
</html>

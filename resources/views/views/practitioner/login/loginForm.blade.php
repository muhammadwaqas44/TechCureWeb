<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EON Health</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/fontastic.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/style.default.css') }}" id="theme-stylesheet">
        <link rel="stylesheet" href="{{ asset('public/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/media.css') }}">
    </head>
<body>
      <div class="container-fluid p-0 h-100">
         <div class="row h-100">
            <div class="col-sm-6 col-lg-6 p-0">
               <img src="{{ asset('public/images/banner.jpg') }}" class="h-100 w-100">
            </div>
            <div class="col-sm-6 col-lg-6 d-flex align-items-center justify-content-center">
               <div class="box-contain">
                  <h3 class="heading-title text-center mb-10">EON Health</h3>
                  <p class="text-center text-style mb-50">Welcome back! Please Login to your Account.</p>
                  <form method="POST" class="main-form" action="{{ route('practitionerLogin') }}">
                    @csrf
                     <input type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username" name="email" value="{{ old('email') }}" required>
                     @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                     <input type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                     @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                     <div class="clearfix SourceSansProRegular">
                        <label class="float-left checkbox-design">
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           <p class="m-0">Remember Me</p>
                        </label>
                        <a href="{{ route('practitionerPasswordForgotForm') }}" class="float-right blue-color">Forgot Password</a>
                        <div class="login-btn">
                           <button type="submit" value="login"> Login</button>
                           <a href="#" class="singup">Sign Up</a>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="terms"><a href="#">Term of Use. Privacy Policy</a></div>
            </div>
         </div>
      </div>

      <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('public/js/charts-home.js') }}"></script>
      <script src="{{ asset('public/js/front.js') }}"></script>
</body>
</html>
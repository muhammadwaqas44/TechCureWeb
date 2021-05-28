<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EON Health</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('public/admin/dist/img/favicon-32x32.png')}}" />

    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>

  <body class="hold-transition login-page">
      <div><a href="{{route('homeScreen')}}"><img style="width:200px" src="{{ asset('storage/app/public/logo.png') }}"></a></div>
      <br/>
    <div class="login-box" style="width:100%">

      {{-- Main Content --}}
      <section class="content">
        <div class="container-fluid">

            {{-- Row For Boxes --}}
            <div class="row" style="justify-content:center">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 style="text-align:center">Clinic</h3>
                    </div>
                    <!--<div class="icon">-->
                    <!--    <i class="ion ion-bag"></i>-->
                    <!--</div>-->
                    <a href="{{route('clinicRegisterForm')}}" class="small-box-footer">Register <i class="fas fa-arrow-circle-right"></i></a>
                    <a href="{{route('clinicLoginForm')}}" class="small-box-footer">Login <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <a href="{{route('practitionerRegisterForm')}}" style="text-decoration:none; color:#fff;"><h3 style="text-align:center">Doctor/Consultant</h3></a>
                    </div>
                    <!--<div class="icon">-->
                    <!--    <i class="ion ion-stats-bars"></i>-->
                    <!--</div>-->
                    <a href="{{route('practitionerRegisterForm')}}" class="small-box-footer">Register <i class="fas fa-arrow-circle-right"></i></a>
                    <a href="{{route('practitionerLoginForm')}}" class="small-box-footer">Login <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                    <div class="inner">
                    <h3 style="text-align:center">Patient</h3>
                    </div>
                    <!-- <div class="icon">
                        <i class="fa fa-wheelchair"></i>
                    </div> -->
                    <a href="{{route('patientRegisterForm')}}" class="small-box-footer">Register <i class="fas fa-arrow-circle-right"></i></a>
                    <a href="{{route('patientLoginForm')}}" class="small-box-footer">Login <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </div>
        </div>
    </section>
    </div>

    <!-- jQuery -->
    <script src="{{asset('public/admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/admin/dist/js/adminlte.min.js')}}"></script>

  </body>
</html>
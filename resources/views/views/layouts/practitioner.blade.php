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
        <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/owl.theme.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
     </head>
  

    <body>

        <div class="wrapper">
            <div class="page">
                <!-- Navbar-->
                <header class="header">
                        <nav class="navbar">
                        <div class="container-fluid">
                            <div class="navbar-holder d-flex align-items-center justify-content-between">
                                <div class="navbar-header slide-menu"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a></div>
                                <form class="top-serach" method="post" action="">
                                    <input type="text" class="SourceSansProRegular blue-color" name="" placeholder="Search Patients By Name, MR#, Mobile">
                                </form>
                                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                    <!-- Notifications dropdown-->
                                    <li class="nav-item dropdown">
                                    <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">1</span></a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                                                <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                                <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                                                <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                                <div class="notification-time"><small>10 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
                                    </ul>
                                    </li>
                                    <!-- Languages dropdown    -->
                                    @if(Auth::guard('practitioner')->check())
                                    <li class="nav-item dropdown">
                                    <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle before-border"><span class="mr-4 avater-name">{{ Auth::guard('practitioner')->user()->name }}</span></a>
                                    <ul aria-labelledby="languages" class="dropdown-menu">
                                        <li><a rel="nofollow" href="#" class="dropdown-item"><span>Account</span></a></li>
                                        <li><a rel="nofollow" href="{{ route('practitionerLogout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
                                        <form id="logout-form" action="{{ route('practitionerLogout') }}" method="POST" style="display: none;">
                                        @csrf
                                        </form>
                                        </li>
                                    </ul>
                                    </li>
                                    @endif
                                    <!-- Log out-->
                                </ul>
                            </div>
                        </div>
                        </nav>
                </header>

                @include('layouts.practitioner-sidebar')

                @yield('main-content')
            </div>
        </div>

        <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('public/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('public/js/front.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  
        <script type="text/javascript">
           $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L',
                });
           });
        </script>

        <script>
            $('#summernote').summernote({
                tabsize: 2,
                height: 259
            });
        </script>
        
        <script>
            $('#summernotet').summernote({
                tabsize: 2,
                height: 259
            });
        </script>

        @yield('scripts')

    </body>
</html>

<header class="header_sticky">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div id="logo_home">
                    <h1><a href="{{route('indexPage')}}" title="Findoctor"><img src="{{asset('public/frontend/img/logo.png')}}"></a></h1>
                </div>
            </div>
            <nav class="col-lg-9 col-6">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
                
                <div class="main-menu">
                    <ul>
                        <li class="submenu">
                            <a href="{{route('indexPage')}}" class="{{ (Route::currentRouteName() == 'indexPage') ? 'active-class' : '' }}">Home</a>
                        </li>
                        <li class="submenu">
                            <a href="{{route('facilitiesPage')}}" class="{{ (Route::currentRouteName() == 'facilitiesPage') ? 'active-class' : '' }}">Facilities</a>
                        </li>
                        {{-- <li class="submenu">
                            <a href="{{route('clinicsPage')}}" class="{{ (Route::currentRouteName() == 'clinicsPage' || Route::currentRouteName() == 'clinicSearch') ? 'active-class' : '' }}">Clinics</a>
                        </li> --}}
                        <li class="submenu">
                            <a href="{{route('doctorsPage')}}" class="{{ (Route::currentRouteName() == 'doctorsPage' || Route::currentRouteName() == 'doctorSearch') ? 'active-class' : '' }}">Doctors</a>
                        </li>
                        <li class="submenu">
                            <a href="{{route('homeScreen')}}" target="_blank"><button type="button" class="btn_1">Create Account</button></a>
                        </li>
                    </ul>
                </div>
                <!-- /main-menu -->
            </nav>
        </div>
    </div>
    <!-- /container -->
</header>
<!-- /Header -->
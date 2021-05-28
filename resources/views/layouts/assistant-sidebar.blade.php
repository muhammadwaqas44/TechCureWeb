<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header-->
        <div class="sidenav-header d-flex align-items-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center">
                <h2 class="h5 m-0">Tekcure</h2>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo"><a href="#" class="brand-small text-center"> <strong>Tekcure</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li>
                    <a href="{{ route('assistantDashboard') }}" class="active"> <i class="fa fa-tachometer" aria-hidden="true" style="font-size:16px;"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ route('assistantAppointmentList') }}"> <i class="fa fa-calendar" aria-hidden="true" style="font-size:16px;"></i>
                        <span>Appointments</span></a>
                </li>
                <li>
                    <a href="{{ route('assistantPractitionerList') }}"> <i class="fa fa-user-plus" aria-hidden="true" style="font-size:16px;"></i>
                        <span>Practitioners</span></a>
                </li>
                <li>
                    <a href="{{ route('assistantPatientList') }}"> <i class="fa fa-user-md" aria-hidden="true" style="font-size:18px;"></i>
                        <span>Patients</span></a>
                </li>
                <li>
                    <a href="{{ route('assistantPaymentList') }}"> <i class="fa fa-money" aria-hidden="true" style="font-size:16px;"></i> <span>Payments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('assistantPrescriptionTemplateList') }}"> <i class="fa fa-file" aria-hidden="true" style="font-size:16px;"></i> <span>Templates</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('assistantLabTestList')}}"> <i class="fa fa-flask" aria-hidden="true" style="font-size:18px;"></i> <span>Favourite Lab Tests</span></a>
                </li>
                {{-- <li>
                   <a href="#"><img src="{{ asset('public/images/calender-icon.png') }}" class="left-icon"><span>Calendar</span></a>
                </li> --}}
                {{-- <li>
                   <a href="#"> <img src="{{ asset('public/images/help-center-icon.png') }}" class="left-icon"><span> Help Center</span>                        </a>
                </li> --}}
                {{-- <li>
                   <a href="#"> <img src="{{ asset('public/images/setting-icon.png') }}" class="left-icon"><span>Settings</span></a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>

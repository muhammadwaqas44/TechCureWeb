<nav class="side-navbar">
        <div class="side-navbar-wrapper">
           <!-- Sidebar Header-->
           <div class="sidenav-header d-flex align-items-center">
              <!-- User Info-->
              <div class="sidenav-header-inner text-center">
                 <h2 class="h5 m-0">EON Health</h2>
              </div>
              <!-- Small Brand information, appears on minimized sidebar-->
              <div class="sidenav-header-logo"><a href="#" class="brand-small text-center"> <strong>EON Health</strong></a></div>
           </div>
           <!-- Sidebar Navigation Menus-->
           <div class="main-menu">
              <ul id="side-main-menu" class="side-menu list-unstyled">
                 <li>
                    <a href="{{ route('practitionerDashboard') }}" class="active"><img src="{{ asset('public/images/dashboard-icon.png') }}" class="left-icon"><span>Dashboard</span></a>
                 </li>
                 <li>
                    <a href="{{ route('practitionerPatientVisit') }}"> <img src="{{ asset('public/images/pateint-icon.png') }}" class="left-icon">
                    <span>Patients</span></a>
                 </li>
                 <li>
                    <a href="#"> <img src="{{ asset('public/images/templates-icon.png') }}" class="left-icon"><span>Templates</span>
                    </a>
                 </li>
                 <li>
                    <a href="#"><img src="{{ asset('public/images/calender-icon.png') }}" class="left-icon"><span>Calendar</span></a>
                 </li>
                 <li>
                    <a href="#"> <img src="{{ asset('public/images/help-center-icon.png') }}" class="left-icon"><span> Help Center</span>                        </a>
                 </li>
                 <li>
                    <a href="#"> <img src="{{ asset('public/images/setting-icon.png') }}" class="left-icon"><span>Settings</span></a>
                 </li>
              </ul>
           </div>
        </div>
</nav>

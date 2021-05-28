
<!DOCTYPE html>
<html>

    {{-- Head --}}
    @include('layouts.head')

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">

        <div class="wrapper">

            <div id="overlay" style="display:none">
                <img src="{{asset('public/admin/plugins/loader.gif')}}" alt="Loading" /><br/>
                Loading...
            </div>

            {{-- Navbar/Header --}}
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Welcome, <span class="user-name text-bold-700">{{ Auth::guard('clinic')->user()->name }}</span></span><span class="avatar avatar-online"><img  src="{{ asset('public/admin/dist/img/avatar.png') }}" alt="avatar" style="width:20px;"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('clinicEditProfile') }}"><i class="ft-user"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('clinicLogout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ft-power"></i> Logout</a>
                            <form id="logout-form" action="{{ route('clinicLogout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            {{-- Sidebar --}}
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{route('clinicDashboard')}}" class="brand-link" style="text-align:center">
                    EON Health
                </a>

                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('clinicDashboard')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'clinicDashboard' || Route::currentRouteName() == 'clinicEditProfile') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">Panel</li>

                            <li class="nav-item">
                                <a href="{{route('clinicPractitionerList')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'clinicPractitionerList' || Route::currentRouteName() == 'practitionerProfile') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-user-md"></i>
                                    <p>
                                        Practitioners
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('clinicEditData')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'clinicEditData' ) ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Update Data
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </aside>

            @yield('main-content')

            {{-- Footer --}}
            <footer class="main-footer">
                <strong>Copyright &copy; 2020 EONHealth.com</strong>
                All rights reserved.
            </footer>

        </div>

        {{-- Scripts --}}
        @include('layouts.scripts')

        <script>
            var routes = {
               

            };
        </script>

        @yield('scripts')

    </body>

</html>

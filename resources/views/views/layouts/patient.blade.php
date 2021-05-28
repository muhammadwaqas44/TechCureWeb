
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

                <audio id="playNotification">
                    <source src="{{ asset('storage/app/public/notification_tone.mp3') }}" type="audio/ogg">
                    <source src="{{ asset('storage/app/public/notification_tone.mp3') }}" type="audio/mpeg">
                </audio>

                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown dropdown-notifications">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge notif-count" data-count="{{count($notifications)}}">{{count($notifications)}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-container">
                            <span class="dropdown-item dropdown-header notif-count-1">{{count($notifications)}} Notifications</span>
                            <div class="dropdown-divider"></div>

                            <div class="dropdown-menu-data" style="overflow-y: auto;overflow-x: hidden;max-height: 277px;">

                                @foreach ($notifications as $item)
                                    <a href="{{route('patientNotificationDetail', $item->id)}}" class="dropdown-item" style="height:54px">
                                        <i class="fas fa-envelope mr-2"></i> {{$item->title}} <br>
                                        <span class="float-right text-muted text-sm">{{\Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Karachi')->format('l d M Y h:i a')}}</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                            
                            </div>
                        
                        {{-- <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                        </div>
                    </li>

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Hello, <span class="user-name text-bold-700">{{ Auth::guard('patient')->user()->name }}</span></span><span class="avatar avatar-online"><img  src="{{ asset('public/admin/dist/img/avatar.png') }}" alt="avatar" style="width:20px;"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('patientEditProfile') }}"><i class="ft-user"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('patientLogout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ft-power"></i> Logout</a>
                            <form id="logout-form" action="{{ route('patientLogout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            {{-- Sidebar --}}
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{route('patientDashboard')}}" class="brand-link" style="text-align:center">
                    EON Health
                </a>

                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('patientDashboard')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'patientDashboard' || Route::currentRouteName() == 'patientEditProfile' || Route::currentRouteName() == 'patientNotificationDetail') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">Panel</li>

                            <li class="nav-item">
                                <a href="{{route('patientPractitionerList')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'patientPractitionerList' || Route::currentRouteName() == 'patientPractitionerProfile' || Route::currentRouteName() == 'patientPractitionerListSearch') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-user-md"></i>
                                    <p>
                                        Practitioners
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('patientEditData')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'patientEditData' ) ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Update Data/Reports
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('patientPrescriptionList')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'patientPrescriptionList' || Route::currentRouteName() == 'patientPrescriptionDetail') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                    <p>
                                        Prescriptions
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('patientPaymentList')}}" class="nav-link 
                                {{ (Route::currentRouteName() == 'patientPaymentList') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>
                                        Payments
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview 
                                {{ (Route::currentRouteName() == 'patientAppointmentCreate' || Route::currentRouteName() == 'patientAppointmentList' || Route::currentRouteName() == 'patientAppointmentEdit' || Route::currentRouteName() == 'patientTodayAppointment' || Route::currentRouteName() == 'patientTodayOpenAppointment' || Route::currentRouteName() == 'patientTodayClosedAppointment' || Route::currentRouteName() == 'patientAppointmentStore' ) ? 'menu-open' : '' }}
                                ">
                                <a href="#" class="nav-link
                                {{ (Route::currentRouteName() == 'patientAppointmentCreate' || Route::currentRouteName() == 'patientAppointmentList' || Route::currentRouteName() == 'patientAppointmentEdit' || Route::currentRouteName() == 'patientTodayAppointment' || Route::currentRouteName() == 'patientTodayOpenAppointment' || Route::currentRouteName() == 'patientTodayClosedAppointment' || Route::currentRouteName() == 'patientAppointmentStore') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-user-clock"></i>
                                    <p>
                                        Manage Appointments
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('patientAppointmentCreate')}}" class="nav-link
                                        {{ (Route::currentRouteName() == 'patientAppointmentCreate' || Route::currentRouteName() == 'patientAppointmentStore') ? 'active' : '' }}
                                        ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('patientAppointmentList')}}" class="nav-link
                                        {{ (Route::currentRouteName() == 'patientAppointmentList' || Route::currentRouteName() == 'patientAppointmentEdit' || Route::currentRouteName() == 'patientTodayAppointment' || Route::currentRouteName() == 'patientTodayOpenAppointment' || Route::currentRouteName() == 'patientTodayClosedAppointment') ? 'active' : '' }}
                                        ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Appointment List</p>
                                        </a>
                                    </li>
                                </ul>
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
                byPatientReportDelete : "{{route('byPatientReportDelete')}}",
                patientGetClinics : "{{route('patientGetClinics')}}",
                patientGetTimeSlots : "{{route('patientGetTimeSlots')}}",
                patientPasswordForgotEmail : "{{route('patientPasswordForgotEmail')}}",

                
            };
        </script>

        @php
            $userId = Auth::guard('patient')->user()->id;
        @endphp

        <script type="text/javascript">
            var userId = "{{$userId}}";

            var notificationsWrapper = $('.dropdown-notifications');
            var dropdownContainer = $('.dropdown-container');
            var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
            var notificationsCountElem = notificationsToggle.find('span[data-count]');
            var notificationsCount = parseInt(notificationsCountElem.data('count'));
            var notifications = notificationsWrapper.find('div.dropdown-menu-data');

            // if (notificationsCount <= 0) {
            //     notificationsWrapper.hide();
            // }

            var pusher = new Pusher('9fea1ea642bbe71c89da', {
                encrypted: true,
            });

            var channel = pusher.subscribe('eon_health_notification');

            channel.bind('App\\Events\\Notify', function (data) {
                var existingNotifications = notifications.html();

                var url = '{{ route("patientNotificationDetail", ":id") }}';
                url = url.replace(':id', data.id);

                var newNotificationHtml = `
                <a href="`+url+`" class="dropdown-item" style="height:54px">
                    <i class="fas fa-envelope mr-2"></i> ` + data.title + ` <br>
                    <span class="float-right text-muted text-sm">` + data.time + `</span>
                </a>
                <div class="dropdown-divider"></div>
            
                `;

                if(data.userType==1){
                    if(userId == data.userId ){
                        notifications.html(newNotificationHtml + existingNotifications);

                        notificationsCount += 1;
                        notificationsCountElem.attr('data-count', notificationsCount);
                        notificationsWrapper.find('.notif-count').text(notificationsCount);
                        notificationsWrapper.find('.notif-count-1').text(notificationsCount+" Notifications");
                        // notificationsWrapper.show();

                        var playNotification = document.getElementById("playNotification");

                        playNotification.play();
                    }
                }
                

            });

        </script>

        @yield('scripts')

    </body>

</html>

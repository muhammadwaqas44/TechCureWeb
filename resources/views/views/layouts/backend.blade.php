
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
                                    <a href="{{route('notificationDetail', $item->id)}}" class="dropdown-item" style="height:54px">
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

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Welcome, <span class="user-name text-bold-700">{{ Auth::user()->name }}</span></span><span class="avatar avatar-online"><img  src="{{ asset('public/admin/dist/img/avatar.png') }}" alt="avatar" style="width:20px;"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('adminEditProfile') }}"><i class="ft-user"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('adminLogout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ft-power"></i> Logout</a>
                            <form id="logout-form" action="{{ route('adminLogout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            {{-- Sidebar --}}
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{route('adminDashboard')}}" class="brand-link" style="text-align:center">
                    EON Health
                </a>

                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('adminDashboard')}}" class="nav-link   
                                {{ (Route::currentRouteName() == 'adminDashboard' || Route::currentRouteName() == 'adminEditProfile' || Route::currentRouteName() == 'notificationDetail') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">Panel</li>

                            @if(Auth::user()->hasPermission('manage-users'))
                            <li class="nav-item has-treeview 
                                {{ (Route::currentRouteName() == 'userCreate' || Route::currentRouteName() == 'userList' || Route::currentRouteName() == 'userEdit') ? 'menu-open' : '' }}
                                ">
                                <a href="#" class="nav-link
                                {{ (Route::currentRouteName() == 'userCreate' || Route::currentRouteName() == 'userList' || Route::currentRouteName() == 'userEdit') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Manage Admin Users
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('userCreate')}}" class="nav-link
                                        {{ (Route::currentRouteName() == 'userCreate') ? 'active' : '' }}
                                        ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('userList')}}" class="nav-link
                                        {{ (Route::currentRouteName() == 'userList' || Route::currentRouteName() == 'userEdit') ? 'active' : '' }}
                                        ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                            @if(Auth::user()->hasPermission('manage-clinics'))
                                <li class="nav-item has-treeview 
                                    {{ (Route::currentRouteName() == 'clinicCreate' || Route::currentRouteName() == 'clinicList' || Route::currentRouteName() == 'clinicEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'clinicCreate' || Route::currentRouteName() == 'clinicList' || Route::currentRouteName() == 'clinicEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-clinic-medical"></i>
                                        <p>
                                            Manage Clinics
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('clinicCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'clinicCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('clinicList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'clinicList' || Route::currentRouteName() == 'clinicEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Clinic List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-practitioners'))
                                <li class="nav-item has-treeview 
                                    {{ (Route::currentRouteName() == 'practitionerCreate' || Route::currentRouteName() == 'practitionerList' || Route::currentRouteName() == 'practitionerEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'practitionerCreate' || Route::currentRouteName() == 'practitionerList' || Route::currentRouteName() == 'practitionerEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-user-md"></i>
                                        <p>
                                            Manage Practitioners
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('practitionerCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'practitionerCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('practitionerList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'practitionerList' || Route::currentRouteName() == 'practitionerEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Practitioner List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-patients'))
                                <li class="nav-item has-treeview 
                                    {{ (Route::currentRouteName() == 'patientCreate' || Route::currentRouteName() == 'patientList' || Route::currentRouteName() == 'patientEdit' || Route::currentRouteName() == 'prescriptionList' || Route::currentRouteName() == 'prescriptionCreate' || Route::currentRouteName() == 'prescriptionEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'patientCreate' || Route::currentRouteName() == 'patientList' || Route::currentRouteName() == 'patientEdit' || Route::currentRouteName() == 'prescriptionList' || Route::currentRouteName() == 'prescriptionCreate' || Route::currentRouteName() == 'prescriptionEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-wheelchair"></i>
                                        <p>
                                            Manage Patients
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('patientCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'patientCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('patientList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'patientList' || Route::currentRouteName() == 'patientEdit' || Route::currentRouteName() == 'prescriptionList' || Route::currentRouteName() == 'prescriptionCreate' || Route::currentRouteName() == 'prescriptionEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Patient List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-appointments'))
                                <li class="nav-item has-treeview 
                                    {{ (Route::currentRouteName() == 'appointmentCreate' || Route::currentRouteName() == 'appointmentList' || Route::currentRouteName() == 'appointmentEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'appointmentCreate' || Route::currentRouteName() == 'appointmentList' || Route::currentRouteName() == 'appointmentEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-user-clock"></i>
                                        <p>
                                            Manage Appointments
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('appointmentCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'appointmentCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('appointmentList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'appointmentList' || Route::currentRouteName() == 'appointmentEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Appointment List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-allergies'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'allergyCreate' || Route::currentRouteName() == 'allergyList' || Route::currentRouteName() == 'allergyEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'allergyCreate' || Route::currentRouteName() == 'allergyList' || Route::currentRouteName() == 'allergyEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-allergies"></i>
                                        <p>
                                            Manage Allergies
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('allergyCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'allergyCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('allergyList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'allergyList' || Route::currentRouteName() == 'allergyEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Allergy List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-diseases'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'diseaseCreate' || Route::currentRouteName() == 'diseaseList' || Route::currentRouteName() == 'diseaseEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'diseaseCreate' || Route::currentRouteName() == 'diseaseList' || Route::currentRouteName() == 'diseaseEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fa fa-wheelchair"></i>
                                        <p>
                                            Manage Diseases
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('diseaseCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'diseaseCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('diseaseList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'diseaseList' || Route::currentRouteName() == 'diseaseEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Disease List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-drugs'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'drugCreate' || Route::currentRouteName() == 'drugList' || Route::currentRouteName() == 'drugEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'drugCreate' || Route::currentRouteName() == 'drugList' || Route::currentRouteName() == 'drugEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fa fa-pills"></i>
                                        <p>
                                            Manage Drugs
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('drugCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'drugCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('drugList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'drugList' || Route::currentRouteName() == 'drugEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Drug List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-medications'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'medicationCreate' || Route::currentRouteName() == 'medicationList' || Route::currentRouteName() == 'medicationEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'medicationCreate' || Route::currentRouteName() == 'medicationList' || Route::currentRouteName() == 'medicationEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-briefcase-medical"></i>
                                        <p>
                                            Manage Medicines
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('medicationCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'medicationCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('medicationList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'medicationList' || Route::currentRouteName() == 'medicationEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Medicine List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-patient-types'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'patientTypeCreate' || Route::currentRouteName() == 'patientTypeList' || Route::currentRouteName() == 'patientTypeEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'patientTypeCreate' || Route::currentRouteName() == 'patientTypeList' || Route::currentRouteName() == 'patientTypeEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>
                                            Manage Patient Types
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('patientTypeCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'patientTypeCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('patientTypeList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'patientTypeList' || Route::currentRouteName() == 'patientTypeEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Patient Type List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-payments'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'paymentList') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'paymentList') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-credit-card"></i>
                                        <p>
                                            Manage Payments
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('paymentList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'paymentList') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Payment List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-physical-examinations'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'physicalExaminationCreate' || Route::currentRouteName() == 'physicalExaminationList' || Route::currentRouteName() == 'physicalExaminationEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'physicalExaminationCreate' || Route::currentRouteName() == 'physicalExaminationList' || Route::currentRouteName() == 'physicalExaminationEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-stethoscope"></i>
                                        <p>
                                            Manage Physical Exams
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('physicalExaminationCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'physicalExaminationCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('physicalExaminationList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'physicalExaminationList' || Route::currentRouteName() == 'physicalExaminationEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Physical Exam List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-facilities'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'facilityCreate' || Route::currentRouteName() == 'facilityList' || Route::currentRouteName() == 'facilityEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'facilityCreate' || Route::currentRouteName() == 'facilityList' || Route::currentRouteName() == 'facilityEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-filter"></i>
                                        <p>
                                            Manage Facility
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('facilityCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'facilityCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('facilityList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'facilityList' || Route::currentRouteName() == 'facilityEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Facility List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-qualifications'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'qualificationCreate' || Route::currentRouteName() == 'qualificationList' || Route::currentRouteName() == 'qualificationEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'qualificationCreate' || Route::currentRouteName() == 'qualificationList' || Route::currentRouteName() == 'qualificationEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-book-open"></i>
                                        <p>
                                            Manage Qualifications
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('qualificationCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'qualificationCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('qualificationList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'qualificationList' || Route::currentRouteName() == 'qualificationEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Qualification List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-specialties'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'specialtyCreate' || Route::currentRouteName() == 'specialtyList' || Route::currentRouteName() == 'specialtyEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'specialtyCreate' || Route::currentRouteName() == 'specialtyList' || Route::currentRouteName() == 'specialtyEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-clipboard-check"></i>
                                        <p>
                                            Manage Specialties
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('specialtyCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'specialtyCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('specialtyList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'specialtyList' || Route::currentRouteName() == 'specialtyEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Specialty List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-surgeries'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'surgeryCreate' || Route::currentRouteName() == 'surgeryList' || Route::currentRouteName() == 'surgeryEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'surgeryCreate' || Route::currentRouteName() == 'surgeryList' || Route::currentRouteName() == 'surgeryEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fa fa-brain"></i>
                                        <p>
                                            Manage Surgeries
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('surgeryCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'surgeryCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('surgeryList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'surgeryList' || Route::currentRouteName() == 'surgeryEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Surgery List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if(Auth::user()->hasPermission('manage-prescription-templates'))
                                <li class="nav-item has-treeview
                                    {{ (Route::currentRouteName() == 'prescriptionTemplateCreate' || Route::currentRouteName() == 'prescriptionTemplateList' || Route::currentRouteName() == 'prescriptionTemplateEdit') ? 'menu-open' : '' }}
                                    ">
                                    <a href="#" class="nav-link
                                    {{ (Route::currentRouteName() == 'prescriptionTemplateCreate' || Route::currentRouteName() == 'prescriptionTemplateList' || Route::currentRouteName() == 'prescriptionTemplateEdit') ? 'active' : '' }}
                                    ">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>
                                            Manage Templates
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('prescriptionTemplateCreate')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'prescriptionTemplateCreate') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('prescriptionTemplateList')}}" class="nav-link
                                            {{ (Route::currentRouteName() == 'prescriptionTemplateList' || Route::currentRouteName() == 'prescriptionTemplateEdit') ? 'active' : '' }}
                                            ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Prescription Template List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

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
                specialtyDelete : "{{route('specialtyDelete')}}",
                medicationDelete : "{{route('medicationDelete')}}",
                facilityDelete : "{{route('facilityDelete')}}",
                patientReportDelete : "{{route('patientReportDelete')}}",
                qualificationDelete : "{{route('qualificationDelete')}}",
                allergyDelete : "{{route('allergyDelete')}}",
                getClinics : "{{route('getClinics')}}",
                getTimeSlots : "{{route('getTimeSlots')}}",
                prescriptionGetClinics : "{{route('prescriptionGetClinics')}}",
                changeUserStatus: "{{ route('changeUserStatus') }}",
                userDelete : "{{route('userDelete')}}",
                diseaseDelete : "{{route('diseaseDelete')}}",
                surgeryDelete : "{{route('surgeryDelete')}}",
                drugDelete : "{{route('drugDelete')}}",
                physicalExaminationDelete : "{{route('physicalExaminationDelete')}}",
                prescriptionTemplateDelete : "{{route('prescriptionTemplateDelete')}}",
                changePractitionerStatus: "{{ route('changePractitionerStatus') }}",
                patientTypeDelete : "{{route('patientTypeDelete')}}",
            };
        </script>

        @php
            $userId = Auth::user()->id;
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

                var url = '{{ route("notificationDetail", ":id") }}';
                url = url.replace(':id', data.id);

                var newNotificationHtml = `
                <a href="`+url+`" class="dropdown-item" style="height:54px">
                    <i class="fas fa-envelope mr-2"></i> ` + data.title + ` <br>
                    <span class="float-right text-muted text-sm">` + data.time + `</span>
                </a>
                <div class="dropdown-divider"></div>
            
                `;

                if(data.userType==4){
                    // if(userId == data.userId ){
                        notifications.html(newNotificationHtml + existingNotifications);

                        notificationsCount += 1;
                        notificationsCountElem.attr('data-count', notificationsCount);
                        notificationsWrapper.find('.notif-count').text(notificationsCount);
                        notificationsWrapper.find('.notif-count-1').text(notificationsCount+" Notifications");
                        // notificationsWrapper.show();

                        var playNotification = document.getElementById("playNotification");

                        playNotification.play();
                    // }
                }
                

            });

        </script>

        @yield('scripts')

    </body>

</html>

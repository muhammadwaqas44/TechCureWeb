<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tekcure</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/fontastic.css') }}">
    <link rel="stylesheet"
          href="{{ asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style.default.css') }}" id="theme-stylesheet">
    {{--    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-datepicker.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/daterangepicker/daterangepicker.css')}}">

    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/toastr1.css')}}">
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/toastr2.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" crossorigin="anonymous" />--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>

    @yield('extra-css')


</head>


<body>

<div class="wrapper">
    <div class="page">
        <!-- Navbar-->
        <header class="header">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <div class="navbar-header slide-menu"><a id="toggle-btn" href="#" class="menu-btn"><i
                                    class="icon-bars"> </i></a></div>
                        <form class="top-serach" method="post" action="">
                            <input type="text" class="SourceSansProRegular blue-color" name=""
                                   placeholder="Search Patients By Name, MR#, Mobile">
                        </form>
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <!-- Notifications dropdown-->
                        {{--                            <li class="nav-item dropdown">--}}
                        {{--                                <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown"--}}
                        {{--                                   aria-haspopup="true" aria-expanded="false" class="nav-link"><i--}}
                        {{--                                        class="fa fa-bell"></i><span class="badge badge-warning">1</span></a>--}}
                        {{--                                <ul aria-labelledby="notifications" class="dropdown-menu">--}}
                        {{--                                    <li>--}}
                        {{--                                        <a rel="nofollow" href="#" class="dropdown-item">--}}
                        {{--                                            <div class="notification d-flex justify-content-between">--}}
                        {{--                                                <div class="notification-content"><i class="fa fa-envelope"></i>You have--}}
                        {{--                                                    6 new messages--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="notification-time"><small>4 minutes ago</small></div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a rel="nofollow" href="#" class="dropdown-item">--}}
                        {{--                                            <div class="notification d-flex justify-content-between">--}}
                        {{--                                                <div class="notification-content"><i class="fa fa-twitter"></i>You have--}}
                        {{--                                                    2 followers--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="notification-time"><small>4 minutes ago</small></div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a rel="nofollow" href="#" class="dropdown-item">--}}
                        {{--                                            <div class="notification d-flex justify-content-between">--}}
                        {{--                                                <div class="notification-content"><i class="fa fa-upload"></i>Server--}}
                        {{--                                                    Rebooted--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="notification-time"><small>4 minutes ago</small></div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a rel="nofollow" href="#" class="dropdown-item">--}}
                        {{--                                            <div class="notification d-flex justify-content-between">--}}
                        {{--                                                <div class="notification-content"><i class="fa fa-twitter"></i>You have--}}
                        {{--                                                    2 followers--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="notification-time"><small>10 minutes ago</small></div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center">--}}
                        {{--                                            <strong> <i class="fa fa-bell"></i>view all notifications </strong></a></li>--}}
                        {{--                                </ul>--}}
                        {{--                            </li>--}}
                        <!-- Languages dropdown    -->
                            @if(Auth::guard('assistant')->check())
                                <li class="nav-item dropdown">
                                    <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"
                                       class="nav-link language dropdown-toggle before-border"><span
                                            class="mr-4 avater-name">{{ Auth::guard('assistant')->user()->name }}</span></a>
                                    <ul aria-labelledby="languages" class="dropdown-menu">
                                        <li><a rel="nofollow" href="{{route('assistantEditProfile')}}"
                                               class="dropdown-item"><span>Profile</span></a></li>
                                        <li><a rel="nofollow" href="{{ route('assistantChangePassword') }}"
                                               class="dropdown-item"><span>Change Password</span></a></li>

                                        <li><a rel="nofollow" href="{{ route('assistantLogout') }}"
                                               class="dropdown-item"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
                                            <form id="logout-form" action="{{ route('assistantLogout') }}"
                                                  method="POST" style="display: none;">
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

        @include('layouts.assistant-sidebar')

        @yield('main-content')
    </div>
</div>

<script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script
    src="{{ asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('public/js/owl.carousel.js') }}"></script>
<script src="{{ asset('public/js/front.js') }}"></script>
<script src="{{asset('public/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{ asset('public/admin/dist/js/toastr.min.js')}}"></script>
<script src="{{ asset('public/admin/dist/js/toastr.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

<script type="text/javascript">
    // $(function () {
    //     $('#datetimepicker4').datetimepicker({
    //         format: 'L',
    //     });
    // });
</script>

<script>
    var routes = {
        assistantGetTimeSlots: "{{route('assistantGetTimeSlots')}}",
        assistantGetClinics: "{{route('assistantGetClinics')}}",
        getAssistantFee: "{{route('getAssistantFee')}}",
        assistantLabTestDelete: "{{route('assistantLabTestDelete')}}",
        assistantPrescriptionTemplateDelete: "{{route('assistantPrescriptionTemplateDelete')}}",
        physicalExamsModelPost: "{{route('physicalExamsModelPostAssistant')}}",
        patientHistoryModelPost: "{{route('patientHistoryModelPostAssistant')}}",
        rosModelPost: "{{route('rosModelPostAssistant')}}",
        pastMedicalHistoriesModelPost: "{{route('pastMedicalHistoriesModelPostAssistant')}}",
        pastSurgicalHistoriesModelPost: "{{route('pastSurgicalHistoriesModelPostAssistant')}}",
        familyMedicalHistoriesModelPost: "{{route('familyMedicalHistoriesModelPostAssistant')}}",
        smokingModelPost: "{{route('smokingModelPostAssistant')}}",
        getReactionslist: "{{route('getReactionslistAssistant')}}",
        adrModelPost: "{{route('adrModelPostAssistant')}}",
        getPresciptionTemplate: "{{route('getPresciptionTemplateAssistant')}}",
        submitVisitPresciptionTemplateNOte: "{{route('submitVisitPresciptionTemplateNOteAssistant')}}",
        updatePatientStatusOnVisit: "{{route('updatePatientStatusOnVisitAssistant')}}",
        savePatientReferalDoctor: "{{route('savePatientReferalDoctorAssistant')}}",
        saveNextVisit: "{{route('saveNextVisitAssistant')}}",
        rxMedicinesModelPost: "{{route('rxMedicinesModelPostAssistant')}}",
        getRXMedicineFieldsValues: "{{route('getRXMedicineFieldsValuesAssistant')}}",
        bpSysPatientVisit: "{{route('bpSysPatientVisitAssistant')}}",
        bpDiasPatientVisit: "{{route('bpDiasPatientVisitAssistant')}}",
        pulsePatientVisit: "{{route('pulsePatientVisitAssistant')}}",
        weightLbsPatientVisit: "{{route('weightLbsPatientVisitAssistant')}}",
        weightKgsPatientVisit: "{{route('weightKgsPatientVisitAssistant')}}",
        heightFtPatientVisit: "{{route('heightFtPatientVisitAssistant')}}",
        heightInPatientVisit: "{{route('heightInPatientVisitAssistant')}}",
        heightCmsPatientVisit: "{{route('heightCmsPatientVisitAssistant')}}",
        bpSys2PatientVisit: "{{route('bpSys2PatientVisitAssistant')}}",
        bpDias2PatientVisit: "{{route('bpDias2PatientVisitAssistant')}}",
        pulse2PatientVisit: "{{route('pulse2PatientVisitAssistant')}}",
        weightLbs2PatientVisit: "{{route('weightLbs2PatientVisitAssistant')}}",
        weightKgs2PatientVisit: "{{route('weightKgs2PatientVisitAssistant')}}",
        heightFt2PatientVisit: "{{route('heightFt2PatientVisitAssistant')}}",
        heightIn2PatientVisit: "{{route('heightIn2PatientVisitAssistant')}}",
        heightCms2PatientVisit: "{{route('heightCms2PatientVisitAssistant')}}",
        saveLabTestPatientVisit: "{{route('saveLabTestPatientVisitAssistant')}}",
        deleteLabTestPatientVisit: "{{route('deleteLabTestPatientVisitAssistant')}}",
        updatePatientLabTestModelPost: "{{route('updatePatientLabTestModelPostAssistant')}}",
        doctorNoteInternalPatientVisit: "{{route('doctorNoteInternalPatientVisitAssistant')}}",
        doctorNotePrintedPatientVisit: "{{route('doctorNotePrintedPatientVisitAssistant')}}",
        bsfPatientVisit: "{{route('bsfPatientVisitAssistant')}}",
        bsf2PatientVisit: "{{route('bsf2PatientVisitAssistant')}}",
        bsrPatientVisit: "{{route('bsrPatientVisitAssistant')}}",
        bsr2PatientVisit: "{{route('bsr2PatientVisitAssistant')}}",
        checkSugarChart: "{{route('checkSugarChartAssistant')}}",
        unCheckSugarChart: "{{route('unCheckSugarChartAssistant')}}",
        patientEditProfileModelPost: "{{route('patientEditProfileModelPostAssistant')}}",
        patientReportUploadModelPost: "{{route('patientReportUploadModelPostAssistant')}}",
        getPreviousVisitDetails: "{{route('getPreviousVisitDetailsAssistant')}}",
        savePreviousVisitDetails: "{{route('savePreviousVisitDetailsAssistant')}}",
        revisePatientVisit: "{{route('revisePatientVisitAssistant')}}",
        saveDurationVisit: "{{route('saveDurationVisitAssistant')}}",
        saveVisitPresciptionTemplate: "{{route('saveVisitPresciptionTemplateAssistant')}}"
    };
    var image ={
        edit:"{{ asset('public/images/edit-icon.png') }}",
        delete:"{{ asset('public/images/del-icon.png') }}",
    };
</script>

<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 259
    });
</script>


@yield('scripts')

</body>
</html>

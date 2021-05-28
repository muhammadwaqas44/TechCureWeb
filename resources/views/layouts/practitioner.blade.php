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
                            @if(Auth::guard('practitioner')->check())
                                <li class="nav-item dropdown">
                                    <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"
                                       class="nav-link language dropdown-toggle before-border"><span
                                            class="mr-4 avater-name">{{ Auth::guard('practitioner')->user()->name }}</span></a>
                                    <ul aria-labelledby="languages" class="dropdown-menu">
                                        <li><a rel="nofollow" href="{{route('practitionerEditProfile')}}"
                                               class="dropdown-item"><span>Profile</span></a></li>
                                        <li><a rel="nofollow" href="{{ route('practitionerChangePassword') }}"
                                               class="dropdown-item"><span>Change Password</span></a></li>

                                        <li><a rel="nofollow" href="{{ route('practitionerLogout') }}"
                                               class="dropdown-item"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
                                            <form id="logout-form" action="{{ route('practitionerLogout') }}"
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

        @include('layouts.practitioner-sidebar')

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
        practitionerGetTimeSlots: "{{route('practitionerGetTimeSlots')}}",
        practitionerLabTestDelete: "{{route('practitionerLabTestDelete')}}",
        practitionerPrescriptionTemplateDelete: "{{route('practitionerPrescriptionTemplateDelete')}}",
        physicalExamsModelPost: "{{route('physicalExamsModelPost')}}",
        patientHistoryModelPost: "{{route('patientHistoryModelPost')}}",
        rosModelPost: "{{route('rosModelPost')}}",
        pastMedicalHistoriesModelPost: "{{route('pastMedicalHistoriesModelPost')}}",
        pastSurgicalHistoriesModelPost: "{{route('pastSurgicalHistoriesModelPost')}}",
        familyMedicalHistoriesModelPost: "{{route('familyMedicalHistoriesModelPost')}}",
        smokingModelPost: "{{route('smokingModelPost')}}",
        getReactionslist: "{{route('getReactionslist')}}",
        adrModelPost: "{{route('adrModelPost')}}",
        getPresciptionTemplate: "{{route('getPresciptionTemplate')}}",
        submitVisitPresciptionTemplateNOte: "{{route('submitVisitPresciptionTemplateNOte')}}",
        updatePatientStatusOnVisit: "{{route('updatePatientStatusOnVisit')}}",
        savePatientReferalDoctor: "{{route('savePatientReferalDoctor')}}",
        saveNextVisit: "{{route('saveNextVisit')}}",
        rxMedicinesModelPost: "{{route('rxMedicinesModelPost')}}",
        getRXMedicineFieldsValues: "{{route('getRXMedicineFieldsValues')}}",
        bpSysPatientVisit: "{{route('bpSysPatientVisit')}}",
        bpDiasPatientVisit: "{{route('bpDiasPatientVisit')}}",
        pulsePatientVisit: "{{route('pulsePatientVisit')}}",
        weightLbsPatientVisit: "{{route('weightLbsPatientVisit')}}",
        weightKgsPatientVisit: "{{route('weightKgsPatientVisit')}}",
        heightFtPatientVisit: "{{route('heightFtPatientVisit')}}",
        heightInPatientVisit: "{{route('heightInPatientVisit')}}",
        heightCmsPatientVisit: "{{route('heightCmsPatientVisit')}}",
        bpSys2PatientVisit: "{{route('bpSys2PatientVisit')}}",
        bpDias2PatientVisit: "{{route('bpDias2PatientVisit')}}",
        pulse2PatientVisit: "{{route('pulse2PatientVisit')}}",
        weightLbs2PatientVisit: "{{route('weightLbs2PatientVisit')}}",
        weightKgs2PatientVisit: "{{route('weightKgs2PatientVisit')}}",
        heightFt2PatientVisit: "{{route('heightFt2PatientVisit')}}",
        heightIn2PatientVisit: "{{route('heightIn2PatientVisit')}}",
        heightCms2PatientVisit: "{{route('heightCms2PatientVisit')}}",
        saveLabTestPatientVisit: "{{route('saveLabTestPatientVisit')}}",
        deleteLabTestPatientVisit: "{{route('deleteLabTestPatientVisit')}}",
        updatePatientLabTestModelPost: "{{route('updatePatientLabTestModelPost')}}",
        doctorNoteInternalPatientVisit: "{{route('doctorNoteInternalPatientVisit')}}",
        doctorNotePrintedPatientVisit: "{{route('doctorNotePrintedPatientVisit')}}",
        bsfPatientVisit: "{{route('bsfPatientVisit')}}",
        bsf2PatientVisit: "{{route('bsf2PatientVisit')}}",
        bsrPatientVisit: "{{route('bsrPatientVisit')}}",
        bsr2PatientVisit: "{{route('bsr2PatientVisit')}}",
        checkSugarChart: "{{route('checkSugarChart')}}",
        unCheckSugarChart: "{{route('unCheckSugarChart')}}",
        patientEditProfileModelPost: "{{route('patientEditProfileModelPost')}}",
        patientReportUploadModelPost: "{{route('patientReportUploadModelPost')}}",
        getPreviousVisitDetails: "{{route('getPreviousVisitDetails')}}",
        savePreviousVisitDetails: "{{route('savePreviousVisitDetails')}}",
        revisePatientVisit: "{{route('revisePatientVisit')}}",
        saveDurationVisit: "{{route('saveDurationVisit')}}",
        practitionerPatientReportDelete: "{{route('practitionerPatientReportDelete')}}",
        getPractitionerFee: "{{route('getPractitionerFee')}}",
        saveVisitPresciptionTemplate: "{{route('saveVisitPresciptionTemplate')}}",
        removeFilePractitioner: "{{route('removeFilePractitioner')}}"
    };
    var image = {
        edit: "{{ asset('public/images/edit-icon.png') }}",
        delete: "{{ asset('public/images/del-icon.png') }}",
    };
</script>

<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 259
    });

</script>


@yield('scripts')

{{--@if(session()->has('success-message'))--}}
{{--    <script>--}}
{{--        toastr.clear();--}}
{{--        toastr.success('{{session()->get('success-message')}}')--}}
{{--    </script>--}}
{{--@endif--}}


{{--@if (session()->has('status'))--}}
{{--    <script>--}}
{{--        toastr.clear();--}}
{{--        toastr.success('{{session()->get('status')}}')--}}
{{--    </script>--}}
{{--@endif--}}

{{--@if(session()->has('error-message'))--}}
{{--    <script>--}}
{{--        toastr.clear();--}}
{{--        toastr.error('{{session()->get('error-message')}}')--}}
{{--    </script>--}}
{{--@endif--}}
</body>
</html>

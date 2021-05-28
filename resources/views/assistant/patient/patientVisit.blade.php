@extends('layouts.assistant')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('public/css/jquery.iviewer.css') }}"/>--}}
    {{--    <style>--}}
    {{--        .viewer {--}}
    {{--            width: 100%;--}}
    {{--            height: 500px;--}}
    {{--            border: 1px solid black;--}}
    {{--            position: relative;--}}
    {{--        }--}}

    {{--        .wrapper {--}}
    {{--            overflow: hidden;--}}
    {{--        }--}}
    {{--    </style>--}}
    <style>
        .error-response {
            background-color: #ff000052 !important;
            color: #000 !important;
        }

        .required-star {
            color: red;
        }

        .full-width-select .select2-container, .full-width-select .selection {
            width: 100% !important;
        }

        .select2-container {
            width: 100% !important;
        }

        .selection {
            width: 100% !important;
        }

        /* Center the loader */
        #loaderDiv {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Add animation to "page content" */
        .animate-bottom {
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }
            to {
                bottom: 0px;
                opacity: 1
            }
        }

        @keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }
            to {
                bottom: 0;
                opacity: 1
            }
        }

        #myDivPage {
            display: none;
            /*text-align: center;*/
        }


        .zoom {
            /*display:inline-block;*/
            /*position: relative;*/
        }

        /* magnifying glass icon */
        .zoom:after {
            content: '';
            display: block;
            width: 200px;
            height: 200px;
            position: absolute;
            top: 0;
            right: 0;
            /*background:url(icon.png);*/
        }

        .zoom img {
            display: block;
        }

        .zoom img::selection {
            background-color: transparent;
        }

        figure.containerZoom {
            background-position: 50% 50%;
            position: relative;
            width: 100%;
            overflow: hidden;
            cursor: zoom-in;
            margin: 0
        }

        figure.containerZoom img {
            transition: opacity .5s;
            display: block;
            width: 100%
        }

        figure.containerZoom.active img {
            opacity: 0
        }

        .openseadragon {
            width: 800px;
            height: 600px;
            border: 1px solid black;
            color: #333; /* text color for messages */
            background-color: black;
        }

        .openseadragon.front-page {
            height: 586px;
        }

        .openseadragon-small {
            width: 100px;
            height: 80px;
            border: 1px solid black;
            color: #333; /* text color for messages */
            background-color: black;
        }

        .demoheading {
            color: #437AB2;
            padding: 0 0 0.2em 1em;
        }

        .toolbar {
            width: 800px;
            height: 33px;
            border: none;
            color: #333;
            padding: 4px;
            background-color: transparent;
        }

        .toolbar.fullpage {
            width: 100%;
            border: none;
            position: fixed;
            z-index: 999999;
            left: 0;
            top: 0;
            background-color: #ccc;
        }
    </style>
@endsection

@section('main-content')
    <div>
        <div id="loaderDiv"></div>
        <div id="myDivPage">
            <div class="video-grid" id="video">
                <div class="video-view">
                    <div id="local_stream" class="video-placeholder"></div>
                    <div id="local_video_info" class="video-profile hide"></div>
                    <div id="video_autoplay_local" class="autoplay-fallback hide"></div>
                </div>
            </div>
            <section class="section-padding">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-lg-7">
                            <div class="row">
                                <div class="col-sm-8 col-lg-8">
                                    <div class="row">
                                        <div class="col-sm-5 col-lg-5 pr-0 remove-pr">
                                            <div class=" patient-pic">
                                                <img
                                                    @if($patient->image != null && Storage::exists($patient->image))  src="{{ asset('storage/app/public/'.$patient->image) }}"
                                                    @else src="{{ asset('public/images/patient-pic.png') }}" @endif >
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-lg-7 light-grey pt-2 pb-1 margin-20-mobile">
                                            <div class="patientInfoDetail">
                                                <div class="clearfix">
                                                    <h4 class="SourceSansProBold blue-color float-left">{{$patient->name}}</h4>
                                                    <a class="fa fa-pencil float-right pencil-color" href="#"
                                                       data-toggle="modal" data-target="#modalPatientEditProfile"></a>
                                                </div>
                                                <ul class="pateint-infomation">
                                                    <li><b>MR #:</b> {{$patient->mr_number}}</li>
                                                    <li><b>Gender:</b> @if($patient->gender == '1')
                                                            Male @elseif($patient->gender == '2')
                                                            Female @elseif($patient->gender == '3')Other @endif</li>
                                                    <li><b>Age:</b> {{$patient->age}}</li>
                                                    <li><b>Mob:</b> {{$patient->phone}}</li>
                                                    <li>{{$patient->address}}</li>
                                                </ul>
                                            </div>
                                            <div class="text-right two-flags">
                                                <button class="btn btn-sm mr-2 black-list-flag"
                                                        @if($patient->time_waste_flag_condition == 1) style="border: 5px solid black; background: black;"
                                                        @else style="background: black;"
                                                        @endif data-id="{{$patient->id}}" data-status="black_list"
                                                        onclick="updatePatientStatus(this)" title="Black List"><i
                                                        class="fa fa-flag"
                                                        style="color: white"
                                                        aria-hidden="true"></i></button>
                                                <button class="btn btn-sm critical-flag"
                                                        @if($patient->critical_flag_condition == 1) style="border: 5px solid darkred; background: darkred;"
                                                        @else style="background: darkred;"
                                                        @endif
                                                        data-id="{{$patient->id}}" data-status="critical_list"
                                                        onclick="updatePatientStatus(this)" title="Critical"><i
                                                        class="fa fa-flag"
                                                        style="color: white"
                                                        aria-hidden="true"></i></button>

                                                {{--                                        <img src="{{ asset('public/images/blank-box.png') }}">--}}
                                                {{--                                        <img src="{{ asset('public/images/red-flag.png') }}">--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-lg-4 mobile-m-top">
                                    <h6 class="SourceSansProBold blue-color horizental-line"><span>Selected Visit</span>
                                    </h6>
                                    <div class="selected-visit clearfix">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <h6>Visit # {{$patientVisit->visit_number}}</h6>
                                                <h6>{{$patientVisit->payment_status}}</h6>
                                                @if(isset($appointment->patientType->title))
                                                    <h6>{{$appointment->patientType->title}}</h6>
                                                @endif
                                            </div>
                                            <div class="float-right">
                                                <h6>{{\Carbon\Carbon::parse($appointment->date)->format('d M, Y')}}</h6>
                                            </div>
                                        </div>
                                        {{--                                <h1>Duration- <span onLoad="myFunction()"></span></h1>--}}
                                        <h1>Duration- <span
                                                id="time">{{($patientVisit->total_duration != null)?$patientVisit->total_duration:'00:00'}}</span>
                                        </h1>
                                    </div>
                                    @if($appointment->type == 1)
                                        <div class="start-video">
                                            <div class="row">
                                                <div class="col-md-6 p-0">
                                                    <a href="{{route('assistantJoinAppointment',[$appointment->id])}}"
                                                       target="_blank"><img style="width: 141px;
                                   margin-left: 15px;" src="{{ asset('public/images/start-video.png') }}"></a>
                                                </div>
                                                @if($appointment->appointment_complete == 0)
                                                    <div class="col-md-2 mt-2 text-center">
                                                    <div class=""
                                                        style="background-color:red; width:20px; height:20px; border-radius:50%; margin-left: 9px;"
                                                        title="Offline" id="offline{{$appointment->id}}"></div>
                                                        <div
                                                            style="background-color:green; width:20px; height:20px; border-radius:50%; display:none; margin-left: 9px;"
                                                            title="Online" id="online{{$appointment->id}}"></div>
                                                    </div>

                                                    {{--                                                <div--}}
                                                    {{--                                                    style="background-color:blue;width:20px;height:20px;border-radius:50%;display:none"--}}
                                                    {{--                                                    title="Complete" id="complete{{$appointment['id']}}"></div>--}}

                                                @endif
                                                <div class="col-md-3">
                                                    @php $link = URL::to('/joinAppointment'.'/'.$patient->id.'/'.$practitioner->id.'/'.$appointment->id); @endphp
                                                    <p class="copy-link-class hidden">{{ $link }}</p>
                                                    <button class="btn-space-link"
                                                            onclick="copyToClipboard('.copy-link-class')"><i
                                                            class="fa fa-link"
                                                            aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="sub-btns">
                                <!-- <a href="#">Allergies</a> -->
                                <!-- <a href="#">Vaccines</a> -->
                                <!-- <a href="#">R.Drugs</a> -->
                                <a href="#" data-toggle="modal" data-target="#modalPE">P.E.</a>
                                <a href="#" data-toggle="modal" data-target="#modalhistory">History</a>
                                <!--  <a href="#">Form</a>
                                <a href="#">Form</a>
                                <a href="#">Form</a> -->
                                <a href="#" data-toggle="modal" data-target="#modalPMHx">PMHx</a>
                                <a href="#" data-toggle="modal" data-target="#modalPSHx">PSHx</a>
                                <a href="#" data-toggle="modal" data-target="#modalFMHx">FMHx</a>
                                <a href="#" data-toggle="modal" data-target="#modalsmoking">Smoking</a>
                                <a href="#" data-toggle="modal" data-target="#modalros">ROS</a>
                                <a href="#" data-toggle="modal" data-target="#modaladr">ADR</a>
                                <a href="#" class="rx" data-toggle="modal" data-target="#modalrxm">CuRx</a>
                                <!-- <a href="#">C.MEDS</a> -->
                            </div>
                            <div class="clearfix vitals-row">
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Vitals</span></h6>
                                <div class="vital-sub-row clearfix">
                                    <a href="#" class="float-left rep-vital">Repeat Vitals</a>
                                    <div class="vital-sub-row2 clearfix">
                                        @if(isset($patientVitalVisitGets->weight_kgs) || isset($patientVitalVisitGets->weight_lbs))
                                            <a href="javascript:void(0);" id="vital_lbs"
                                               class="btn-space m-0 float-left"
                                               @if(isset($patientVitalVisitGets->weight_kgs)) style=""
                                               @else style="display:none;" @endif>LBs</a>
                                            <a href="javascript:void(0);" id="vital_kgs"
                                               class="btn-space m-0 float-left"
                                               @if(isset($patientVitalVisitGets->weight_lbs)) style=""
                                               @else style="display:none;" @endif>KGs</a>
                                        @else
                                            <a href="javascript:void(0);" id="vital_lbs"
                                               class="btn-space m-0 float-left"
                                               style="">LBs</a>
                                            <a href="javascript:void(0);" id="vital_kgs"
                                               class="btn-space m-0 float-left"
                                               style="display:none;">KGs</a>
                                        @endif

                                        @if(isset($patientVitalVisitGets->height_ft) || isset($patientVitalVisitGets->height_in) || isset($patientVitalVisitGets->height_cms))
                                            <a href="javascript:void(0);" id="vital_cms"
                                               class="btn-space m-0 float-right"
                                               @if(isset($patientVitalVisitGets->height_ft) || isset($patientVitalVisitGets->height_in)) style=""
                                               @else style="display:none;" @endif>CMs</a>
                                            <a href="javascript:void(0);" id="vital_ft"
                                               class="btn-space m-0 float-right"
                                               @if(isset($patientVitalVisitGets->height_cms)) style=""
                                               @else style="display:none;" @endif>Ft</a>
                                        @else
                                            <a href="javascript:void(0);" id="vital_cms"
                                               class="btn-space m-0 float-right"
                                               style="">CMs</a>
                                            <a href="javascript:void(0);" id="vital_ft"
                                               class="btn-space m-0 float-right"
                                               style="display:none;">Ft</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive vitals-table">
                                    <table class="table new-table">
                                        <thead>
                                        <tr>
                                            <th>BP (Sys- Dias)</th>
                                            <th>Pulse</th>
                                            @if(isset($patientVitalVisitGets->weight_kgs))
                                                <th id="weight_unit">Weight (Kgs)</th>
                                            @elseif(isset($patientVitalVisitGets->weight_lbs))
                                                <th id="weight_unit">Weight (Lbs)</th>
                                            @else
                                                <th id="weight_unit">Weight (Kgs)</th>
                                            @endif
                                            @if(isset($patientVitalVisitGets->height_ft) || isset($patientVitalVisitGets->height_in))
                                                <th id="height_unit">Height (Ft/In)</th>
                                            @elseif(isset($patientVitalVisitGets->height_cms))
                                                <th id="height_unit">Height (Cms)</th>
                                            @else
                                                <th id="height_unit">Height (Ft/In)</th>
                                            @endif
                                            <th>BMI</th>
                                            <th>BSF</th>
                                            <th>BSR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="bp_sys" id="bp_sys"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bp_sys) }}"
                                                       @endif class="grey-input" style="width:30px !important;">
                                                <input type="text" name="bp_dias" id="bp_dias"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bp_dias) }}"
                                                       @endif class="grey-input" style="width:30px !important;">
                                            </td>
                                            <td>
                                                <input type="text" name="pulse" id="pulse"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->pulse) }}"
                                                       @endif class="grey-input expand-width m-0 "
                                                       style="width:30px !important;">
                                            </td>
                                            <td>
                                                @if(isset($patientVitalVisitGets->weight_kgs) || isset($patientVitalVisitGets->weight_lbs))
                                                    @if(isset($patientVitalVisitGets->weight_kgs))
                                                        <input type="text" name="weight_kgs" id="weight_kgs"
                                                               pattern="^\d*(\.\d{0,1})?$"
                                                               step="1"
                                                               @if(isset($patientVitalVisitGets)) value="{{ number_format((float)$patientVitalVisitGets->weight_kgs, 1, '.', '')}}"
                                                               @endif class="grey-input m-0 expand-width number"
                                                               style="width:47px !important;">
                                                    @else
                                                        <input type="text" name="weight_kgs" id="weight_kgs" value=""
                                                               pattern="^\d*(\.\d{0,1})?$"
                                                               step="1"
                                                               class="grey-input m-0 expand-width number"
                                                               style="display:none; width:47px !important;">
                                                    @endif

                                                    @if(isset($patientVitalVisitGets->weight_lbs))
                                                        <input type="text" name="weight_lbs" id="weight_lbs"
                                                               pattern="^\d*(\.\d{0,1})?$"
                                                               step="1"
                                                               @if(isset($patientVitalVisitGets)) value="{{number_format((float)$patientVitalVisitGets->weight_lbs, 1, '.', '') }}"
                                                               @endif class="grey-input m-0 expand-width number"
                                                               @if(isset($patientVitalVisitGets->weight_lbs)) style="width:47px !important;"
                                                               @else style="display:none; width:47px !important;" @endif>
                                                    @else
                                                        <input type="text" name="weight_lbs" id="weight_lbs" value=""
                                                               pattern="^\d*(\.\d{0,1})?$"
                                                               step="1"
                                                               class="grey-input m-0 expand-width number"
                                                               style="display:none;  width:47px !important;">
                                                    @endif
                                                @else
                                                    <input type="text" name="weight_kgs" id="weight_kgs" value=""
                                                           pattern="^\d*(\.\d{0,1})?$"
                                                           step="1"
                                                           class="grey-input m-0 expand-width number"
                                                           style="width:47px !important;">
                                                    <input type="text" name="weight_lbs" id="weight_lbs" value=""
                                                           pattern="^\d*(\.\d{0,1})?$"
                                                           step="1"
                                                           class="grey-input m-0 expand-width number"
                                                           style="display:none; width:47px !important;">
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($patientVitalVisitGets->height_ft) || isset($patientVitalVisitGets->height_in) || isset($patientVitalVisitGets->height_cms))
                                                    @if(isset($patientVitalVisitGets->height_ft) || isset($patientVitalVisitGets->height_in))
                                                        <input type="text" name="height_ft" id="height_ft"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->height_ft) }}"
                                                               @endif class="grey-input">
                                                        <input type="text" name="height_in" id="height_in"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->height_in) }}"
                                                               @endif class="grey-input">
                                                    @else
                                                        <input type="text" name="height_ft" id="height_ft" value=""
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               class="grey-input" style="display:none;">
                                                        <input type="text" name="height_in" id="height_in" value=""
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               class="grey-input" style="display:none;">
                                                    @endif

                                                    @if(isset($patientVitalVisitGets->height_cms))
                                                        <input type="text" name="height_cms" id="height_cms"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->height_cms) }}"
                                                               @endif class="grey-input"
                                                               @if(isset($patientVitalVisitGets->height_cms)) style="width:47px !important;"
                                                               @else style="display:none; width:47px !important;" @endif>
                                                    @else
                                                        <input type="text" name="height_cms" id="height_cms" value=""
                                                               class="grey-input"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               style="display:none; width:47px !important;">
                                                    @endif
                                                @else
                                                    <input type="text" name="height_ft" id="height_ft" value=""
                                                           onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                           oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                           class="grey-input">
                                                    <input type="text" name="height_in" id="height_in" value=""
                                                           onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                           oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                           class="grey-input">
                                                    <input type="text" name="height_cms" id="height_cms" value=""
                                                           class="grey-input"
                                                           onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                           oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                           style="display:none; width:47px !important;">
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="bmi" id="bmi"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bmi) }}"
                                                       @endif class="grey-input m-0 expand-width" readonly
                                                       style="width:30px !important;">
                                            </td>
                                            <td>
                                                <input type="text" name="bsf" id="bsf"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bsf) }}"
                                                       @endif class="grey-input m-0 expand-width"
                                                       style="width:30px !important;">
                                            </td>
                                            <td>
                                                <input type="text" name="bsr" id="bsr"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bsr) }}"
                                                       @endif class="grey-input expand-width m-0"
                                                       style="width:30px !important;">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive vitals-table-two">
                                    {{--                            <table class="table new-table">--}}
                                    {{--                                <thead>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <th>SPO2 %</th>--}}
                                    {{--                                </tr>--}}
                                    {{--                                </thead>--}}
                                    {{--                                <tbody>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <td width="90px">--}}
                                    {{--                                        <input type="text" name="spo2" id="spo2"--}}
                                    {{--                                               @if(isset($patientVitalVisitGets)) value="{{ $patientVitalVisitGets->spo2 }}"--}}
                                    {{--                                               @endif class="grey-input expand-width m-0" readonly>--}}
                                    {{--                                    </td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                </tbody>--}}
                                    {{--                            </table>--}}
                                    <input type="hidden" name="patient_id" id="patient_id" value="{{$patient->id}}">
                                    <input type="hidden" name="practitioner_id" id="practitioner_id"
                                           value="{{$practitioner->id}}">
                                    <input type="hidden" name="patient_visit_id" id="patient_visit_id"
                                           value="{{$patientVisit->id}}">
                                </div>
                            </div>
                            <div class="clearfix pt-2 templates-row mobile-m-top">
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Templates</span></h6>
                                <form>
                                    <select name="search_template" data-live-search="true"
                                            onchange="fetchTemplateDropDwon(this)"
                                            class="selectpicker search_template form-control w-100 {{ $errors->has('search_template') ? ' is-invalid' : '' }}"
                                            title="Select Template" required>
                                        @foreach($prescriptionTemplateAll as $prescriptionTemplate)
                                            <option
                                                value="{{ $prescriptionTemplate->id }}">{{ $prescriptionTemplate->title }}</option>
                                        @endforeach
                                    </select>
                                    {{--                            <input type="text" name="" placeholder="Search Templates">--}}
                                    {{--                            <button type="submit">Labs Only</button>--}}
                                </form>
                                <div class="templates-show">
                                    @foreach($prescriptionTemplateFavourites as $prescriptionTemplateFavourite)
                                        <a type="button"
                                           onclick="fetchTemplateButton({{$prescriptionTemplateFavourite->id}})">{{$prescriptionTemplateFavourite->title}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix pt-2 templates-row mobile-m-top mt-2">
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Prescription</span></h6>
                                <textarea name="visit_template" id="visit_template" style="height: 400px;color: #000"
                                          {{--                                  onblur="submitTextarea()"--}}
                                          class="form-control textarea {{ $errors->has('visit_template') ? ' is-invalid' : '' }}"
                                          rows="20">@if(isset($patientVisitPrescription->prescription )) {!! $patientVisitPrescription->prescription !!} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-5 mobile-m-top">
                            <div class="clearfix">
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Previous Visits ({{$patientVisitPrevious->count()}})</span>
                                </h6>
                                <div class="table-responsive previous-visit">
                                    <table class="table new-table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th>Actions</th>
                                            <th>
                                                <a href="#" data-toggle="modal" on
                                                   style="position: inherit; right: 3px; transform: rotate(0deg); color: #000;"
                                                   data-target="#viewAllPreviousVisit"><i
                                                        class="fa fa-external-link fa-2x"></i></a>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($patientVisitPrevious) > 0 )
                                            @foreach($patientVisitPrevious->take(3) as $patientVisitP)
                                                <tr>
                                                    <td>{{\Carbon\Carbon::parse($patientVisitP->appointment->date)->format('d M, Y')}}</td>
                                                    <td class="yellow">@if($patientVisitP->appointment->status == 0)
                                                            <span
                                                                style="color:red;"> Pending </span>
                                                        @elseif($patientVisitP->appointment->status == 1) <span
                                                                style="color:red;"> Under
                                                Process </span> @elseif($patientVisitP->appointment->status == 2) <span
                                                                style="color:red;">
                                                    Accepted </span> @elseif($patientVisitP->appointment->status == 3)
                                                            <span style="color:red;">
                                                    Rejected </span> @elseif($patientVisitP->appointment->status == 4)
                                                            <span style="color:red;"> Check
                                                    In </span> @elseif($patientVisitP->appointment->status == 5) <span
                                                                style="color:#0AF321;">
                                                    Completed </span> @endif</td>
                                                    <td class="yellow">{{ ($patientVisitP->revise_of != null)? 'Revised - '.\Carbon\Carbon::parse($patientVisitP->revise_of)->format('d M, Y') : '' }}</td>
                                                    <td colspan="2"><a type="button"
                                                                       onclick="viewPreviousVisit({{$patientVisitP->patient_id}} ,{{$patientVisitP->practitioner_id}},{{$patientVisitP->id}})"
                                                                       class="view-btn">View</a> <a type="button"
                                                                                                    onclick="copyPreviousVisits({{$patientVisitP->patient_id}} ,{{$patientVisitP->practitioner_id}},{{$patientVisitP->id}})"
                                                                                                    class="copy-btn">Copy</a><a
                                                            type="button"
                                                            onclick="revisePatientVisit({{$patientVisitP->patient_id}} ,{{$patientVisitP->practitioner_id}},{{$patientVisitP->id}})"
                                                            class="revise-btn">Revise</a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><p style="font-size:9px;" class="mt-3"> No Previous Visit
                                                        Found! </p></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix vitals-row mt-2 pt-1 vitals-row2"
                                 @if(isset($patientVitalVisitGets->bp_sys_2) || isset($patientVitalVisitGets->bp_dias_2) || isset($patientVitalVisitGets->pulse_2) || isset($patientVitalVisitGets->weight_lbs_2) || isset($patientVitalVisitGets->weight_kgs_2) || isset($patientVitalVisitGets->height_ft_2) || isset($patientVitalVisitGets->height_in_2) || isset($patientVitalVisitGets->height_cms_2) || isset($patientVitalVisitGets->bmi_2) || isset($patientVitalVisitGets->bsf_2) || isset($patientVitalVisitGets->bsr_2)) style=""
                                 @else style="display: none;" @endif>
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Vitals 2</span></h6>
                                <div class="vital-sub-row1">
                                    @if(isset($patientVitalVisitGets->weight_kgs_2) || isset($patientVitalVisitGets->weight_lbs_2))
                                        <a href="javascript:void(0);" id="vital_lbs_2"
                                           class="btn-space m-0 "
                                           @if(isset($patientVitalVisitGets->weight_kgs_2)) style=""
                                           @else style="display:none;" @endif>LBs</a>
                                        <a href="javascript:void(0);" id="vital_kgs_2"
                                           class="btn-space m-0"
                                           @if(isset($patientVitalVisitGets->weight_lbs_2)) style=""
                                           @else style="display:none;" @endif>KGs</a>
                                    @else
                                        <a href="javascript:void(0);" id="vital_lbs_2"
                                           class="btn-space ">LBs</a>
                                        <a href="javascript:void(0);" id="vital_kgs_2"
                                           class="btn-space m-0" style="display:none;">KGs</a>
                                    @endif

                                    @if(isset($patientVitalVisitGets->height_ft_2) || isset($patientVitalVisitGets->height_in_2) || isset($patientVitalVisitGets->height_cms_2))
                                        <a href="javascript:void(0);" id="vital_cms_2"
                                           class="btn-space m-0"
                                           @if(isset($patientVitalVisitGets->height_ft_2) || isset($patientVitalVisitGets->height_in_2)) style=""
                                           @else style="display:none;" @endif>CMs</a>
                                        <a href="javascript:void(0);" id="vital_ft_2"
                                           class="btn-space m-0"
                                           @if(isset($patientVitalVisitGets->height_cms_2)) style=""
                                           @else style="display:none;" @endif>Ft</a>
                                    @else
                                        <a href="javascript:void(0);" id="vital_cms_2"
                                           class="btn-space m-0">CMs</a>
                                        <a href="javascript:void(0);" id="vital_ft_2"
                                           class="btn-space m-0"
                                           style="display:none;">Ft</a>
                                    @endif
                                </div>
                                <div class="table-responsive vitals-table">
                                    <table class="table new-table">
                                        <thead>
                                        <tr>
                                            <th>BP (Sys- Dias)</th>
                                            <th>Pulse</th>
                                            @if(isset($patientVitalVisitGets->weight_kgs_2))
                                                <th id="weight_unit_2">Weight (Kgs)</th>
                                            @elseif(isset($patientVitalVisitGets->weight_lbs_2))
                                                <th id="weight_unit_2">Weight (Lbs)</th>
                                            @else
                                                <th id="weight_unit_2">Weight (Kgs)</th>
                                            @endif
                                            @if(isset($patientVitalVisitGets->height_ft_2) || isset($patientVitalVisitGets->height_in_2))
                                                <th id="height_unit_2">Height (Ft/In)</th>
                                            @elseif(isset($patientVitalVisitGets->height_cms_2))
                                                <th id="height_unit_2">Height (Cms)</th>
                                            @else
                                                <th id="height_unit_2">Height (Ft/In)</th>
                                            @endif
                                            <th>BMI</th>
                                            <th>BSF</th>
                                            <th>BSR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="bp_sys_2" id="bp_sys_2"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       {{--                                                       onkeypress="return isNumberKey(event)"--}}
                                                       {{--                                                       onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;"--}}
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bp_sys_2) }}"
                                                       @endif class="grey-input" style="width:27px !important;">
                                                <input type="text" name="bp_dias_2" id="bp_dias_2"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bp_dias_2) }}"
                                                       @endif class="grey-input" style="width:23px !important;">
                                            </td>
                                            <td>
                                                <input type="text" name="pulse_2" id="pulse_2"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->pulse_2) }}"
                                                       @endif class="grey-input expand-width m-0"
                                                       style="width:30px !important;">
                                            </td>
                                            <td>
                                                @if(isset($patientVitalVisitGets->weight_kgs_2) || isset($patientVitalVisitGets->weight_lbs_2))
                                                    @if(isset($patientVitalVisitGets->weight_kgs_2))
                                                        <input type="text" name="weight_kgs_2" id="weight_kgs_2"
                                                               @if(isset($patientVitalVisitGets)) value="{{ number_format((float)$patientVitalVisitGets->weight_kgs_2, 1, '.', '') }}"
                                                               @endif class="grey-input m-0 expand-width number"
                                                               style="width:48px !important;">
                                                    @else
                                                        <input type="text" name="weight_kgs_2" id="weight_kgs_2"
                                                               value=""
                                                               class="grey-input m-0 expand-width number"
                                                               style="display:none; width:48px !important;">
                                                    @endif

                                                    @if(isset($patientVitalVisitGets->weight_lbs_2))
                                                        <input type="text" name="weight_lbs_2" id="weight_lbs_2"
                                                               @if(isset($patientVitalVisitGets)) value="{{ number_format((float)$patientVitalVisitGets->weight_lbs_2, 1, '.', '') }}"
                                                               @endif class="grey-input m-0 expand-width number"
                                                               @if(isset($patientVitalVisitGets->weight_lbs_2)) style="width:48px !important;"
                                                               @else style="display:none; width:48px !important;" @endif>
                                                    @else
                                                        <input type="text" name="weight_lbs_2" id="weight_lbs_2"
                                                               value=""
                                                               class="grey-input m-0 expand-width number"
                                                               style="display:none; width:48px !important;">
                                                    @endif
                                                @else
                                                    <input type="text" name="weight_kgs_2" id="weight_kgs_2" value=""
                                                           class="grey-input m-0 expand-width number"
                                                           style="width:48px !important;">
                                                    <input type="text" name="weight_lbs_2" id="weight_lbs_2" value=""
                                                           class="grey-input m-0 expand-width number"
                                                           style="display:none; width:48px !important;">
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($patientVitalVisitGets->height_ft_2) || isset($patientVitalVisitGets->height_in_2) || isset($patientVitalVisitGets->height_cms_2))
                                                    @if(isset($patientVitalVisitGets->height_ft_2) || isset($patientVitalVisitGets->height_in_2))
                                                        <input type="text" name="height_ft_2" id="height_ft_2"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"                                                               @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->height_ft_2) }}"
                                                               @endif class="grey-input">
                                                        <input type="text" name="height_in_2" id="height_in_2"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->height_in_2) }}"
                                                               @endif class="grey-input">
                                                    @else
                                                        <input type="text" name="height_ft_2" id="height_ft_2" value=""
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               class="grey-input" style="display:none;">
                                                        <input type="text" name="height_in_2" id="height_in_2" value=""
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               class="grey-input" style="display:none;">
                                                    @endif

                                                    @if(isset($patientVitalVisitGets->height_cms_2))
                                                        <input type="text" name="height_cms_2" id="height_cms_2"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->height_cms_2) }}"
                                                               @endif class="grey-input"
                                                               @if(isset($patientVitalVisitGets->height_cms_2)) style="width:47px !important;"
                                                               @else style="display:none; width:47px !important;" @endif>
                                                    @else
                                                        <input type="text" name="height_cms_2" id="height_cms_2"
                                                               onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                               oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                               value=""
                                                               class="grey-input"
                                                               style="display:none; width:47px !important;">
                                                    @endif
                                                @else
                                                    <input type="text" name="height_ft_2" id="height_ft_2" value=""
                                                           onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                           oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                           class="grey-input">
                                                    <input type="text" name="height_in_2" id="height_in_2" value=""
                                                           onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                           oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                           class="grey-input">
                                                    <input type="text" name="height_cms_2" id="height_cms_2" value=""
                                                           onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                           oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                           class="grey-input"
                                                           style="display:none; width:47px !important;">
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="bmi_2" id="bmi_2"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bmi_2) }}"
                                                       @endif class="grey-input m-0 expand-width" readonly
                                                       style="width:30px !important;">
                                            </td>
                                            <td>
                                                <input type="text" name="bsf_2" id="bsf_2"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bsf_2) }}"
                                                       @endif class="grey-input m-0 expand-width"
                                                       style="width:30px !important;">
                                            </td>
                                            <td>
                                                <input type="text" name="bsr_2" id="bsr_2"
                                                       onkeydown="if(event.key==='.'){event.preventDefault();}"
                                                       oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"
                                                       @if(isset($patientVitalVisitGets)) value="{{ round($patientVitalVisitGets->bsr_2) }}"
                                                       @endif class="grey-input expand-width m-0"
                                                       style="width:30px !important;">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                {{--                        <div class="table-responsive vitals-table-two">--}}
                                {{--                            <table class="table new-table">--}}
                                {{--                                <thead>--}}
                                {{--                                <tr>--}}
                                {{--                                    <th>SPO2 %</th>--}}
                                {{--                                </tr>--}}
                                {{--                                </thead>--}}
                                {{--                                <tbody>--}}
                                {{--                                <tr>--}}
                                {{--                                    <td width="90px">--}}
                                {{--                                        <input type="text" name="spo2_2" id="spo2_2"--}}
                                {{--                                               @if(isset($patientVitalVisitGets)) value="{{ $patientVitalVisitGets->spo2_2 }}"--}}
                                {{--                                               @endif class="grey-input expand-width m-0" readonly>--}}
                                {{--                                    </td>--}}
                                {{--                                </tr>--}}
                                {{--                                </tbody>--}}
                                {{--                            </table>--}}
                                {{--                        </div>--}}
                            </div>
                            <div class="clearfix pt-2 mt-2 attachments">
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Attachments ({{isset($patient->reports)?$patient->reports->count():''}})</span>
                                </h6>
                                <ul class="nav nav-tabs">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#all">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#labs">Labs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#complaints">Complaints</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#p_prescription">Prescription</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#sugar_chart">Sugar Chart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#invoices">Invoices</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#vitals">Vitals</a>
                                    </li>
                                    {{--                            <li class="nav-item">--}}
                                    <a href="#" data-toggle="modal" on style="position: absolute;
    right: 10px;
    transform: rotate(262deg);
    top: 9px;
    color: #000;"
                                       data-target="#modalPatientReportUpload"><i class="fa fa-paperclip"></i></a>
                                    {{--                            </li>--}}
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="all" class="container tab-pane active">
                                        <br>
                                        @if(count($patient->reports) > 0)
                                            <div class="owl-carousel owl-carousel-slider">
                                                @foreach($patient->reports as $report)
                                                    @php
                                                        $name = $report->image_url;
                                                        $pi = pathinfo($name);
                                                        $txt = $pi['filename'];
                                                        $ext = $pi['extension'];
                                                    if ($ext == 'pdf'){
                                                        $fileName = asset('storage/app/public/'.$report->image_url);

                                                        $file = asset('/public/images/pdf-image.png');
                                                    }else{
                                                        $file = asset('storage/app/public/'.$report->image_url);
                                                    }
                                                    @endphp
                                                    <div class="item text-center">
                                                        @if($ext == "pdf")
                                                            <a type="button" target="_blank"
                                                               href="{{route('showPdfFile',$report->id)}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @else
                                                            <a type="button" data-toggle="modal"
                                                               {{--                                                               onclick="appendImagePopUp(this)"--}}
                                                               {{--                                                               data-report-id=" viewer{{$report->id}}"--}}
                                                               {{--                                                               data-scr="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                                               data-target="#reportsPopupModal{{$report->id}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:13px;" class="mt-3 mb-4 text-center"> No File
                                                Found! </p>
                                        @endif
                                    </div>
                                    <div id="labs" class="container tab-pane">
                                        <br>
                                        @if(count($patient->reports->where('type',0)) > 0)
                                            <div class="owl-carousel owl-carousel-slider">
                                                @foreach($patient->reports->where('type',0) as $report)

                                                    @php
                                                        $name = $report->image_url;
                                                            $pi = pathinfo($name);
                                                            $txt = $pi['filename'];
                                                            $ext = $pi['extension'];
                                                    if ($ext == 'pdf'){
                                                        $fileName = asset('storage/app/public/'.$report->image_url);

                                                        $file = asset('/public/images/pdf-image.png');
                                                    }else{
                                                        $file = asset('storage/app/public/'.$report->image_url);
                                                    }
                                                    @endphp
                                                    <div class="item text-center">
                                                        @if($ext == "pdf")
                                                            <a type="button" target="_blank"
                                                               href="{{route('showPdfFile',$report->id)}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @else
                                                            <a type="button"
                                                               {{--                                                               onclick="appendImagePopUp(this)"--}}
                                                               {{--                                                               data-report-id=" viewer{{$report->id}}"--}}
                                                               {{--                                                               data-scr="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                                               data-toggle="modal"
                                                               data-target="#reportsPopupModal{{$report->id}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:13px;" class="mt-3 mb-4 text-center"> No File
                                                Found! </p>
                                        @endif
                                    </div>
                                    <div id="invoices" class="container tab-pane fade">
                                        <br>
                                        @if(count($patient->reports->where('type', 1)) > 0)
                                            <div class="owl-carousel owl-carousel-slider">
                                                @foreach($patient->reports->where('type', 1) as $report)
                                                    @php
                                                        $name = $report->image_url;
                                                            $pi = pathinfo($name);
                                                            $txt = $pi['filename'];
                                                            $ext = $pi['extension'];
                                                    if ($ext == 'pdf'){
                                                        $fileName = asset('storage/app/public/'.$report->image_url);
                                                        $file = asset('/public/images/pdf-image.png');
                                                    }else{
                                                        $file = asset('storage/app/public/'.$report->image_url);
                                                    }
                                                    @endphp
                                                    <div class="item text-center">
                                                        @if($ext == "pdf")
                                                            <a type="button" target="_blank"
                                                               href="{{route('showPdfFile',$report->id)}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @else
                                                            <a type="button" data-toggle="modal"
                                                               {{--                                                               onclick="appendImagePopUp(this)"--}}
                                                               {{--                                                               data-report-id=" viewer{{$report->id}}"--}}
                                                               {{--                                                               data-scr="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                                               data-target="#reportsPopupModal{{$report->id}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:13px;" class="mt-3 mb-4 text-center"> No File
                                                Found! </p>
                                        @endif
                                    </div>
                                    <div id="complaints" class="container tab-pane fade">
                                        <br>
                                        @if(count($patient->reports->where('type', 2)) > 0)
                                            <div class="owl-carousel owl-carousel-slider">
                                                @foreach($patient->reports->where('type', 2) as $report)
                                                    @php
                                                        $name = $report->image_url;
                                                            $pi = pathinfo($name);
                                                            $txt = $pi['filename'];
                                                            $ext = $pi['extension'];
                                                    if ($ext == 'pdf'){
                                                        $fileName = asset('storage/app/public/'.$report->image_url);

                                                        $file = asset('/public/images/pdf-image.png');
                                                    }else{
                                                        $file = asset('storage/app/public/'.$report->image_url);
                                                    }
                                                    @endphp
                                                    <div class="item text-center">
                                                        @if($ext == "pdf")
                                                            <a type="button" target="_blank"
                                                               href="{{route('showPdfFile',$report->id)}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @else
                                                            <a type="button" data-toggle="modal"
                                                               {{--                                                               onclick="appendImagePopUp(this)"--}}
                                                               {{--                                                               data-report-id=" viewer{{$report->id}}"--}}
                                                               {{--                                                               data-scr="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                                               data-target="#reportsPopupModal{{$report->id}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:13px;" class="mt-3 mb-4 text-center"> No File
                                                Found! </p>
                                        @endif
                                    </div>
                                    <div id="p_prescription" class="container tab-pane fade">
                                        <br>
                                        @if(count($patient->reports->where('type', 3)) > 0)
                                            <div class="owl-carousel owl-carousel-slider">
                                                @foreach($patient->reports->where('type', 3) as $report)
                                                    @php
                                                        $name = $report->image_url;
                                                            $pi = pathinfo($name);
                                                            $txt = $pi['filename'];
                                                            $ext = $pi['extension'];
                                                    if ($ext == 'pdf'){
                                                        $fileName = asset('storage/app/public/'.$report->image_url);

                                                        $file = asset('/public/images/pdf-image.png');
                                                    }else{
                                                        $file = asset('storage/app/public/'.$report->image_url);
                                                    }
                                                    @endphp
                                                    <div class="item text-center">
                                                        @if($ext == "pdf")
                                                            <a type="button" target="_blank"
                                                               href="{{route('showPdfFile',$report->id)}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @else
                                                            <a type="button" data-toggle="modal"
                                                               {{--                                                               onclick="appendImagePopUp(this)"--}}
                                                               {{--                                                               data-report-id=" viewer{{$report->id}}"--}}
                                                               {{--                                                               data-scr="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                                               data-target="#reportsPopupModal{{$report->id}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:13px;" class="mt-3 mb-4 text-center"> No File
                                                Found! </p>
                                        @endif
                                    </div>
                                    <div id="sugar_chart" class="container tab-pane fade">
                                        <br>
                                        @if(count($patient->reports->where('type', 4)) > 0)

                                            <div class="owl-carousel owl-carousel-slider">
                                                @foreach($patient->reports->where('type', 4) as $report)
                                                    @php
                                                        $name = $report->image_url;
                                                            $pi = pathinfo($name);
                                                            $txt = $pi['filename'];
                                                            $ext = $pi['extension'];
                                                    if ($ext == 'pdf'){
                                                        $fileName = asset('storage/app/public/'.$report->image_url);

                                                        $file = asset('/public/images/pdf-image.png');
                                                    }else{
                                                        $file = asset('storage/app/public/'.$report->image_url);
                                                    }
                                                    @endphp
                                                    <div class="item text-center">
                                                        @if($ext == "pdf")
                                                            <a type="button" target="_blank"
                                                               href="{{route('showPdfFile',$report->id)}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @else
                                                            <a type="button" data-toggle="modal"
                                                               {{--                                                               onclick="appendImagePopUp(this)"--}}
                                                               {{--                                                               data-report-id=" viewer{{$report->id}}"--}}
                                                               {{--                                                               data-scr="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                                               data-target="#reportsPopupModal{{$report->id}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:13px;" class="mt-3 mb-4 text-center"> No File
                                                Found! </p>
                                        @endif
                                    </div>
                                    <div id="vitals" class="container tab-pane fade">
                                        <br>
                                        @if(count($patient->reports->where('type', 5)) > 0)
                                            <div class="owl-carousel owl-carousel-slider">
                                                @foreach($patient->reports->where('type', 5) as $report)
                                                    @php
                                                        $name = $report->image_url;
                                                            $pi = pathinfo($name);
                                                            $txt = $pi['filename'];
                                                            $ext = $pi['extension'];
                                                    if ($ext == 'pdf'){
                                                        $fileName = asset('storage/app/public/'.$report->image_url);

                                                        $file = asset('/public/images/pdf-image.png');
                                                    }else{
                                                        $file = asset('storage/app/public/'.$report->image_url);
                                                    }
                                                    @endphp
                                                    <div class="item text-center">
                                                        @if($ext == "pdf")
                                                            <a type="button" target="_blank"
                                                               href="{{route('showPdfFile',$report->id)}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @else
                                                            <a type="button" data-toggle="modal"
                                                               {{--                                                               onclick="appendImagePopUp(this)"--}}
                                                               {{--                                                               data-report-id=" viewer{{$report->id}}"--}}
                                                               {{--                                                               data-scr="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                                               data-target="#reportsPopupModal{{$report->id}}">
                                                                <div class="lab-img">
                                                                    <img src="{{$file}}"
                                                                         style="height: 90px; width: 131px;">
                                                                    {{-- <i class="fa fa-search"></i> --}}
                                                                </div>
                                                                <p class="lab-rep m-0">{{$report->title}}</p>
                                                                <p class="rep-date m-0">{{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:13px;" class="mt-3 mb-4 text-center"> No File
                                                Found! </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix pt-2 mt-2 doctor-notes">
                                <h6 class="SourceSansProBold light-green horizental-line">
                                    <span>Doctor Notes (internal)</span>
                                </h6>
                                <textarea name="doctor_notes_internal"
                                          id="doctor_notes_internal">{{$patientVisit->notes_internal}}</textarea>
                            </div>
                            <div class="clearfix pt-2 mt-2 doctor-notes-printed">
                                <h6 class="SourceSansProBold light-blue-print horizental-line">
                                    <span>Doctor Notes (Printed)</span></h6>
                                <textarea name="doctor_notes_printed"
                                          id="doctor_notes_printed">{{$patientVisit->notes_printed}}</textarea>
                            </div>
                            {{--                    <div class="clearfix pt-2 mt-2" align="right">--}}
                            {{--                        <input type="hidden" name="patient_visit_id" id="patient_visit_id"--}}
                            {{--                               value="{{$patientVisit->id}}">--}}
                            {{--                        <a type="button" onclick="submitTextarea()" class="save-temp-btn">Save as Template</a>--}}
                            {{--                    </div>--}}
                        </div>
                    </div>
                    {{--            <div class="row medications-row">--}}
                    {{--                <div class="col-lg-12">--}}
                    {{--                    <h6 class="SourceSansProBold blue-color horizental-line"><span>Medications</span></h6>--}}
                    {{--                    <ul class="p-0">--}}
                    {{--                        <li><a href="#" class="generic-name">Generic Name</a><input type="text" name=""--}}
                    {{--                                                                                    placeholder="Type Medicine Trade Name"--}}
                    {{--                                                                                    class="medicine-trade-name"></li>--}}
                    {{--                        <li class="dosage">--}}
                    {{--                            <h6>Dosage</h6>--}}
                    {{--                            <input type="text" name="" placeholder="Morning">--}}
                    {{--                            <input type="text" name="" placeholder="Afternoon">--}}
                    {{--                            <input type="text" name="" placeholder="Evening">--}}
                    {{--                            <input type="text" name="" placeholder="Night">--}}
                    {{--                        </li>--}}
                    {{--                        <li><a href="#" class="as-required">As Required</a></li>--}}
                    {{--                        <li class="meal">--}}
                    {{--                            <h6>Meal</h6>--}}
                    {{--                            <input type="text" name="" placeholder="Minutes">--}}
                    {{--                            <a href="#" class="as-use">Before</a>--}}
                    {{--                            <a href="#" class="as-use">After</a>--}}
                    {{--                            <a href="#" class="as-use">With</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li><span class="border-sep"></span></li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#" class="as-use">Breakfast</a>--}}
                    {{--                            <a href="#" class="as-use">Lunch</a>--}}
                    {{--                            <a href="#" class="as-use">Dinner</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="intake">--}}
                    {{--                            <h6 class="mb-2">Intake</h6>--}}
                    {{--                            <a href="#" class="as-use">Oral</a>--}}
                    {{--                            <a href="#" class="as-use">Local</a>--}}
                    {{--                            <a href="#" class="as-use">IV</a>--}}
                    {{--                            <a href="#" class="as-use">IM</a>--}}
                    {{--                            <a href="#" class="as-use">Units</a>--}}
                    {{--                            <a href="#" class="as-use">Nasal</a>--}}
                    {{--                            <a href="#" class="as-use">Eye</a>--}}
                    {{--                            <a href="#" class="as-use">Ear</a>--}}
                    {{--                            <a href="#" class="as-use">Vaginal</a>--}}
                    {{--                            <a href="#" class="as-use">Rectal</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="duration">--}}
                    {{--                            <h6>Duration</h6>--}}
                    {{--                            <div style="height: 10px;"></div>--}}
                    {{--                            <input type="text" name="" placeholder="Day/Weeks">--}}
                    {{--                        </li>--}}
                    {{--                        <li class="count-days">--}}
                    {{--                            <a href="#" class="as-use">Days</a>--}}
                    {{--                            <a href="#" class="as-use">Weeks</a>--}}
                    {{--                            <a href="#" class="as-use">Months</a>--}}
                    {{--                            <a href="#" class="as-use">Continue</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="treating-condition">--}}
                    {{--                            <h6>Treating Condition</h6>--}}
                    {{--                            <div style="height: 10px;"></div>--}}
                    {{--                            <input type="text" name="" placeholder="Search Disease Tags / Conditions">--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                    {{--                    <div class="special-dosage">--}}
                    {{--                        <h6 class="SourceSansProBold blue-color horizental-line"><span>Special Dosage</span></h6>--}}
                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-sm-4 col-lg-3">--}}
                    {{--                                <div class="number-system">--}}
                    {{--                                    <a href="#">1</a>--}}
                    {{--                                    <a href="#">2</a>--}}
                    {{--                                    <a href="#">3</a>--}}
                    {{--                                    <a href="#">4</a>--}}
                    {{--                                    <a href="#">5</a>--}}
                    {{--                                    <a href="#">6</a>--}}
                    {{--                                    <a href="#">7</a>--}}
                    {{--                                    <a href="#">8</a>--}}
                    {{--                                    <a href="#">9</a>--}}
                    {{--                                    <a href="#">0</a>--}}
                    {{--                                    <a href="#">AM</a>--}}
                    {{--                                    <a href="#">PM</a>--}}
                    {{--                                    <a href="#">Hrs</a>--}}
                    {{--                                    <a href="#">Days</a>--}}
                    {{--                                    <a href="#">Weeks</a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="col-sm-6 col-lg-8 p-0 m-pading-15">--}}
                    {{--                                <textarea placeholder="Special Instructions"></textarea>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="col-sm-2 col-lg-1 pr-0">--}}
                    {{--                                <a href="#" class="add-dosage">Add Dosage</a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="table-responsive mt-2">--}}
                    {{--                            <table class="table new-table dosage-tabel">--}}
                    {{--                                <thead>--}}
                    {{--                                <tr>--}}
                    {{--                                    <th>#</th>--}}
                    {{--                                    <th>Dosage</th>--}}
                    {{--                                    <th>Special Instructions</th>--}}
                    {{--                                    <th class="text-center">Actions</th>--}}
                    {{--                                </tr>--}}
                    {{--                                </thead>--}}
                    {{--                                <tbody>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>1</td>--}}
                    {{--                                    <td>1 Tablet 8AM</td>--}}
                    {{--                                    <td>Crush the table and mix it with water. Lorem ipsum dolor sit amet, consectetur--}}
                    {{--                                        adipiscing elit, sed--}}
                    {{--                                    </td>--}}
                    {{--                                    <td class="text-center"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>2</td>--}}
                    {{--                                    <td>1 Tablet after 10 Days</td>--}}
                    {{--                                    <td></td>--}}
                    {{--                                    <td class="text-center"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>3</td>--}}
                    {{--                                    <td>1 Tablet after 4 Weeks</td>--}}
                    {{--                                    <td></td>--}}
                    {{--                                    <td class="text-center"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                </tbody>--}}
                    {{--                            </table>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-lg-12 text-right pt-3 pb-3 pr-0">--}}
                    {{--                            <a href="#" class="add-prescription">Add to Prescription</a>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="table-responsive prescription-tabel">--}}
                    {{--                            <table class="table new-table">--}}
                    {{--                                <thead>--}}
                    {{--                                <tr>--}}
                    {{--                                    <th>#</th>--}}
                    {{--                                    <th>Medicine Name</th>--}}
                    {{--                                    <th class="text-center">Dosage</th>--}}
                    {{--                                    <th class="text-center">Intake</th>--}}
                    {{--                                    <th>Duration</th>--}}
                    {{--                                    <th>Diet</th>--}}
                    {{--                                    <th>Condition</th>--}}
                    {{--                                    <th class="text-center">Actions</th>--}}
                    {{--                                </tr>--}}
                    {{--                                </thead>--}}
                    {{--                                <tbody>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>1</td>--}}
                    {{--                                    <td>Risek 40mg Cap</td>--}}
                    {{--                                    <td class="text-center p-3"><img src="{{ asset('public/images/dosage-icon.png') }}">--}}
                    {{--                                    </td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>120 Minutes Before Meals</td>--}}
                    {{--                                    <td>Reflux</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>2</td>--}}
                    {{--                                    <td>Carveda 6.25mg Tab</td>--}}
                    {{--                                    <td class="text-center p-3">1 + 1+1+1</td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>After Meals</td>--}}
                    {{--                                    <td>Throat Infection</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>3</td>--}}
                    {{--                                    <td>Risek 40mg Cap</td>--}}
                    {{--                                    <td class="text-center p-3">1 + 1+1+1</td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>120 Minutes Before Meals</td>--}}
                    {{--                                    <td>Reflux</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>4</td>--}}
                    {{--                                    <td>Carveda 6.25mg Tab</td>--}}
                    {{--                                    <td class="text-center p-3">1 + 1+1+1</td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>After Meals</td>--}}
                    {{--                                    <td>Throat Infection</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>5</td>--}}
                    {{--                                    <td>Risek 40mg Cap</td>--}}
                    {{--                                    <td class="text-center p-3">1 + 1+1+1</td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>120 Minutes Before Meals</td>--}}
                    {{--                                    <td>Reflux</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>6</td>--}}
                    {{--                                    <td>Carveda 6.25mg Tab</td>--}}
                    {{--                                    <td class="text-center p-3">1 + 1+1+1</td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>After Meals</td>--}}
                    {{--                                    <td>Throat Infection</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>7</td>--}}
                    {{--                                    <td>Risek 40mg Cap</td>--}}
                    {{--                                    <td class="text-center p-3">1 + 1+1+1</td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>120 Minutes Before Meals</td>--}}
                    {{--                                    <td>Reflux</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>8</td>--}}
                    {{--                                    <td>Carveda 6.25mg Tab</td>--}}
                    {{--                                    <td class="text-center p-3">1 + 1+1+1</td>--}}
                    {{--                                    <td class="text-center p-3">Oral</td>--}}
                    {{--                                    <td>2 Weeks</td>--}}
                    {{--                                    <td>After Meals</td>--}}
                    {{--                                    <td>Throat Infection</td>--}}
                    {{--                                    <td class="text-center p-3"><a href="#"><img--}}
                    {{--                                                src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a--}}
                    {{--                                            href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>--}}
                    {{--                                </tr>--}}
                    {{--                                </tbody>--}}
                    {{--                            </table>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    {{--            </div>--}}

                    <div class="clearfix pt-2 templates-row fav-lab">
                        <h6 class="SourceSansProBold blue-color horizental-line">
                            <span>Favorite Labs / Investigations</span>
                        </h6>
                        <form>
                            <select name="search_template" data-live-search="true"
                                    onchange="saveLabTest(this)" data-patient-id="{{$patient->id}}"
                                    data-patient-visit-id="{{$patientVisit->id}}"
                                    data-practitioner-id="{{$practitioner->id}}"
                                    class="selectpicker search_template form-control w-100 {{ $errors->has('search_template') ? ' is-invalid' : '' }}"
                                    title="Select Template" required>
                                @foreach($labTests as $labTest)
                                    @if(isset($labTest))
                                        <option
                                            value="{{ $labTest->id }}">{{ $labTest->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{--                    <input type="text" name="" placeholder="Search Labs">--}}
                            {{--                    <button type="submit">OTE</button>--}}
                        </form>
                        <div class="templates-show" style="max-width:100%;">
                            {{--                    <a href="#">Lab1</a>--}}
                            @foreach($labTestsFavourites as $labTestsFavourite)
                                @if(isset($labTestsFavourite->labTest))
                                    <a type="button" data-id="{{ $labTestsFavourite->labTest->id }}"
                                       data-patient-id="{{$patient->id}}"
                                       data-patient-visit-id="{{$patientVisit->id}}"
                                       data-practitioner-id="{{$practitioner->id}}"
                                       onclick="saveLabTest(this)">{{isset($labTestsFavourite->labTest->title)?$labTestsFavourite->labTest->title:''}}</a>
                                @endif
                            @endforeach
                        </div>
                        <div class="table-responsive prescription-tabel mt-4">
                            <table class="table new-table">
                                <thead>
                                <tr>
                                    <th>Diagnostic Name</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Fasting</th>
                                    <th>Instructions</th>
                                    <th>Recommended Lab</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="labtest_body">
                                @foreach($patientVisitLabTests as $patientVisitLabTest)
                                    <tr class="labtest{{$patientVisitLabTest->lab_test_id}}">
                                        <td class="p-2">{{$patientVisitLabTest->lab_test_name}}</td>
                                        <td class="text-center p-2">{{isset($patientVisitLabTest->typeTest)?$patientVisitLabTest->typeTest->title:""}}</td>
                                        <td class="text-center p-2">{{($patientVisitLabTest->fasting== 1)?'Yes':'No'}}</td>
                                        <td class="p-2">{{($patientVisitLabTest->instructions == null)?'None':$patientVisitLabTest->instructions}}</td>
                                        <td class="p-2">{{isset($patientVisitLabTest->recommendedLabTest->title)?$patientVisitLabTest->recommendedLabTest->title:'None'}}</td>
                                        <td class="text-center p-2"><a type="button"
                                                                       data-id="{{$patientVisitLabTest->id}}"
                                                                       data-lab-test-id="{{$patientVisitLabTest->lab_test_id}}"
                                                                       data-lab-test-name="{{$patientVisitLabTest->lab_test_name}}"
                                                                       data-type="{{$patientVisitLabTest->type_id}}"
                                                                       data-fasting="{{$patientVisitLabTest->fasting}}"
                                                                       data-instructions="{{$patientVisitLabTest->instructions}}"
                                                                       data-recommended-lab="{{$patientVisitLabTest->recommended_lab}}"
                                                                       onclick="modalEditLabTestPopUp(this)"><img
                                                    src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a
                                                data-id="{{$patientVisitLabTest->id}}" onclick="deleteLabTest(this)"
                                                type="button"><img src="{{ asset('public/images/del-icon.png') }}"></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="clearfix pt-2 suger-chart mt-4">
                        <h6 class="SourceSansProBold blue-color horizental-line"><span>Sugar Chart</span></h6>
                        <div class="table-responsive mt-4">
                            <table class="table new-table sugar_table">
                                <thead>
                                <tr>
                                    <th class="light-font">Monitoring Time</th>
                                    <th>Sunday</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="hidden-table-hover">Before Breakfast</td>
                                    @if(isset($patientSugarChart->day_1_before_breakfast) && $patientSugarChart->day_1_before_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day1BeforeBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day1BeforeBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_before_breakfast) && $patientSugarChart->day_2_before_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day2BeforeBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day2BeforeBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_before_breakfast) && $patientSugarChart->day_3_before_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day3BeforeBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day3BeforeBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_before_breakfast) && $patientSugarChart->day_4_before_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day4BeforeBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day4BeforeBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_before_breakfast) && $patientSugarChart->day_5_before_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day5BeforeBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day5BeforeBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_before_breakfast) && $patientSugarChart->day_6_before_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day6BeforeBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day6BeforeBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_before_breakfast) && $patientSugarChart->day_7_before_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day7BeforeBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day7BeforeBreakfast')"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="hidden-table-hover">2 Hours after Breakfast</td>
                                    @if(isset($patientSugarChart->day_1_2_hours_after_breakfast) && $patientSugarChart->day_1_2_hours_after_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day12HoursAfterBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day12HoursAfterBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_2_hours_after_breakfast) && $patientSugarChart->day_2_2_hours_after_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day22HoursAfterBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day22HoursAfterBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_2_hours_after_breakfast) && $patientSugarChart->day_3_2_hours_after_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day32HoursAfterBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day32HoursAfterBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_2_hours_after_breakfast) && $patientSugarChart->day_4_2_hours_after_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day42HoursAfterBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day42HoursAfterBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_2_hours_after_breakfast) && $patientSugarChart->day_5_2_hours_after_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day52HoursAfterBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day52HoursAfterBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_2_hours_after_breakfast) && $patientSugarChart->day_6_2_hours_after_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day62HoursAfterBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day62HoursAfterBreakfast')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_2_hours_after_breakfast) && $patientSugarChart->day_7_2_hours_after_breakfast == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day72HoursAfterBreakfast')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day72HoursAfterBreakfast')"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="hidden-table-hover">Before Lunch</td>
                                    @if(isset($patientSugarChart->day_1_before_lunch) && $patientSugarChart->day_1_before_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day1BeforeLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day1BeforeLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_before_lunch) && $patientSugarChart->day_2_before_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day2BeforeLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day2BeforeLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_before_lunch) && $patientSugarChart->day_3_before_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day3BeforeLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day3BeforeLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_before_lunch) && $patientSugarChart->day_4_before_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day4BeforeLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day4BeforeLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_before_lunch) && $patientSugarChart->day_5_before_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day5BeforeLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day5BeforeLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_before_lunch) && $patientSugarChart->day_6_before_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day6BeforeLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day6BeforeLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_before_lunch) && $patientSugarChart->day_7_before_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day7BeforeLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day7BeforeLunch')"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="hidden-table-hover">2 Hours after Lunch</td>
                                    @if(isset($patientSugarChart->day_1_2_hours_after_lunch) && $patientSugarChart->day_1_2_hours_after_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day12HoursAfterLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day12HoursAfterLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_2_hours_after_lunch) && $patientSugarChart->day_2_2_hours_after_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day22HoursAfterLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day22HoursAfterLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_2_hours_after_lunch) && $patientSugarChart->day_3_2_hours_after_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day32HoursAfterLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day32HoursAfterLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_2_hours_after_lunch) && $patientSugarChart->day_4_2_hours_after_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day42HoursAfterLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day42HoursAfterLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_2_hours_after_lunch) && $patientSugarChart->day_5_2_hours_after_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day52HoursAfterLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day52HoursAfterLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_2_hours_after_lunch) && $patientSugarChart->day_6_2_hours_after_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day62HoursAfterLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day62HoursAfterLunch')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_2_hours_after_lunch) && $patientSugarChart->day_7_2_hours_after_lunch == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day72HoursAfterLunch')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day72HoursAfterLunch')"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="hidden-table-hover">Before Dinner</td>
                                    @if(isset($patientSugarChart->day_1_before_dinner) && $patientSugarChart->day_1_before_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day1BeforeDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day1BeforeDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_before_dinner) && $patientSugarChart->day_2_before_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day2BeforeDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day2BeforeDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_before_dinner) && $patientSugarChart->day_3_before_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day3BeforeDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day3BeforeDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_before_dinner) && $patientSugarChart->day_4_before_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day4BeforeDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day4BeforeDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_before_dinner) && $patientSugarChart->day_5_before_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day5BeforeDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day5BeforeDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_before_dinner) && $patientSugarChart->day_6_before_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day6BeforeDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day6BeforeDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_before_dinner) && $patientSugarChart->day_7_before_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day7BeforeDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day7BeforeDinner')"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="hidden-table-hover">2 Hours after Dinner</td>
                                    @if(isset($patientSugarChart->day_1_2_hours_after_dinner) && $patientSugarChart->day_1_2_hours_after_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day12HoursAfterDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day12HoursAfterDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_2_hours_after_dinner) && $patientSugarChart->day_2_2_hours_after_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day22HoursAfterDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day22HoursAfterDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_2_hours_after_dinner) && $patientSugarChart->day_3_2_hours_after_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day32HoursAfterDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day32HoursAfterDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_2_hours_after_dinner) && $patientSugarChart->day_4_2_hours_after_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day42HoursAfterDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day42HoursAfterDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_2_hours_after_dinner) && $patientSugarChart->day_5_2_hours_after_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day52HoursAfterDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day52HoursAfterDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_2_hours_after_dinner) && $patientSugarChart->day_6_2_hours_after_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day62HoursAfterDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day62HoursAfterDinner')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_2_hours_after_dinner) && $patientSugarChart->day_7_2_hours_after_dinner == 1)
                                        <td class="fill-bg"
                                            onclick="unCheckSugarChart(this, 0, 'day72HoursAfterDinner')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day72HoursAfterDinner')"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="hidden-table-hover">At Bedtime</td>
                                    @if(isset($patientSugarChart->day_1_bed_time) && $patientSugarChart->day_1_bed_time == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day1BedTime')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day1BedTime')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_bed_time) && $patientSugarChart->day_2_bed_time == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day2BedTime')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day2BedTime')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_bed_time) && $patientSugarChart->day_3_bed_time == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day3BedTime')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day3BedTime')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_bed_time) && $patientSugarChart->day_4_bed_time == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day4BedTime')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day4BedTime')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_bed_time) && $patientSugarChart->day_5_bed_time == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day5BedTime')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day5BedTime')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_bed_time) && $patientSugarChart->day_6_bed_time == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day6BedTime')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day6BedTime')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_bed_time) && $patientSugarChart->day_7_bed_time == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day7BedTime')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day7BedTime')"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="hidden-table-hover">At 3:00 AM</td>
                                    @if(isset($patientSugarChart->day_1_at_3_am) && $patientSugarChart->day_1_at_3_am == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day1At3am')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day1At3am')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_2_at_3_am) && $patientSugarChart->day_2_at_3_am == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day2At3am')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day2At3am')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_3_at_3_am) && $patientSugarChart->day_3_at_3_am == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day3At3am')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day3At3am')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_4_at_3_am) && $patientSugarChart->day_4_at_3_am == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day4At3am')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day4At3am')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_5_at_3_am) && $patientSugarChart->day_5_at_3_am == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day5At3am')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day5At3am')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_6_at_3_am) && $patientSugarChart->day_6_at_3_am == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day6At3am')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day6At3am')"></td>
                                    @endif
                                    @if(isset($patientSugarChart->day_7_at_3_am) && $patientSugarChart->day_7_at_3_am == 1)
                                        <td class="fill-bg" onclick="unCheckSugarChart(this, 0, 'day7At3am')"></td>
                                    @else
                                        <td onclick="checkSugarChart(this, 1, 'day7At3am')"></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6 col-lg-6">
                            <div class="clearfix pt-2 templates-row  refer-to">
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Refer to</span></h6>
                                <form>
                                    <select name="search_doctor" data-live-search="true"
                                            onchange="fetchDoctorDropDown(this)" data-patient-id="{{$patient->id}}"
                                            data-patient-visit-id="{{$patientVisit->id}}"
                                            data-practitioner-id="{{$practitioner->id}}"
                                            class="selectpicker search_doctor form-control w-100 {{ $errors->has('search_doctor') ? ' is-invalid' : '' }}"
                                            title="Select Referal Doctor" required>
                                        @foreach($referalDoctors as $referalDoctor)
                                            <option

                                                value="{{ $referalDoctor->id }}">{{ $referalDoctor->name }},
                                                {{$referalDoctor->address}},
                                                {{$referalDoctor->phone}}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <div class="templates-show">
                                    @foreach($referalDoctors as $referalDoctor)
                                        <a type="button"
                                           @if(isset($patientReferPractitioners))
                                           @foreach($patientReferPractitioners as $patientReferPractitioner)
                                           @if($patientReferPractitioner->referral_practitioner_id == $referalDoctor->id)
                                           style="background-color: #F5F6FA"
                                           @endif
                                           @endforeach
                                           @endif
                                           data-id="{{ $referalDoctor->id }}"
                                           data-patient-id="{{$patient->id}}"
                                           data-patient-visit-id="{{$patientVisit->id}}"
                                           data-practitioner-id="{{$practitioner->id}}"
                                           onclick="fetchDoctorDropDown(this)">{{ $referalDoctor->name }}</a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 mobile-m-top">
                            <div class="clearfix pt-2 next-visit">
                                <h6 class="SourceSansProBold blue-color horizental-line"><span>Next Visit</span></h6>
                                <ul class="next-visit-no mt-3 p-0">
                                    <li><input type="text" id="visit_days" name="visit_days"
                                               @if(isset($patientVisit->next_visit)) value="{{ $patientVisit->next_visit }}" @endif>
                                    </li>
                                    @php
                                        $last = explode(' ', $patientVisit->next_visit);
                                        $world=  array_pop($last);
                                    @endphp
                                    <li><a type="button" onclick="getDays(1)" id="days"
                                           @if($world == 'days') style="background-color: rgb(59, 255, 79); color: black;" @endif>Day(s)</a>
                                    </li>

                                    <li><a type="button" onclick="getDays(2)" id="weeks"
                                           @if($world == 'weeks') style="background-color: rgb(59, 255, 79); color: black;" @endif>Week(s)</a>
                                    </li>
                                    <li>
                                        <a type="button" onclick="getDays(3)" id="months"
                                           @if($world == 'months') style="background-color: rgb(59, 255, 79); color: black;" @endif>Month(s)</a>
                                    </li>
                                </ul>
                                <div class="calender-btns" style="display: none">
                                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest" >
                                        <input type="text" class="datetimepicker-input fc-datepicker date-style"
                                               id="visit_next_date"
                                               data-provide="datepicker" placeholder="MM/DD/YYYY" autocomplete="off"
                                               name="search_date"
                                               @if(isset($patientVisit->next_visit_date)) value="{{ date('m/d/Y', strtotime($patientVisit->next_visit_date)) }}" @endif>
                                        <div class="input-group-append" data-target=""
                                             data-provide="">
                                            <div class="input-group-text around-border"><i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="save-tempaltes">
                                </div>
                                <div align="right">
                                    <div class="row">
{{--                                        <a type="button" class="send-pateint-btn-preview mr-2"--}}
{{--                                           href="{{ route('patientReportPreview', ['patientId' => $patient->id, 'appointmentId' => $appointment->id, 'practitionerId' => Auth::guard('practitioner')->user()->id]) }}">Save--}}
{{--                                            & Preview</a>--}}
                                        <a type="button" class="send-pateint-btn mr-2"
                                           href="{{ route('sendToPatientReport', ['patientId' => $patient->id, 'appointmentId' => $appointment->id, 'practitionerId' => $appointment->practitioner_id]) }}">Save
                                            & Preview</a>
                                        <a type="button" onclick="saveAsTemplate(this)"
                                           class="save-temp-btn">Save as Template</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            @php
                $ImageArray = [];
            @endphp
            @foreach($patient->reports as $key => $report)
                @php
                    $name = $report->image_url;
                    $pi = pathinfo($name);
                    $txt = $pi['filename'];
                    $ext = $pi['extension'];
                if($ext != 'pdf'){
                    $ImageArray[] = $report;
                }
                @endphp
            @endforeach
            @foreach($ImageArray as $key => $report)
                @php
                    $name = $report->image_url;
                    $pi = pathinfo($name);
                    $txt = $pi['filename'];
                    $ext = $pi['extension'];
                    if ($ext != 'pdf'){
                        $endArray = array_keys($ImageArray);

                        $endKey = end($endArray);
                        if($key != 0){
                           $pKey = $key - 1;
                        }
                       if($endKey != $key){
                       $nKey = $key + 1;
                   }
                    }
                @endphp
                @if ($ext != 'pdf')
                    <div id="reportsPopupModal{{$report->id}}" class="modal fade" tabindex="-1"
                         role="dialog">

                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header" id="modal-header">
                                    <div class="mr-5">
                                        @if($key != 0)
                                            <input class="previous btn btn-warning"
                                                   onclick="previous({{$report->id}},'reportsPopupModal{{$ImageArray[$pKey]->id}}')"
                                                   type="button"
                                                   value="Previous">
                                        @endif
                                    </div>
                                    <div class="text-center mr-5 ml-5">
                                        <h4 class="modal-title" id="modal-title">
                                            Attachment ({{$report->title}})
                                            ({{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}
                                            ) @if($report->type == 0)
                                                (Labs) @elseif($report->type == 1)
                                                (Invoices) @elseif($report->type == 2)
                                                (Complaints)@elseif($report->type == 3)
                                                (Prescription)@elseif($report->type == 4)
                                                (Sugar Chart)@elseif($report->type == 5)
                                                (Vitals) @endif
                                        </h4>
                                    </div>
                                    <div class="ml-5">
                                        @if($endKey != $key)
                                            <input class="next ml-5  btn btn-warning"
                                                   onclick="next({{$report->id}},'reportsPopupModal{{$ImageArray[$nKey]->id}}')"
                                                   type="button"
                                                   value="Next">
                                        @endif
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal">
                                        ×
                                    </button>
                                </div>
                                <div class="modal-body openseadragon" id="image{{$report->id}}">
                                    {{--                                <img class="img-responsive img-center-popup zoom{{$report->id}}"--}}
                                    {{--                                     id="zoom-image{{$report->id}}"--}}
                                    {{--                                     src="{{asset('storage/app/public/'.$report->image_url)}}"--}}
                                    {{--                                     style="height: 555px; width: 555px">--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if(isset($patient))
                <div id="modalPatientEditProfile" class="modal fade popup-style" data-keyboard="false"
                     data-backdrop="static">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content bd-0 tx-14">
                            <div class="modal-header pd-y-20 pd-x-25">
                                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Patient Profile</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body pd-25">
                                <form id="patient_edit_profile_form_model">
                                    @csrf
                                    <div class="modal-body pd-25">
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="input-group">
                                                    <label class="text-bold">Patient Name <span
                                                            style="color:red">*</span></label>
                                                    <input type="text" name="patient_name" id="patient_name"
                                                           class="form-control {{ $errors->has('patient_name') ? ' is-invalid' : '' }}"
                                                           placeholder="Enter Patient Name"
                                                           value="{{ $patient->name }}">
                                                    @if ($errors->has('patient_name'))
                                                        <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('patient_name') }}</strong>
</span>
                                                    @endif
                                                </div>

                                                <div class="input-group mt-3">
                                                    <label class="text-bold">Age <span
                                                            style="color:red">*</span></label>
                                                    <input type="number" name="patient_age" id="patient_age"
                                                           class="form-control {{ $errors->has('patient_age') ? ' is-invalid' : '' }}"
                                                           placeholder="Enter Age" value="{{ $patient->age }}">
                                                    @if ($errors->has('patient_age'))
                                                        <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('patient_age') }}</strong>
</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="input-group">
                                                    <label class="text-bold">Gender <span
                                                            style="color:red">*</span></label>
                                                    <div class="cleafix"></div>
                                                    <select name="patient_gender" id="patient_gender"
                                                            class="form-control w-100 {{ $errors->has('patient_gender') ? ' is-invalid' : '' }}"
                                                            required>
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="1" {{($patient->gender == 1)?'selected':''}}>Male
                                                        </option>
                                                        <option value="2" {{($patient->gender == 2)?'selected':''}}>
                                                            Female
                                                        </option>
                                                        <option value="3" {{($patient->gender == 3)?'selected':''}}>
                                                            Other
                                                        </option>
                                                    </select>
                                                    @if ($errors->has('patient_gender'))
                                                        <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('patient_gender') }}</strong>
</span>
                                                    @endif
                                                </div>

                                                <div class="input-group mt-3">
                                                    <label class="text-bold">Phone No. <span style="color:red">*</span></label>
                                                    <input type="text" name="patient_phone" id="patient_phone"
                                                           class="form-control {{ $errors->has('patient_phone') ? ' is-invalid' : '' }}"
                                                           placeholder="Enter Phone No." value="{{ $patient->phone }}">
                                                    @if ($errors->has('patient_phone'))
                                                        <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('patient_phone') }}</strong>
</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="input-group mt-3">
                                                    <label class="text-bold">Address</label>
                                                    <textarea name="patient_address" rows="4"
                                                              class="form-control {{ $errors->has('patient_address') ? ' is-invalid' : '' }}"
                                                              placeholder="Enter Patient Address">{{ $patient->address }}</textarea>
                                                    @if ($errors->has('patient_address'))
                                                        <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('patient_address') }}</strong>
</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                    </div>
                                    <div class="modal-footer clearfix">
                                        <button
                                            class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">
                                            Update
                                        </button>
                                        <button type="button"
                                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                                                data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div id="modalPatientReportUpload" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content bd-0 tx-14">
                    <div class="modal-header pd-y-20 pd-x-25">
                        <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Upload Attachment</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pd-25">
                        <form id="patient_report_upload_form_model" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body pd-25">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="input-group">
                                            <label class="text-bold">Title <span style="color:red">*</span></label>
                                            <input type="text" name="file_title" id="file_title"
                                                   class="form-control {{ $errors->has('file_title') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Title" required>
                                            @if ($errors->has('file_title'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('file_title') }}</strong>
</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Type <span style="color:red">*</span></label>
                                            <select name="file_type" id="file_type"
                                                    class="form-control {{ $errors->has('file_type') ? ' is-invalid' : '' }}"
                                                    required>
                                                <option value="" selected disabled>Select Type</option>
                                                <option value="0">Lab</option>
                                                <option value="1">Invoice</option>
                                                <option value="2">Complaint</option>
                                                <option value="3">Prescription</option>
                                                <option value="4">Sugar Chart</option>
                                                <option value="5">Vital</option>
                                            </select>
                                            @if ($errors->has('file_type'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-lg-12">
                                        <div class="input-group">
                                            <label class="text-bold">Upload File <span
                                                    style="color:red">*</span></label>
                                            <input type="file" name="upload_file"
                                                   id="upload_file"
                                                   onchange="uploadFile(this,this.id)"
                                                   class="form-control {{ $errors->has('upload_file') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Upload File" required>
                                            @if ($errors->has('upload_file'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('upload_file') }}</strong>
</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                            </div>
                            <div class="modal-footer clearfix">
                                <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">
                                    Upload
                                </button>
                                <button type="button"
                                        class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                                        data-dismiss="modal">Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('practitioner.patient.partials.models')
        @include('practitioner.patient.partials.pastMedicalHistoryPartial')
        @include('practitioner.patient.partials.pastSurgicalHistoryPartial')
        @include('practitioner.patient.partials.familyMedicalHistoryPartial')
        @include('practitioner.patient.partials.adrPatientVisitPartial')
        @include('practitioner.patient.partials.rxMedicinePartial')
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/vco1c3zzq3bmkufcmoilf5f7mnuv7hxqiqtlfgb910jgpywc/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="{{asset('public/assistant/js/patientVisit.js')}}"></script>
    {{--    <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('public/js/wheelzoom.js') }}"></script>--}}
    {{--    <script src="{{ asset('public/js/image-zoom.js') }}"></script>--}}
    <script src="{{ asset('public/openseadragon/openseadragon.min.js') }}"></script>
    <script>
        function next(id, nId) {
            $('#reportsPopupModal' + id).modal('hide');
            $('#' + nId).modal('show');
        }

        function previous(id, pId) {
            $('#reportsPopupModal' + id).modal('hide');
            $('#' + pId).modal('show');
        }
    </script>
    <script>
        // $(function () {
        //     // Summernote
        //     $('.textarea').summernote({
        //         height: 250
        //     });
        // });
        @foreach($patient->reports as $report)
        @php
            $name = $report->image_url;
            $pi = pathinfo($name);
            $txt = $pi['filename'];
            $ext = $pi['extension'];
        @endphp
        @if ($ext != 'pdf')
        OpenSeadragon({
            id: "image{{$report->id}}",
            prefixUrl: "{{asset('public/openseadragon/images/')}}/",
            tileSources: {
                type: 'image',
                url: '{{asset('storage/app/public/'.$report->image_url)}}'
            }
        });
        @endif
        @endforeach
        tinymce.init({
            selector: '.textarea',
            plugins: 'link lists code visualblocks table hr image template',
            toolbar: 'undo redo | styleselect | bold italic strikethrough backcolor | bullist numlist link image hr | code',
            height: 'calc(70vh - 4rem)',
            setup: function (editor) {

                var val;

                editor.on('focus', function(e) {
                    val = editor.getContent();
                });

                editor.on('blur', function(e) {
                    editor.save();
                    if(val!= editor.getContent()){
                        var visitTemplate = $('#visit_template').val();
                        var patientVisitId = $('#patient_visit_id').val();
                        $.ajax({
                            type: 'POST',
                            url: routes.submitVisitPresciptionTemplateNOte,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'visit_template': visitTemplate,
                                'patient_visit_id': patientVisitId,
                            },
                            success: function (response) {
                                if (response.result == 'success') {
                                    toastr.clear();
                                    window.toastr.success(response.message);
                                }
                                if (response.result == 'error') {
                                    toastr.clear();
                                    window.toastr.error(response.message);
                                }
                            }
                        });
                    }
                });

                editor.on('change', function () {
                    editor.save();
                });

            }
        });

        {{--@foreach($patient->reports as $report)--}}
        {{--wheelzoom(document.querySelector('img.zoom{{$report->id}}'));--}}
        {{--@endforeach--}}
    </script>
    <script>
        var wrapper_pe = $(".total-chq-c-pe"); //Fields wrapper
        var new_input_pe = $(".total-chq-c-pe").html();
        var add_button_pe = $(".add_field_button_pe");

        var HtmlEmlement = '<div class="row">\
            <div class="col-sm-6 col-lg-6">\
            <div class="mb-2">\
            <label class="text-bold">Physical Exams <span style="color:red">*</span></label>\
        <div class="cleafix"></div>\
            <select name="physical_exams[]" data-live-search="true"\
        class="selectpicker physical_exams form-control w-100 {{ $errors->has('physical_exams') ? ' is-invalid' : '' }}"\
        title="Select Physical Exams" required>\
        @if(count($physicalExams)>0)
            @foreach($physicalExams as $physicalExam)
            <option\
            value="{{ $physicalExam->id }}">{{ $physicalExam->title }}</option>\
            @endforeach
            @endif
            </select>\
            @if ($errors->has('physical_exams'))
            <span class="invalid-feedback" role="alert">\
            <strong>{{ $errors->first('physical_exams') }}</strong>\
            </span>\
            @endif
            </div>\
            </div>\
            <div class="col-sm-6 col-lg-6">\
            <div class="input-group">\
            <label class="text-bold">Description</label>\
        <textarea rows="4" name="remarks[]" class="form-control"></textarea>\
            </div>\
            </div>\
            <div class="col-lg-12 mt-3 text-right">\
            <button type="button"\
        class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">\
            Remove\
            </button>\
            </div>\
            </div>';
        $(add_button_pe).click(function (e) { //on add input button click
            $(wrapper_pe).append(HtmlEmlement); //add input box
            $('.physical_exams').selectpicker('refresh');
        });
        $(wrapper_pe).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
        });
    </script>

    <script>
        var wrapper_pmh = $(".total-chq-c-pmh");
        var new_input_pmh = $(".total-chq-c-pmh-partial").html();
        var add_button_pmh = $(".add_field_button_pmh");

        $(add_button_pmh).click(function (e) {
            $(wrapper_pmh).append(new_input_pmh);
            $('.diseases').selectpicker('refresh');
        });
        $(wrapper_pmh).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
        });
    </script>

    <script>
        var wrapper_psh = $(".total-chq-c-psh");
        var new_input_psh = $(".total-chq-c-psh-partial").html();
        var add_button_psh = $(".add_field_button_psh");

        $(add_button_psh).click(function (e) {
            $(wrapper_psh).append(new_input_psh);
            $('.surgeries').selectpicker('refresh');
        });
        $(wrapper_psh).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
        });
    </script>

    <script>
        var wrapper_fmh = $(".total-chq-c-fmh");
        var new_input_fmh = $(".total-chq-c-fmh-partial").html();
        var add_button_fmh = $(".add_field_button_fmh");

        $(add_button_fmh).click(function (e) {
            $(wrapper_fmh).append(new_input_fmh);
            $('.relations').selectpicker('refresh');
            $('.diseases').selectpicker('refresh')
            var nextIndex = parseInt($("#next_deceased_index").val());
            $("#next_deceased_index").val(nextIndex + 1)

            $("#family_medical_histories_form_model").find('select[name ="relations[]"]').attr('name', 'relations[' + nextIndex + ']')
            $("#family_medical_histories_form_model").find('select[name ="diseases[]"]').attr('name', 'diseases[' + nextIndex + ']')
            $("#family_medical_histories_form_model").find('input[name ="no_of_years[]"]').attr('name', 'no_of_years[' + nextIndex + ']')
            $("#family_medical_histories_form_model").find('input[name ="year[]"]').attr('name', 'year[' + nextIndex + ']')
            $("#family_medical_histories_form_model").find('input[name ="deceased_status[]"]').attr('name', 'deceased_status[' + nextIndex + ']')
            $("#family_medical_histories_form_model").find('textarea[name ="remarks[]"]').attr('name', 'remarks[' + nextIndex + ']')
        });
        $(wrapper_fmh).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            // $(this).parents().eq(1).remove();
        });
    </script>

    <script>
        var wrapper_adr = $(".total-chq-c-adr"); //Fields wrapper
        var new_input_adr = $(".total-chq-c-adr-partial").html();
        var add_button_adr = $(".add_field_button_adr");
        $(add_button_adr).click(function (e) { //on add input button click
            $(wrapper_adr).append(new_input_adr); //add input box
            var adrPrevious = $('.adr_previous_count').val();
            var indexVal = parseInt(adrPrevious);
            var adrPreviousCount = parseInt(adrPrevious) + 1;
            var adrNewValue = $('.adr_previous_count').val(adrPreviousCount);
            $('.drugs').removeClass('drugs').addClass('drugs' + adrPreviousCount);
            $('.reactions').removeClass('reactions').addClass('reactions' + adrPreviousCount);
            $("#modaladr_form_post").find('.drugs' + adrPreviousCount).attr('name', 'drugs[' + indexVal + ']')
            $("#modaladr_form_post").find('.reactions' + adrPreviousCount).attr('name', 'reactions[' + indexVal + '][]')

            $('.drugs').selectpicker('refresh');
            $('.drugs' + adrPreviousCount).selectpicker('refresh');
            $('.reactions').selectpicker('refresh');
            $('.reactions' + adrPreviousCount).selectpicker('refresh');
        });
        $(wrapper_adr).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
        });
    </script>

    <script>
        var wrapper_rxm = $(".total-chq-c-rxm");
        var new_input_rxm = $(".total-chq-c-rxm-partial").html();
        var add_button_rxm = $(".add_field_button_rxm");

        $(add_button_rxm).click(function (e) {
            var rxMedicinePrevious = $('.rx_medicine_previous_count').val();
            var rxMedicinePreviousCount = parseInt(rxMedicinePrevious) + 1;
            var rxMedicineNewValue = $('.rx_medicine_previous_count').val(rxMedicinePreviousCount);

            $(wrapper_rxm).append(new_input_rxm);
            $('.medicines').removeClass('medicines').addClass('medicines' + rxMedicinePreviousCount);
            $('.doses').removeClass('doses').addClass('doses' + rxMedicinePreviousCount);
            $('.units').removeClass('units').addClass('units' + rxMedicinePreviousCount);
            $('.frequencies').removeClass('frequencies').addClass('frequencies' + rxMedicinePreviousCount);
            $('.durations').removeClass('durations').addClass('durations' + rxMedicinePreviousCount);
            $('.diagnosis_types').removeClass('diagnosis_types').addClass('diagnosis_types' + rxMedicinePreviousCount);

            $('.medicines').selectpicker('refresh');
            $('.medicines' + rxMedicinePreviousCount).selectpicker('refresh');
            $('.doses').selectpicker('refresh');
            $('.doses' + rxMedicinePreviousCount).selectpicker('refresh');
            $('.units').selectpicker('refresh');
            $('.units' + rxMedicinePreviousCount).selectpicker('refresh');
            $('.frequencies').selectpicker('refresh');
            $('.frequencies' + rxMedicinePreviousCount).selectpicker('refresh');
            $('.durations').selectpicker('refresh');
            $('.durations' + rxMedicinePreviousCount).selectpicker('refresh');
            $('.diagnosis_types').selectpicker('refresh');
            $('.diagnosis_types' + rxMedicinePreviousCount).selectpicker('refresh');
        });
        $(wrapper_rxm).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
        });
    </script>

    <script>
        function changeMedicine(medicineClass) {
            var medicineID = medicineClass.val();
            var medicineClasses = medicineClass.parent().get(0).className;
            var specificMedicineClass = medicineClasses.split(' ')[4];
            var medicineClassFinal = specificMedicineClass.replace(/[^\d.]/g, '');
            var medicineClassFinalInt = parseInt(medicineClassFinal);
            if (isNaN(medicineClassFinalInt)) {
                var count = "";
            } else {
                var count = medicineClassFinalInt;
            }

            $.ajax({
                type: 'POST',
                url: routes.getRXMedicineFieldsValues,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'medicine_id': medicineID,
                },
                success: function (response) {
                    if (response.result == 'success') {
                        var doseID = response.medicine.dose_id;
                        var dose = response.medicine.dose;
                        var unitID = response.medicine.unit_id;
                        var unit = response.medicine.unit;
                        var frequencyID = response.medicine.frequency_id;
                        var frequency = response.medicine.frequency;
                        var durationID = response.medicine.duration_id;
                        var duration = response.medicine.duration;
                        var diagnosisTypeID = response.medicine.diagnosis_type_id;
                        var diagnosisType = response.medicine.diagnosis_type;

                        $("div.doses" + count + " option[value=" + doseID + "]").prop("selected", true);
                        $("div.doses" + count + " .filter-option-inner-inner").text(dose);
                        $("div.units" + count + " option[value=" + unitID + "]").prop("selected", true);
                        $("div.units" + count + " .filter-option-inner-inner").text(unit);
                        $("div.frequencies" + count + " option[value=" + frequencyID + "]").prop("selected", true);
                        $("div.frequencies" + count + " .filter-option-inner-inner").text(frequency);
                        $("div.durations" + count + " option[value=" + durationID + "]").prop("selected", true);
                        $("div.durations" + count + " .filter-option-inner-inner").text(duration);
                        $("div.diagnosis_types" + count + " option[value=" + diagnosisTypeID + "]").prop("selected", true);
                        $("div.diagnosis_types" + count + " .filter-option-inner-inner").text(diagnosisType);
                    }
                    if (response.result == 'error') {
                        window.toastr.error(response.message);
                    }
                }
            });
        }


    </script>

    <script>
        $(document).ready(function () {
            setInterval(checkPatientStatus, 5000);
        });

        function checkPatientStatus() {
            $.ajax({
                method: "GET",
                url: "{{url('assistant/checkPatientStatus')}}",
                success: function (response) {
                    if (response.status == 0) {
                        alert(response.message);
                        return false;
                    }
                    if (response.status == 1) {
                        response.appointments.forEach(function (item) {
                            if (parseInt(item.check_in) == 1 && parseInt(item.appointment_complete) == 0) {
                                $('#offline' + parseInt(item.id)).hide();
                                $('#online' + parseInt(item.id)).show();
                                $('#complete' + parseInt(item.id)).hide();
                            } else if (parseInt(item.check_in) == 0 && parseInt(item.appointment_complete) == 0) {
                                $('#online' + parseInt(item.id)).hide();
                                $('#offline' + parseInt(item.id)).show();
                                $('#complete' + parseInt(item.id)).hide();
                            } else if (parseInt(item.check_in) == 1 && parseInt(item.appointment_complete) == 1) {
                                $('#online' + parseInt(item.id)).hide();
                                $('#offline' + parseInt(item.id)).hide();
                                $('#complete' + parseInt(item.id)).show();
                            }
                        });
                    }

                }
            });
        }
    </script>

@endsection

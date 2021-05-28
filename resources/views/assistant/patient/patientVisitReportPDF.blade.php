<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/admin/dist/img/favicon-32x32.png') }}">
    <style type="text/css">

        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        header {
            border-bottom: solid #000;
        }

        .container {
            max-width: 1100px;
            width: 100%;
            margin: auto;
            padding: 0 15px;
        }

        .col-lg-6 {
            width: 50%;
            float: left;
            box-sizing: border-box;
        }

        .col-lg-4 {
            width: 33%;
            float: left;
            box-sizing: border-box;
        }

        h2,
        h3,
        h4 {
            margin: 0 0 10px;
        }

        p {
            margin: 0 0 10px;
        }

        .mt-31 {
            margin-top: 31px;
        }

        .number {
            border: solid 1px #000;
            text-align: center;
            font-size: 20px;
            padding: 0 31px;
            float: right;
            margin-right: -40px;
        }

        .three-col .align-left {
            display: inline-block;
            margin: 0 37px 0 0px;
            vertical-align: top;
        }

        .weight-list {
            width: 1000px;
        }

        .weight-list span {
            margin: 0 12px 0 0px;
        }

        .weight-list span b {
            margin: 0 7px 0 0px;
        }

        .table th {
            font-size: 13px;
        }

        .table td,
        .table th {
            padding: .35rem;
            vertical-align: middle;
            text-align: left;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05);
        }

        table {
            border: solid 1px rgba(0, 0, 0, .05);
            border-collapse: collapse;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .signature {
            max-width: 300px;
            text-align: center;
            width: 100%;
        }

        .signature p {
            border-top: solid 1px #000;
            padding-top: 10px;
        }

        .text-center {
            text-align: center;
        }

        .back-btn-custom {
            background: blue;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            margin-top: 10px;
            text-decoration: none;
        }

        .fill-bg {
            background: rgb(193, 193, 193);
        }

        /* .new-table-report table {
            width: 10% !important;
            border:solid  10px red;
            max-width: 20px !important;
            box-sizing: border-box;
        } */

        .new-table-report table {
            width: 183pt !important;
        }

        .new-table-report table td {
            overflow: hidden;
            word-wrap: break-word;
            width: 133px !important;
        }

        /* .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        } */
        .page_break {
            page-break-before: always;
        }
        @media (max-width: 600px) {

            /* .col-lg-6,
            .col-lg-4 {
                width: 100%;
            } */
            .weight-list {
                margin: 18px 0 0 0;
            }

            .weight-list span {
                line-height: 29px;
            }

            .number {
                padding: 0 12px;
            }

            .mobile-text-center {
                text-align: center;
            }
        }

        @media print {
            .back-btn-custom {
                display: none;
            }
        }

    </style>
</head>

<body>

<header class="container" style="overflow: hidden;height: 151px;
    padding: 0 0 20px 0;">
    <img src="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->prescription_pad_header_image)}}" alt="wilcare" style="margin: 30px 0 20px; width: 100%; height: 100%;">
</header>

<div class="container">
{{--    <div class="Prof" style="width: 300px;--}}
{{--        float: left; margin-top:100px;">--}}
{{--        @if(isset($practitioner->name))--}}
{{--            <h1>{{ $practitioner->name }}</h1>--}}
{{--        @endif--}}
{{--        @if(isset($practitioner->qualification->title))--}}
{{--            <h4>{{ $practitioner->qualification->title }}</h4>--}}
{{--        @endif--}}
{{--        @if(isset($practitioner->description))--}}
{{--            <h4>{{ $practitioner->description }}</h4>--}}
{{--        @endif--}}
{{--        @if(isset($practitioner->phone))--}}
{{--            <h4>Phone: {{ $practitioner->phone }}</h4>--}}
{{--        @endif--}}
{{--        @if(isset($practitioner->address))--}}
{{--            <h4>Address: {{ $practitioner->address }}</h4>--}}
{{--        @endif--}}

{{--        <br>--}}
{{--        <div class="three-col">--}}
{{--            @if(count($patientPastMedicalHistories) > 0)--}}
{{--                <div class="PMHx align-left">--}}
{{--                    <h3>PMHx</h3>--}}
{{--                    @foreach($patientPastMedicalHistories as $patientPastMedicalHistory)--}}
{{--                        <p>{{ $patientPastMedicalHistory->disease_name }}</p>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="Yrs align-left">--}}
{{--                    <h3>Yrs</h3>--}}
{{--                    @foreach($patientPastMedicalHistories as $patientPastMedicalHistory)--}}
{{--                        @if(isset($patientPastMedicalHistory->year))--}}
{{--                            <p>{{ $patientPastMedicalHistory->year }}</p>--}}
{{--                        @elseif(isset($patientPastMedicalHistory->no_of_years))--}}
{{--                            <p>{{ $patientPastMedicalHistory->no_of_years }}</p>--}}
{{--                        @else--}}
{{--                            <p> -- </p>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            @if(count($patientAdrs) > 0)--}}
{{--                <div class="ADR align-left">--}}
{{--                    <h3>ADR</h3>--}}
{{--                    @foreach($patientAdrs as $patientAdr)--}}
{{--                        <p>{{ $patientAdr->drug_name }}</p>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}

{{--    </div>--}}

    <div style="width: 300px;
        float: left; margin-top:31px; margin-left:350px;">
        <p>
            @if(isset($patient->name))
                <b style="font-size: 20px">Patient Name:{{ $patient->name }}</b>
            @endif

{{--            @if(isset($patientVisit->visit_number))--}}
{{--                <span class="number">{{ $patientVisit->visit_number }}</span>--}}
{{--            @endif--}}
        </p>

        @if(isset($patient->age) && isset($patient->gender))
            <p><b>Age / Sex:</b> {{ $patient->age }} Years @if($patient->gender == 1)
                    Male @elseif($patient->gender == 2) Female @elseif($patient->gender == 3) Other @endif </p>
        @endif

        @if(isset($patientVisit->created_at))
            <p><b>Visit Date:</b> {{ date('d-M-Y', strtotime($patientVisit->created_at)) }} </p>
        @endif

        @if(isset($patient->address))
            <p><b>Address:</b> {{ $patient->address }}</p>
        @endif

    </div>
    <div style="clear: both;"></div>
</div>
<br><br>

<div style="clear: both;"></div>
<div class="container">
    <div style="margin-top:430px;">
        @if(isset($patientVitals))
            @if(isset($patientVitals->weight_kgs) || isset($patientVitals->weight_lbs) || isset($patientVitals->height_ft) || isset($patientVitals->height_in) || isset($patientVitals->height_cms) || isset($patientVitals->bmi) || isset($patientVitals->bsf)|| isset($patientVitals->bsr) || isset($patientVitals->bp_sys) || isset($patientVitals->bp_dias) || isset($patientVitals->pulse))
                <div class="weight-list">
                    <span><b>Vitals:</b></span>
                    @if(isset($patientVitals->weight_kgs) || isset($patientVitals->weight_lbs))
                        @if(isset($patientVitals->weight_kgs))
                            <span><b>Weight</b> {{ $patientVitals->weight_kgs }} Kgs </span>
                        @else
                            <span><b>Weight</b> {{ $patientVitals->weight_lbs }} Lbs </span>
                        @endif
                    @endif

                    @if(isset($patientVitals->height_ft) || isset($patientVitals->height_in) || isset($patientVitals->height_cms))
                        @if(isset($patientVitals->height_ft) || isset($patientVitals->height_in))
                            <span><b>Height</b> {{ $patientVitals->height_ft }} Feet {{ $patientVitals->height_in }}  Inches</span>
                        @else
                            <span><b>Height</b> {{ $patientVitals->height_cms }} CMs </span>
                        @endif
                    @endif

                    @if(isset($patientVitals->bmi))
                        <span><b>BMI</b> {{ $patientVitals->bmi }} </span>
                    @endif

                    @if(isset($patientVitals->bsf))
                        <span><b>BSF</b> {{ $patientVitals->bsf }} </span>
                    @endif

                    @if(isset($patientVitals->bsr))
                        <span><b>BSR</b> {{ $patientVitals->bsr }} </span>
                    @endif

                    @if(isset($patientVitals->bp_sys) && isset($patientVitals->bp_dias))
                        <span><b>SBP/DBP</b> {{ $patientVitals->bp_sys }}/{{ $patientVitals->bp_dias }} mmHg</span>
                    @endif

                    @if(isset($patientVitals->pulse))
                        <span><b>Pulse</b> {{ $patientVitals->pulse }} </span>
                    @endif

                </div>
            @endif

            @if(isset($patientVitals->weight_kgs_2) || isset($patientVitals->weight_lbs_2) || isset($patientVitals->height_ft_2) || isset($patientVitals->height_in_2) || isset($patientVitals->height_cms_2) || isset($patientVitals->bmi_2) || isset($patientVitals->bsf_2)|| isset($patientVitals->bsr_2) || isset($patientVitals->bp_sys_2) || isset($patientVitals->bp_dias_2) || isset($patientVitals->pulse_2))
                <div class="weight-list">
                    <span><b>Repeat Vitals:</b></span>
                    @if(isset($patientVitals->weight_kgs_2) || isset($patientVitals->weight_lbs_2))
                        @if(isset($patientVitals->weight_kgs_2))
                            <span><b>Weight</b> {{ $patientVitals->weight_kgs_2 }} Kgs </span>
                        @else
                            <span><b>Weight</b> {{ $patientVitals->weight_lbs_2 }} Lbs </span>
                        @endif
                    @endif

                    @if(isset($patientVitals->height_ft_2) || isset($patientVitals->height_in_2) || isset($patientVitals->height_cms_2))
                        @if(isset($patientVitals->height_ft_2) || isset($patientVitals->height_in_2))
                            <span><b>Height</b> {{ $patientVitals->height_ft_2 }} Feet {{ $patientVitals->height_in_2 }}  Inches</span>
                        @else
                            <span><b>Height</b> {{ $patientVitals->height_cms_2 }} CMs </span>
                        @endif
                    @endif

                    @if(isset($patientVitals->bmi_2))
                        <span><b>BMI</b> {{ $patientVitals->bmi_2 }} </span>
                    @endif

                    @if(isset($patientVitals->bsf_2))
                        <span><b>BSF</b> {{ $patientVitals->bsf_2 }} </span>
                    @endif

                    @if(isset($patientVitals->bsr_2))
                        <span><b>BSR</b> {{ $patientVitals->bsr_2 }} </span>
                    @endif

                    @if(isset($patientVitals->bp_sys_2) && isset($patientVitals->bp_dias_2))
                        <span><b>SBP/DBP</b> {{ $patientVitals->bp_sys_2 }}/{{ $patientVitals->bp_dias_2 }} mmHg</span>
                    @endif

                    @if(isset($patientVitals->pulse_2))
                        <span><b>Pulse</b> {{ $patientVitals->pulse_2 }} </span>
                    @endif

                </div>
            @endif
        @endif
    </div>
</div>


<div class="container asseement-plan">
    <div style="margin-top:570px;">
        {{-- <h2>ASSESSMENT/PLAN</h2> --}}
        {{-- <p>T2DM BSF 110-160, RBS 180-200, A1C 8.4%(&#60 7.0%), Creat. o.63, Uric acid 6.09 </p> <br> --}}
        {{-- @if($patientRXMedicines)
        <table class="table table-striped" style="width: 100%;">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Medicine</th>
                    <th>Instructions</th>
                </tr>
            </thead>
            <tbody>
                @php $count = 1; @endphp
                @foreach($patientRXMedicines as $medicine)
                <tr>
                    <td>{{ $count }}</td>
                    @if(isset($medicine->medicine_name) || isset($medicine->dose_name) || isset($medicine->unit_name))
                        <td>@if(isset($medicine->medicine_name)) <b>{{ $medicine->medicine_name }}</b>@endif @if(isset($medicine->dose_name)) {{ $medicine->dose_name }} @endif @if(isset($medicine->unit_name)){{ $medicine->unit_name }}@endif</td>
                    @endif

                    @if(isset($medicine->frequency_name) || isset($medicine->duration_name))
                        <td> @if(isset($medicine->frequency_name)) {{ $medicine->frequency_name }} @endif @if(isset($medicine->duration_name)) ({{ $medicine->duration_name }}) @endif </td>
                    @endif
                </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
        </table>
        @endif --}}

        @if(isset($patientVisitPrescription))
            <div class="new-table-report" style="width: 100%;">
                {!! $patientVisitPrescription->prescription !!}
            </div>
        @endif

        <br><br>
        @if(isset($patientVisit->notes_printed))
            <h3>NOTES</h3>
            <p>{{ $patientVisit->notes_printed }} </p>
            <br>
        @endif

        @if(count($patientLabTests) > 0)
            <h3>LABORATORY TESTS</h3>
            @foreach($patientLabTests as $patientLabTest)
                <p>@if(isset($patientLabTest->lab_test_name)) {{ $patientLabTest->lab_test_name }} @endif @if(isset($patientLabTest->instructions) && $patientLabTest->instructions != null)
                        ({{ $patientLabTest->instructions }}) @endif</p>
            @endforeach
        @endif

        @if(count($patientReferPractitioners) > 0)
            <h3>Referal Practitioners</h3>
            @foreach($patientReferPractitioners as $patientReferPractitioner)
                <p>@if(isset($patientReferPractitioner->referral_practitioner_name)) {{ $patientReferPractitioner->referral_practitioner_name }} @endif </p>
            @endforeach
        @endif

        <br>
        @if(isset($patientVisit->next_visit) || isset($patientVisit->next_visit_date))
            <h3>FOLLOW UP INSTRUCTIONS</h3>
            <P>Follow up visit
                after @if(isset($patientVisit->next_visit)) {{ $patientVisit->next_visit }}. Call 0304-111-0336 for Appointments. @endif
{{--                @endif @if(isset($patientVisit->next_visit_date))--}}
{{--                    ({{ date('d-M-Y', strtotime($patientVisit->next_visit_date)) }}) @endif--}}
            </p>
            <br>
        @endif

        @if($practitioner->prescription_pad_other_image != null && Storage::exists($practitioner->prescription_pad_other_image))
            <div class="signature">
                <img style="width:154px;"
                     src="{{ asset('storage/app/public/'.$practitioner->prescription_pad_other_image) }}"
                     alt="Practitioner Signature">
                @if(isset($practitioner->name))
                    <p>{{ $practitioner->name }}</p>
                @endif
            </div>
        @endif
    </div>
</div>

<br>
<br>
@if(isset($patientSugarChart))
    @if((int)$patientSugarChart->day_1_before_breakfast != 0 || (int)$patientSugarChart->day_1_2_hours_after_breakfast != 0 || (int)$patientSugarChart->day_1_before_lunch != 0 || (int)$patientSugarChart->day_1_2_hours_after_lunch != 0 || (int)$patientSugarChart->day_1_before_dinner != 0 || (int)$patientSugarChart->day_1_2_hours_after_dinner != 0 || (int)$patientSugarChart->day_1_bed_time != 0 || (int)$patientSugarChart->day_1_at_3_am != 0 || (int)$patientSugarChart->day_2_before_breakfast != 0 || (int)$patientSugarChart->day_2_2_hours_after_breakfast != 0 || (int)$patientSugarChart->day_2_before_lunch != 0 || (int)$patientSugarChart->day_2_2_hours_after_lunch != 0 || (int)$patientSugarChart->day_2_before_dinner != 0 || (int)$patientSugarChart->day_2_2_hours_after_dinner != 0 || (int)$patientSugarChart->day_2_bed_time != 0 || (int)$patientSugarChart->day_2_at_3_am != 0 || (int)$patientSugarChart->day_3_before_breakfast != 0 || (int)$patientSugarChart->day_3_2_hours_after_breakfast != 0 || (int)$patientSugarChart->day_3_before_lunch != 0 || (int)$patientSugarChart->day_3_2_hours_after_lunch != 0 || (int)$patientSugarChart->day_3_before_dinner != 0 || (int)$patientSugarChart->day_3_2_hours_after_dinner != 0 || (int)$patientSugarChart->day_3_bed_time != 0 || (int)$patientSugarChart->day_3_at_3_am != 0 || (int)$patientSugarChart->day_4_before_breakfast != 0 || (int)$patientSugarChart->day_4_2_hours_after_breakfast != 0 || (int)$patientSugarChart->day_4_before_lunch != 0 || (int)$patientSugarChart->day_4_2_hours_after_lunch != 0 || (int)$patientSugarChart->day_4_before_dinner != 0 || (int)$patientSugarChart->day_4_2_hours_after_dinner != 0 || (int)$patientSugarChart->day_4_bed_time != 0 || (int)$patientSugarChart->day_4_at_3_am != 0 || (int)$patientSugarChart->day_5_before_breakfast != 0 || (int)$patientSugarChart->day_5_2_hours_after_breakfast != 0 || (int)$patientSugarChart->day_5_before_lunch != 0 || (int)$patientSugarChart->day_5_2_hours_after_lunch != 0 || (int)$patientSugarChart->day_5_before_dinner != 0 || (int)$patientSugarChart->day_5_2_hours_after_dinner != 0 || (int)$patientSugarChart->day_5_bed_time != 0 || (int)$patientSugarChart->day_5_at_3_am != 0 || (int)$patientSugarChart->day_6_before_breakfast != 0 || (int)$patientSugarChart->day_6_2_hours_after_breakfast != 0 || (int)$patientSugarChart->day_6_before_lunch != 0 || (int)$patientSugarChart->day_6_2_hours_after_lunch != 0 || (int)$patientSugarChart->day_6_before_dinner != 0 || (int)$patientSugarChart->day_6_2_hours_after_dinner != 0 || (int)$patientSugarChart->day_6_bed_time != 0 || (int)$patientSugarChart->day_6_at_3_am != 0 || (int)$patientSugarChart->day_7_before_breakfast != 0 || (int)$patientSugarChart->day_7_2_hours_after_breakfast != 0 || (int)$patientSugarChart->day_7_before_lunch != 0 || (int)$patientSugarChart->day_7_2_hours_after_lunch != 0 || (int)$patientSugarChart->day_7_before_dinner != 0 || (int)$patientSugarChart->day_7_2_hours_after_dinner != 0 || (int)$patientSugarChart->day_7_bed_time != 0 || (int)$patientSugarChart->day_7_at_3_am != 0)
        <header class="container page_break" style="overflow: hidden;height: 151px;
    padding: 0 0 20px 0;">
            <img src="{{asset('storage/app/public/'.Auth::guard('practitioner')->user()->prescription_pad_header_image)}}" alt="wilcare" style="margin: 30px 0 20px; width: 100%; height: 100%;">
        </header>
        <div class="container">
            <div style="width: 300px; margin-top:31px;">
                <p>
                    @if(isset($patient->name))
                        <b style="font-size: 20px">Patient Name:{{ $patient->name }}</b>
                    @endif

                    {{--            @if(isset($patientVisit->visit_number))--}}
                    {{--                <span class="number">{{ $patientVisit->visit_number }}</span>--}}
                    {{--            @endif--}}
                </p>

                @if(isset($patient->age) && isset($patient->gender))
                    <p><b>Age / Sex:</b> {{ $patient->age }} Years @if($patient->gender == 1)
                            Male @elseif($patient->gender == 2) Female @elseif($patient->gender == 3) Other @endif </p>
                @endif

                @if(isset($patientVisit->created_at))
                    <p><b>Visit Date:</b> {{ date('d-M-Y', strtotime($patientVisit->created_at)) }} </p>
                @endif

                @if(isset($patient->address))
                    <p><b>Address:</b> {{ $patient->address }}</p>
                @endif

            </div>
            <div style="clear: both;"></div>
            <div style="">
                @if(isset($patientVitals))
                    @if(isset($patientVitals->weight_kgs) || isset($patientVitals->weight_lbs) || isset($patientVitals->height_ft) || isset($patientVitals->height_in) || isset($patientVitals->height_cms) || isset($patientVitals->bmi) || isset($patientVitals->bsf)|| isset($patientVitals->bsr) || isset($patientVitals->bp_sys) || isset($patientVitals->bp_dias) || isset($patientVitals->pulse))
                        <div class="weight-list">
                            <span><b>Vitals:</b></span>
                            @if(isset($patientVitals->weight_kgs) || isset($patientVitals->weight_lbs))
                                @if(isset($patientVitals->weight_kgs))
                                    <span><b>Weight</b> {{ $patientVitals->weight_kgs }} Kgs </span>
                                @else
                                    <span><b>Weight</b> {{ $patientVitals->weight_lbs }} Lbs </span>
                                @endif
                            @endif

                            @if(isset($patientVitals->height_ft) || isset($patientVitals->height_in) || isset($patientVitals->height_cms))
                                @if(isset($patientVitals->height_ft) || isset($patientVitals->height_in))
                                    <span><b>Height</b> {{ $patientVitals->height_ft }} Feet {{ $patientVitals->height_in }}  Inches</span>
                                @else
                                    <span><b>Height</b> {{ $patientVitals->height_cms }} CMs </span>
                                @endif
                            @endif

                            @if(isset($patientVitals->bmi))
                                <span><b>BMI</b> {{ $patientVitals->bmi }} </span>
                            @endif

                            @if(isset($patientVitals->bsf))
                                <span><b>BSF</b> {{ $patientVitals->bsf }} </span>
                            @endif

                            @if(isset($patientVitals->bsr))
                                <span><b>BSR</b> {{ $patientVitals->bsr }} </span>
                            @endif

                            @if(isset($patientVitals->bp_sys) && isset($patientVitals->bp_dias))
                                <span><b>SBP/DBP</b> {{ $patientVitals->bp_sys }}/{{ $patientVitals->bp_dias }} mmHg</span>
                            @endif

                            @if(isset($patientVitals->pulse))
                                <span><b>Pulse</b> {{ $patientVitals->pulse }} </span>
                            @endif

                        </div>
                    @endif

                    @if(isset($patientVitals->weight_kgs_2) || isset($patientVitals->weight_lbs_2) || isset($patientVitals->height_ft_2) || isset($patientVitals->height_in_2) || isset($patientVitals->height_cms_2) || isset($patientVitals->bmi_2) || isset($patientVitals->bsf_2)|| isset($patientVitals->bsr_2) || isset($patientVitals->bp_sys_2) || isset($patientVitals->bp_dias_2) || isset($patientVitals->pulse_2))
                        <div class="weight-list">
                            <span><b>Repeat Vitals:</b></span>
                            @if(isset($patientVitals->weight_kgs_2) || isset($patientVitals->weight_lbs_2))
                                @if(isset($patientVitals->weight_kgs_2))
                                    <span><b>Weight</b> {{ $patientVitals->weight_kgs_2 }} Kgs </span>
                                @else
                                    <span><b>Weight</b> {{ $patientVitals->weight_lbs_2 }} Lbs </span>
                                @endif
                            @endif

                            @if(isset($patientVitals->height_ft_2) || isset($patientVitals->height_in_2) || isset($patientVitals->height_cms_2))
                                @if(isset($patientVitals->height_ft_2) || isset($patientVitals->height_in_2))
                                    <span><b>Height</b> {{ $patientVitals->height_ft_2 }} Feet {{ $patientVitals->height_in_2 }}  Inches</span>
                                @else
                                    <span><b>Height</b> {{ $patientVitals->height_cms_2 }} CMs </span>
                                @endif
                            @endif

                            @if(isset($patientVitals->bmi_2))
                                <span><b>BMI</b> {{ $patientVitals->bmi_2 }} </span>
                            @endif

                            @if(isset($patientVitals->bsf_2))
                                <span><b>BSF</b> {{ $patientVitals->bsf_2 }} </span>
                            @endif

                            @if(isset($patientVitals->bsr_2))
                                <span><b>BSR</b> {{ $patientVitals->bsr_2 }} </span>
                            @endif

                            @if(isset($patientVitals->bp_sys_2) && isset($patientVitals->bp_dias_2))
                                <span><b>SBP/DBP</b> {{ $patientVitals->bp_sys_2 }}/{{ $patientVitals->bp_dias_2 }} mmHg</span>
                            @endif

                            @if(isset($patientVitals->pulse_2))
                                <span><b>Pulse</b> {{ $patientVitals->pulse_2 }} </span>
                            @endif

                        </div>
                    @endif
                @endif
            </div>
            <div class="table-responsive" style="margin-top: 30px;display: block;width: 100%;overflow-x: auto;">
                <table width="100%" class="table table-bordered" style="width:100%;">
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
                        <td>Before Breakfast</td>
                        <td @if($patientSugarChart->day_1_before_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_before_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_before_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_before_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_before_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_before_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_before_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_before_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_before_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_before_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_before_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_before_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_before_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_before_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    <tr>
                        <td>2 Hours after Breakfast</td>
                        <td @if($patientSugarChart->day_1_2_hours_after_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_2_hours_after_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_2_hours_after_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_2_hours_after_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_2_hours_after_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_2_hours_after_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_2_hours_after_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_2_hours_after_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_2_hours_after_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_2_hours_after_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_2_hours_after_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_2_hours_after_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_2_hours_after_breakfast == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_2_hours_after_breakfast == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Before Lunch</td>
                        <td @if($patientSugarChart->day_1_before_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_before_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_before_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_before_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_before_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_before_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_before_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_before_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_before_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_before_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_before_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_before_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_before_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_before_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    <tr>
                        <td>2 Hours after Lunch</td>
                        <td @if($patientSugarChart->day_1_2_hours_after_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_2_hours_after_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_2_hours_after_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_2_hours_after_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_2_hours_after_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_2_hours_after_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_2_hours_after_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_2_hours_after_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_2_hours_after_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_2_hours_after_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_2_hours_after_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_2_hours_after_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_2_hours_after_lunch == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_2_hours_after_lunch == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Before Dinner</td>
                        <td @if($patientSugarChart->day_1_before_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_before_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_before_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_before_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_before_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_before_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_before_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_before_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_before_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_before_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_before_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_before_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_before_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_before_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    <tr>
                        <td>2 Hours after Dinner</td>
                        <td @if($patientSugarChart->day_1_2_hours_after_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_2_hours_after_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_2_hours_after_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_2_hours_after_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_2_hours_after_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_2_hours_after_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_2_hours_after_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_2_hours_after_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_2_hours_after_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_2_hours_after_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_2_hours_after_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_2_hours_after_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_2_hours_after_dinner == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_2_hours_after_dinner == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    <tr>
                        <td>At Bedtime</td>
                        <td @if($patientSugarChart->day_1_bed_time == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_bed_time == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_bed_time == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_bed_time == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_bed_time == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_bed_time == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_bed_time == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_bed_time == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_bed_time == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_bed_time == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_bed_time == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_bed_time == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_bed_time == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_bed_time == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    <tr>
                        <td>At 3:00 AM</td>
                        <td @if($patientSugarChart->day_1_at_3_am == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_1_at_3_am == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_2_at_3_am == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_2_at_3_am == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_3_at_3_am == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_3_at_3_am == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_4_at_3_am == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_4_at_3_am == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_5_at_3_am == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_5_at_3_am == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_6_at_3_am == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_6_at_3_am == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                        <td @if($patientSugarChart->day_7_at_3_am == 1) class="fill-bg" @endif>
                            <div @if($patientSugarChart->day_7_at_3_am == 1) class="fill-bg"
                                 style="height:20px;" @endif></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endif

<br><br>
<footer class="container">
    <div style="margin-top:850px; font-size:12px;">
        <div class="col-lg-4 mobile-text-center">
            <p> Print Date &amp; Time: {{ date('jS M Y H:i:s') }}</p>
        </div>

        {{-- <div class="col-lg-4 text-center">
            <p>Powered By Infinit Connections</p>
        </div> --}}

        @if(isset($practitioner->name))
            <div class="col-lg-4 text-center">
                <p>{{ $practitioner->name }}</p>
            </div>
        @endif
    </div>
</footer>

</body>

</html>

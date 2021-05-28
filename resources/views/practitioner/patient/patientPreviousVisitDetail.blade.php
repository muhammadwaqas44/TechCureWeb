@extends('layouts.practitioner')

@section('main-content')
     <div class="content-wrapper mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content ml-3 mr-3">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <a href="{{ route('practitionerPatientList') }}" class="btn btn-primary pull-right">Back</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="row">

                                @if(isset($patient))
                                <div class="col-12">
                                    <table class="table table-striped">
                                            <h1 class="ml-2 mt-2 mb-2"> Patient Details</h1>
                                            <tbody>
                                                <tr>
                                                    <td><b>Patient Name</b></td>
                                                    <td>{{ $patient->name }}</td>
                                                </tr>

                                                @if(isset($patient->mr_number))
                                                <tr>
                                                    <td><b>MR #</b></td>
                                                    <td>{{ $patient->mr_number }}</td>
                                                </tr>
                                                @endif

                                                @if(isset($patient->gender))
                                                <tr>
                                                    <td><b>Gender</b></td>
                                                    <td>@if($patient->gender==1) Male @elseif($patient->gender==2) Female @else Other @endif</td>
                                                </tr>
                                                @endif

                                                @if(isset($patient->age))
                                                <tr>
                                                    <td><b>Age (Years)</b></td>
                                                    <td>{{ $patient->age }}</td>
                                                </tr>
                                                @endif

                                                @if(isset($patient->phone))
                                                <tr>
                                                    <td><b>Mobile</b></td>
                                                    <td>{{ $patient->phone }}</td>
                                                </tr>
                                                @endif

                                                @if(isset($patient->address))
                                                <tr>
                                                    <td><b>Address</b></td>
                                                    <td>{{ $patient->address }}</td>
                                                </tr>
                                                @endif

                                                @if(isset($patientVisit->appointment->patientType->title))
                                                <tr>
                                                    <td><b> Patient Type </b></td>
                                                    <td>{{ $patientVisit->appointment->patientType->title }}</td>
                                                </tr>
                                                @endif

                                                <tr>
                                                    @if($patient->time_waste_flag_condition == 1 || $patient->critical_flag_condition == 1)
                                                    <td><b>Patient Flag</b></td>
                                                    <div class="text-right two-flags">
                                                        @if($patient->time_waste_flag_condition == 1)
                                                        <td> <i class="fa fa-flag" aria-hidden="true" style="color:black"></i> </td>
                                                        @elseif($patient->critical_flag_condition == 1)
                                                        <td> <i class="fa fa-flag" aria-hidden="true" style="color:red"></i></td>
                                                        @endif
                                                    </div>

                                                    @else
                                                    <td><b>Patient Flag</b></td>
                                                    <td> -- </td>
                                                    @endif
                                                </tr>

                                            </tbody>
                                    </table>
                                </div>
                                <hr>
                                @endif

                                @if(isset($patientAppointment))
                                <div class="col-12">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                    <h1 class="ml-2 mt-2 mb-2"> Appointment Details</h1>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Appointment Date</b></td>
                                                            <td>{{ date('d-m-Y', strtotime($patientAppointment->date )) }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Appointment Time Slot</b></td>
                                                            <td>{{ $patientAppointment->time_slot }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Type</b></td>
                                                            <td>
                                                                @if($patientAppointment->type == 0)
                                                                    Physical
                                                                @else
                                                                    Online
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Status</b></td>
                                                            <td>
                                                                @if($patientAppointment->status == 0)
                                                                    Pending
                                                                @elseif($patientAppointment->status == 1)           Under Process
                                                                @elseif($patientAppointment->status == 2)           Accepted
                                                                @elseif($patientAppointment->status == 3)           Rejected
                                                                @elseif($patientAppointment->status == 4)           Check In
                                                                @elseif($patientAppointment->status == 5)           Completed
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @if(isset($patientAppointment->payment->payment_status))
                                                        <tr>
                                                            <td><b>Payment Status</b></td>
                                                            <td>
                                                                {{ $patientAppointment->payment->payment_status }}
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientAppointment->payment->date))
                                                        <tr>
                                                            <td><b>Payment Date</b></td>
                                                            <td>
                                                                {{ date('d-m-Y', strtotime($patientAppointment->payment->date)) }}
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientAppointment->payment->amount))
                                                        <tr>
                                                            <td><b>Amount</b></td>
                                                            <td>
                                                                PKR {{ $patientAppointment->payment->amount }}
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientAppointment->payment->payment_method))
                                                        <tr>
                                                            <td><b>Payment Method</b></td>
                                                            <td>
                                                                {{ $patientAppointment->payment->payment_method }}
                                                            </td>
                                                        </tr>
                                                        @endif

                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endif

                                @if(isset($patientVisit))
                                <div class="col-12">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                    <h1 class="ml-2 mt-2 mb-2"> Visit Details</h1>
                                                    <tbody>

                                                        @if(isset($patientVisit->total_duration))
                                                        <tr>
                                                            <td><b>Duration </b></td>
                                                            <td>{{ $patientVisit->total_duration }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVisit->visit_number))
                                                        <tr>
                                                            <td><b>Visit Number </b></td>
                                                            <td>{{ $patientVisit->visit_number }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVisit->notes_internal))
                                                        <tr>
                                                            <td><b>Doctor Notes Internal</b></td>
                                                            <td>{{ $patientVisit->notes_internal }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVisit->notes_printed))
                                                        <tr>
                                                            <td><b>Doctor Notes Printed</b></td>
                                                            <td>{{ $patientVisit->notes_printed }}</td>
                                                        </tr>
                                                        @endif

                                                        <tr>
                                                            <td><b>Revised? </b></td>
                                                            @if($patientVisit->status == 0)
                                                            <td>Not Revised</td>
                                                            @else
                                                            <td>Revised</td>
                                                            @endif
                                                        </tr>

                                                        @if(isset($patientVisit->revise_of))
                                                        <tr>
                                                            <td><b>Revise of</b></td>
                                                            <td>{{ $patientVisit->revise_of }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVisit->next_visit))
                                                        <tr>
                                                            <td><b>Next Visit</b></td>
                                                            <td>{{ $patientVisit->next_visit }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVisit->next_visit_date))
                                                        <tr>
                                                            <td><b>Next Visit Date</b></td>
                                                            <td>{{ date('d-m-Y', strtotime($patientVisit->next_visit_date)) }}</td>
                                                        </tr>
                                                        @endif

                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endif

                                @if(isset($patientVitals))
                                    @if(isset($patientVitals->bp_sys) || isset($patientVitals->bp_dias) || isset($patientVitals->pulse) || isset($patientVitals->weight_lbs) || isset($patientVitals->weight_kgs) || isset($patientVitals->height_ft) || isset($patientVitals->height_in) || isset($patientVitals->height_cms) || isset($patientVitals->bmi) || isset($patientVitals->bsf) || isset($patientVitals->bsr))
                                    <div class="col-6">
                                        <table class="table table-striped">
                                                <h1 class="ml-2 mt-2 mb-2"> Vitals 1</h1>
                                                <tbody>
                                                    @if(isset($patientVitals->bp_sys))
                                                    <tr>
                                                        <td><b>BP (Sys)</b></td>
                                                        <td>{{ $patientVitals->bp_sys }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->bp_dias))
                                                    <tr>
                                                        <td><b>BP (Dias)</b></td>
                                                        <td>{{ $patientVitals->bp_dias }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->pulse))
                                                    <tr>
                                                        <td><b>Pulse</b></td>
                                                        <td>{{ $patientVitals->pulse }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->weight_lbs))
                                                    <tr>
                                                        <td><b>Weight (LBs)</b></td>
                                                        <td>{{ $patientVitals->weight_lbs }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->weight_kgs))
                                                    <tr>
                                                        <td><b>Weight (KGs)</b></td>
                                                        <td>{{ $patientVitals->weight_kgs }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->height_ft))
                                                    <tr>
                                                        <td><b>Height (Ft)</b></td>
                                                        <td>{{ $patientVitals->height_ft }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->height_in))
                                                    <tr>
                                                        <td><b>Height (In)</b></td>
                                                        <td>{{ $patientVitals->height_in }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->height_cms))
                                                    <tr>
                                                        <td><b>Height (CMs)</b></td>
                                                        <td>{{ $patientVitals->height_cms }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->bmi))
                                                    <tr>
                                                        <td><b>BMI</b></td>
                                                        <td>{{ $patientVitals->bmi }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->bsf))
                                                    <tr>
                                                        <td><b>BSF</b></td>
                                                        <td>{{ $patientVitals->bsf }}</td>
                                                    </tr>
                                                    @endif

                                                    @if(isset($patientVitals->bsr))
                                                    <tr>
                                                        <td><b>BSR</b></td>
                                                        <td>{{ $patientVitals->bsr }}</td>
                                                    </tr>
                                                    @endif


                                                </tbody>
                                        </table>
                                    </div>
                                    @endif

                                    @if(isset($patientVitals->bp_sys_2) || isset($patientVitals->bp_dias_2) || isset($patientVitals->pulse_2) || isset($patientVitals->weight_lbs_2) || isset($patientVitals->weight_kgs_2) || isset($patientVitals->height_ft_2) || isset($patientVitals->height_in_2) || isset($patientVitals->height_cms_2) || isset($patientVitals->bmi_2) || isset($patientVitals->bsf_2) || isset($patientVitals->bsr_2))
                                        <div class="col-6">
                                            <table class="table table-striped">
                                                    <h1 class="ml-2 mt-2 mb-2"> Vitals 2</h1>
                                                    <tbody>
                                                        @if(isset($patientVitals->bp_sys_2))
                                                        <tr>
                                                            <td><b>BP (Sys)</b></td>
                                                            <td>{{ $patientVitals->bp_sys_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->bp_dias_2))
                                                        <tr>
                                                            <td><b>BP (Dias)</b></td>
                                                            <td>{{ $patientVitals->bp_dias_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->pulse_2))
                                                        <tr>
                                                            <td><b>Pulse</b></td>
                                                            <td>{{ $patientVitals->pulse_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->weight_lbs_2))
                                                        <tr>
                                                            <td><b>Weight (LBs)</b></td>
                                                            <td>{{ $patientVitals->weight_lbs_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->weight_kgs_2))
                                                        <tr>
                                                            <td><b>Weight (KGs)</b></td>
                                                            <td>{{ $patientVitals->weight_kgs_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->height_ft_2))
                                                        <tr>
                                                            <td><b>Height (Ft)</b></td>
                                                            <td>{{ $patientVitals->height_ft_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->height_in_2))
                                                        <tr>
                                                            <td><b>Height (In)</b></td>
                                                            <td>{{ $patientVitals->height_in_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->height_cms_2))
                                                        <tr>
                                                            <td><b>Height (CMs)</b></td>
                                                            <td>{{ $patientVitals->height_cms_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->bmi_2))
                                                        <tr>
                                                            <td><b>BMI</b></td>
                                                            <td>{{ $patientVitals->bmi_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->bsf_2))
                                                        <tr>
                                                            <td><b>BSF</b></td>
                                                            <td>{{ $patientVitals->bsf_2 }}</td>
                                                        </tr>
                                                        @endif

                                                        @if(isset($patientVitals->bsr_2))
                                                        <tr>
                                                            <td><b>BSR</b></td>
                                                            <td>{{ $patientVitals->bsr_2 }}</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                            </table>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($patientPrescriptions) > 0)
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            @php $count = 1; @endphp
                                @foreach($patientPrescriptions as $patientPrescription)
                                <table class="table table-striped">
                                        <h1 class="ml-2 mt-4 mb-2"> Prescription {{ $count }}</h1>
                                        <tbody>
                                            @if(isset($patientPrescription->prescription))
                                            <tr>
                                                <td>{!! $patientPrescription->prescription !!}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                </table>
                                @php $count++ @endphp
                                @endforeach
                        </div>
                    </div>
                </div>
                <hr>
                @endif

                @if(count($patientReports) > 0)
                <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                        <h1 class="ml-2 mt-2 mb-2"> Attachments </h1>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="row" style="width:100%">
                                                        @foreach($patientReports as $report)
                                                            <div class="item col-xs-2 col-lg-2 target del">
                                                                <div class="thumbnail card mt-2 mb-2">
                                                                    <a class="img-event mt-3 mb-2" style="text-align:center" type="button" data-toggle="modal" data-target="#reportsPopupDetailPage{{$report->id}}">
                                                                        <i class="fa fa-image fa-5x group list-group-image img-fluid"></i>
                                                                    </a>
                                                                    <div style="text-align:center">{{ $report->title }} @if($report->type == 0) (Lab Test) @elseif($report->type == 1) (Invoice) @elseif($report->type == 2) (Other) @endif</div>
                                                                    <div class="mb-2" style="text-align:center"> {{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}} </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <hr>
                @endif

                @if(isset($patientReferTo->referral_practitioner_name))
                <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                        <h1 class="ml-2 mt-2 mb-2">Refer To Practitioner</h1>
                                        <tbody>
                                            <tr>
                                                <td><b>Referral Practitioner Name</b></td>
                                                <td>{{ $patientReferTo->referral_practitioner_name }}</td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <hr>
                @endif

                @if(isset($patientSugarChart))
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                    <h1 class="ml-2 mt-2"> Sugar Chart </h1>
                                    <tbody>
                                        <div class="clearfix suger-chart mt-4">
                                            <div class="table-responsive mt-4">
                                                <table class="table new-table">
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
                                                        <td @if($patientSugarChart->day_1_before_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_before_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_before_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_before_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_before_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_before_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_before_breakfast == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2 Hours after Breakfast</td>
                                                        <td @if($patientSugarChart->day_1_2_hours_after_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_2_hours_after_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_2_hours_after_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_2_hours_after_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_2_hours_after_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_2_hours_after_breakfast == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_2_hours_after_breakfast == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Before Lunch</td>
                                                        <td @if($patientSugarChart->day_1_before_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_before_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_before_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_before_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_before_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_before_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_before_lunch == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2 Hours after Lunch</td>
                                                        <td @if($patientSugarChart->day_1_2_hours_after_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_2_hours_after_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_2_hours_after_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_2_hours_after_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_2_hours_after_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_2_hours_after_lunch == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_2_hours_after_lunch == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Before Dinner</td>
                                                        <td @if($patientSugarChart->day_1_before_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_before_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_before_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_before_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_before_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_before_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_before_dinner == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2 Hours after Dinner</td>
                                                        <td @if($patientSugarChart->day_1_2_hours_after_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_2_hours_after_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_2_hours_after_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_2_hours_after_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_2_hours_after_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_2_hours_after_dinner == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_2_hours_after_dinner == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                    <tr>
                                                        <td>At Bedtime</td>
                                                        <td @if($patientSugarChart->day_1_bed_time == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_bed_time == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_bed_time == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_bed_time == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_bed_time == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_bed_time == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_bed_time == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                    <tr>
                                                        <td>At 3:00 AM</td>
                                                        <td @if($patientSugarChart->day_1_at_3_am == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_2_at_3_am == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_3_at_3_am == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_4_at_3_am == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_5_at_3_am == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_6_at_3_am == 1) class="fill-bg" @endif></td>
                                                        <td @if($patientSugarChart->day_7_at_3_am == 1) class="fill-bg" @endif></td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                @endif

                @if(count($patientPhysicalExaminations) > 0)
                <div class="table-responsive">
                    <div class="row ml-2 mr-2">
                        @php $count = 1; @endphp
                        @foreach($patientPhysicalExaminations as $patientPhysicalExamination)
                        <div class="col-6">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> Physical Examination {{ $count }} </h1>
                                <tbody>
                                    @if(isset($patientPhysicalExamination->physical_exam_name))
                                    <tr>
                                        <td><b> Physical Exam </b></td>
                                        <td>{{ $patientPhysicalExamination->physical_exam_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientPhysicalExamination->description))
                                    <tr>
                                        <td><b> Description </b></td>
                                        <td>{{ $patientPhysicalExamination->description }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @endif

                @if(isset($history->description))
                <div class="table-responsive">
                    <div class="row ml-2 mr-2">
                        <div class="col-12">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> Patient History </h1>
                                <tbody>
                                    <tr>
                                        <td><b> History </b></td>
                                        <td>{!! $history->description !!}</td>
                                    </tr>
                                </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <hr>
                @endif

                @if(count($patientPastMedicalHistories) > 0)
                <div class="table-responsive">
                    <div class="row ml-2 mr-2">
                        @php $count = 1; @endphp
                        @foreach($patientPastMedicalHistories as $patientPastMedicalHistory)
                        <div class="col-6">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> Past Medical History {{ $count }} </h1>
                                <tbody>
                                    @if(isset($patientPastMedicalHistory->disease_name))
                                    <tr>
                                        <td><b> Disease </b></td>
                                        <td>{{ $patientPastMedicalHistory->disease_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientPastMedicalHistory->no_of_years))
                                    <tr>
                                        <td><b> No of Years </b></td>
                                        <td>{{ $patientPastMedicalHistory->no_of_years }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientPastMedicalHistory->year))
                                    <tr>
                                        <td><b> Year </b></td>
                                        <td>{{ $patientPastMedicalHistory->year }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientPastMedicalHistory->remarks))
                                    <tr>
                                        <td><b> Remarks </b></td>
                                        <td>{{ $patientPastMedicalHistory->remarks }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @endif

                @if(count($patientPastSurgicalHistories) > 0)
                <div class="table-responsive">
                    <div class="row  ml-2 mr-2">
                        @php $count = 1; @endphp
                        @foreach($patientPastSurgicalHistories as $patientPastSurgicalHistory)
                        <div class="col-6">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> Past Surgical History {{ $count }} </h1>
                                <tbody>
                                    @if(isset($patientPastSurgicalHistory->surgery_name))
                                    <tr>
                                        <td><b> Surgery </b></td>
                                        <td>{{ $patientPastSurgicalHistory->surgery_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientPastSurgicalHistory->no_of_years))
                                    <tr>
                                        <td><b> No of Years </b></td>
                                        <td>{{ $patientPastSurgicalHistory->no_of_years }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientPastSurgicalHistory->year))
                                    <tr>
                                        <td><b> Year </b></td>
                                        <td>{{ $patientPastSurgicalHistory->year }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientPastSurgicalHistory->remarks))
                                    <tr>
                                        <td><b> Remarks </b></td>
                                        <td>{{ $patientPastSurgicalHistory->remarks }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @endif

                @if(count($patientFamilyMedicalHistories) > 0)
                <div class="table-responsive">
                    <div class="row  ml-2 mr-2">
                        @php $count = 1; @endphp
                        @foreach($patientFamilyMedicalHistories as $patientFamilyMedicalHistory)
                        <div class="col-6">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> Family Medical History {{ $count }} </h1>
                                <tbody>

                                    @if(isset($patientFamilyMedicalHistory->relation_name))
                                    <tr>
                                        <td><b> Relation </b></td>
                                        <td>{{ $patientFamilyMedicalHistory->relation_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientFamilyMedicalHistory->disease_name))
                                    <tr>
                                        <td><b> Disease </b></td>
                                        <td>{{ $patientFamilyMedicalHistory->disease_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientFamilyMedicalHistory->no_of_years))
                                    <tr>
                                        <td><b> No of Years </b></td>
                                        <td>{{ $patientFamilyMedicalHistory->no_of_years }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientFamilyMedicalHistory->year))
                                    <tr>
                                        <td><b> Year </b></td>
                                        <td>{{ $patientFamilyMedicalHistory->year }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientFamilyMedicalHistory->remarks))
                                    <tr>
                                        <td><b> Remarks </b></td>
                                        <td>{{ $patientFamilyMedicalHistory->remarks }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientFamilyMedicalHistory->deceased_status))
                                    <tr>
                                        <td><b> Deceased </b></td>
                                        @if($patientFamilyMedicalHistory->deceased_status == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @endif

                @if(isset($smokingHistory))
                <div class="table-responsive">
                    <div class="row ml-2 mr-2">
                        <div class="col-6">
                            <table class="table table-striped">
                                <h1 class="ml-2 mt-3 mb-2"> Smoking History </h1>
                                <tbody>

                                    @if(isset($smokingHistory->ever_smoke))
                                    <tr>
                                        <td><b> Ever Smoke </b></td>
                                        @if($smokingHistory->ever_smoke == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->still_smoke))
                                    <tr>
                                        <td><b> Still Smoke </b></td>
                                        @if($smokingHistory->still_smoke == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->no_of_years))
                                    <tr>
                                        <td><b> No of Years </b></td>
                                        <td>{{ $smokingHistory->no_of_years }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->cig_per_day))
                                    <tr>
                                        <td><b> Cigarette Per Day </b></td>
                                        <td>{{ $smokingHistory->cig_per_day }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->ever_drink))
                                    <tr>
                                        <td><b> Ever Drink </b></td>
                                        @if($smokingHistory->ever_drink == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->still_drink))
                                    <tr>
                                        <td><b> Still Drink </b></td>
                                        @if($smokingHistory->still_drink == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->drink_remarks))
                                    <tr>
                                        <td><b> Drink Remarks </b></td>
                                        <td>{{ $smokingHistory->drink_remarks }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="col-6" style="margin-top:50px;">
                            <table class="table table-striped">
                                <tbody>

                                    @if(isset($smokingHistory->ever_use_drugs))
                                    <tr>
                                        <td><b> Ever Use Drugs </b></td>
                                        @if($smokingHistory->ever_use_drugs == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->still_use_drugs))
                                    <tr>
                                        <td><b> Still Use Drugs </b></td>
                                        @if($smokingHistory->still_use_drugs == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->what_drug_use))
                                    <tr>
                                        <td><b> What Drugs do you use? </b></td>
                                        <td>{{ $smokingHistory->what_drug_use }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($smokingHistory->how_use_drug))
                                    <tr>
                                        <td><b> How do you use the Drugs? </b></td>
                                        <td>{{ $smokingHistory->how_use_drug }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                @endif

                @if(isset($ros->first_description) || isset($ros->second_description) || isset($ros->third_description))
                <div class="table-responsive">
                    <div class="row ml-2 mr-2">
                        <div class="col-12">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> Review on System </h1>
                                <tbody>
                                    @if(isset($ros->first_description))
                                    <tr>
                                        <td><b> First Description  </b></td>
                                        <td>{{ $ros->first_description }}</td>
                                    </tr>
                                    @endif
                                    @if(isset($ros->second_description))
                                    <tr>
                                        <td><b> Second Description  </b></td>
                                        <td>{{ $ros->second_description }}</td>
                                    </tr>
                                    @endif
                                    @if(isset($ros->third_description))
                                    <tr>
                                        <td><b> Third Description  </b></td>
                                        <td>{{ $ros->third_description }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <hr>
                @endif

                @if(count($adrs) > 0)
                <div class="table-responsive">
                    <div class="row  ml-2 mr-2">
                        @php $count = 1; @endphp
                        @foreach($adrs as $adr)
                        <div class="col-6">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> ADR {{ $count }} </h1>
                                <tbody>

                                    @if(isset($adr->drug_name))
                                    <tr>
                                        <td><b> Drug </b></td>
                                        <td>{{ $adr->drug_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($adr->reactions))
                                    <tr>
                                        <td><b> Reactions </b></td>
                                        <td>
                                        @foreach($adr->reactions as $reaction)
                                            <li style="list-style: circle;"> {{ isset($reaction->reaction->title)?$reaction->reaction->title:'' }} </li>
                                        @endforeach
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @endif

                @if(count($rxMedicines) > 0)
                <div class="table-responsive">
                    <div class="row  ml-2 mr-2">
                        @php $count = 1; @endphp
                        @foreach($rxMedicines as $rxMedicine)
                        <div class="col-6">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> CuRx (Medicines) {{ $count }} </h1>
                                <tbody>

                                    @if(isset($rxMedicine->medicine_name))
                                    <tr>
                                        <td><b> Medicine </b></td>
                                        <td>{{ $rxMedicine->medicine_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($rxMedicine->medicine->generic_name))
                                    <tr> 
                                        <td><b> Generic Name </b></td>
                                        <td>{{ $rxMedicine->medicine->generic_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($rxMedicine->dose_name))
                                    <tr>
                                        <td><b> Dose </b></td>
                                        <td>{{ $rxMedicine->dose_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($rxMedicine->unit_name))
                                    <tr>
                                        <td><b> Unit </b></td>
                                        <td>{{ $rxMedicine->unit_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($rxMedicine->frequency_name))
                                    <tr>
                                        <td><b> Frequency </b></td>
                                        <td>{{ $rxMedicine->frequency_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($rxMedicine->duration_name))
                                    <tr>
                                        <td><b> Duration </b></td>
                                        <td>{{ $rxMedicine->duration_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($rxMedicine->diagnosis_type_name))
                                    <tr>
                                        <td><b> Diagnosis Type </b></td>
                                        <td>{{ $rxMedicine->diagnosis_type_name }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @endif

                @if(count($patientLabTests) > 0)
                <div class="table-responsive">
                    <div class="row  ml-2 mr-2">
                        @php $count = 1; @endphp
                        @foreach($patientLabTests as $patientLabTest)
                        <div class="col-6">
                        <table class="table table-striped">
                        <h1 class="ml-2 mt-3 mb-2"> Lab Tests {{ $count }} </h1>
                                <tbody>

                                    @if(isset($patientLabTest->lab_test_name))
                                    <tr>
                                        <td><b> Diagnostic Name </b></td>
                                        <td>{{ $patientLabTest->lab_test_name }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientLabTest->type))
                                    <tr>
                                        <td><b> Type </b></td>
                                        <td>{{ $patientLabTest->type }}</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientLabTest->fasting))
                                    <tr>
                                        <td><b> Fasting </b></td>
                                        @if($patientLabTest->fasting == 1)
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif
                                    </tr>
                                    @endif

                                    @if(isset($patientLabTest->instructions))
                                    <tr>
                                        <td><b> Instructions </b></td>
                                        <td>{{ $patientLabTest->instructions }}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td><b> Instructions </b></td>
                                        <td>None</td>
                                    </tr>
                                    @endif

                                    @if(isset($patientLabTest->recommended_lab))
                                    <tr>
                                        <td><b> Recommended Lab </b></td>
                                        <td>{{ isset($patientLabTest->recommendedLabTest->title )?$patientLabTest->recommendedLabTest->title :''}}</td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                        </div>
                        @php $count++ @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @endif

            </div>
        </section>
    </div>

@if(count($patientReports) > 0)
@foreach($patientReports as $report)
    <div id="reportsPopupDetailPage{{$report->id}}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title" id="modal-title">
                        Attachment ({{$report->title}}) ({{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}) @if($report->type == 0) (Lab Test) @elseif($report->type == 1) (Invoice) @elseif($report->type == 2) (Other) @endif
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('storage/app/public/'.$report->image_url)}}" class="img-responsive img-center-popup">
                </div>
            </div>
        </div>
    </div>
@endforeach
@endif

@endsection

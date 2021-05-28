@extends('layouts.patient')

@section('extra-css')
    <style>
        .blinking {
            animation: blinkingText 1.2s infinite;
        }

        @keyframes blinkingText {
            0% {
                color: #000;
            }
            49% {
                color: #FFC107;
            }
            60% {
                color: transparent;
            }
            99% {
                color: transparent;
            }
            100% {
                color: #FFC107;
            }
        }
    </style>
@endsection

@section('main-content')
    <div class="content-wrapper">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('patientDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <a href="{{ route('patientAppointmentCreate') }}"
                                       class="btn btn-primary pull-right">Add Appointment</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Practitioner</th>
                                    <th>Patient Type</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Type</th>
                                    <th>Appointment Status</th>
                                    <th>Payment Status</th>
                                    <th>Video Call Link</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($appointments as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item['practitioner']['name']}}</td>
                                        @if(isset($item['patient_type']['title']))
                                            <td>{{$item['patient_type']['title']}}</td>
                                        @else
                                            <td> --</td>
                                        @endif
                                        <td>{{date('D d M Y', strtotime($item['date']))}} </td>
                                        <td>{{$item['time_slot']}} </td>
                                        <td> @if($item['type'] == 0) Physical @else Online @endif </td>
                                        <td>
                                            @if($item['status']==0) Pending
                                            @elseif($item['status']==1) Under Process
                                            @elseif($item['status']==2) Accepted
                                            @elseif($item['status']==3) Rejected
                                            @elseif($item['status']==4) Check In
                                            @elseif($item['status']==5) Completed
                                            @endif
                                        </td>
                                        @if(isset($item['payment']['payment_status']) && $item['payment']['payment_status'] == 'Paid')
                                            <td> {{ $item['payment']['payment_status'] }} </td>
                                        @else
                                            <td>
                                                <a href="{{route('submitPayment',$item['id'])}}"
                                                   class="btn btn-sm btn-primary">Submit Payment</a>
                                                {{--                                                <form action="" method="GET"--}}
                                                {{--                                                      target="_blank">--}}
                                                {{--                                                    <input name="storeId"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['storeId']}}"--}}
                                                {{--                                                           type="hidden"/>--}}
                                                {{--                                                    <input name="orderId"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['orderRefNum']}}"--}}
                                                {{--                                                           hidden/>--}}
                                                {{--                                                    <input name="transactionAmount"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['amount']}}"--}}
                                                {{--                                                           type="hidden"/>--}}
                                                {{--                                                    <input type="hidden" name="mobileAccountNo"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['mobileNum']}}">--}}
                                                {{--                                                    <input type="hidden" name="emailAddress"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['emailAddress']}}">--}}
                                                {{--                                                    <input type="hidden" name="transactionType"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['paymentMethod']}}">--}}
                                                {{--                                                    <input type="hidden" name="tokenExpiry"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['expiryDate']}}">--}}
                                                {{--                                                    <input type="hidden" name="bankIdentificationNumber" value="">--}}
                                                {{--                                                    <input type="hidden" name="merchantPaymentMethod" value="">--}}
                                                {{--                                                    <input name="postBackURL"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['postBackURL']}}"--}}
                                                {{--                                                           type="hidden"/>--}}
                                                {{--                                                    <input type="hidden" name="signature" value="">--}}
                                                {{--                                                    <input type="hidden" name="encryptedHashRequest"--}}
                                                {{--                                                           value="{{$paymentParameter[$item['id']]['hashRequest']}}">--}}
                                                {{--                                                    <button type="submit" class="btn btn-primary btn-sm">Submit Payment</button>--}}
                                                {{--                                                </form>--}}
                                            </td>
                                        @endif

                                        @php
                                            $appointmentTime = Carbon\Carbon::parse($item['time_slot'])->format('h:i:s');
                                            $appointmentDate = Carbon\Carbon::parse($item['date'])->format('Y-m-d');
                                            $slotEndTime = Carbon\Carbon::parse($item['time_slot'])->addMinutes(10)->format('h:i:s');
                                            $currentDate = Carbon\Carbon::now()->format('Y-m-d');
                                            $currentTime = Carbon\Carbon::now()->format('h:i:s');
                                        @endphp

                                        @if($appointmentDate == $currentDate && strtotime($currentDate.' '.$currentTime) >= strtotime($appointmentDate.' '.$appointmentTime) && strtotime($currentDate.' '.$currentTime) <= strtotime($currentDate.' '.$slotEndTime))
                                            <td><a class="btn btn-primary"
                                                   href="{{ route('joinAppointment', ['patientId' => $item['patient']['id'], 'practitionerId' => $item['practitioner']['id'], 'appointmentId' => $item['id']]) }}"
                                                   target="_blank"> Start Video Call </a></td>
                                        @elseif($item['type'] == 0)
                                            <td> No Link Available (Physical Appointment)</td>
                                        @else
                                            <td> Not in Schedule Time</td>
                                        @endif

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/patient/js/appointment.js')}}"></script>
@endsection

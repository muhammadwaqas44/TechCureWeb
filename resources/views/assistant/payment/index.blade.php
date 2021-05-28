@extends('layouts.assistant')

@section('extra-css')
@endsection

@section('main-content')
    <div class="content-wrapper mt-2">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('assistantDashboard')}}">Dashboard</a></li>
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
                                {{--                                <div class="col-lg-12">--}}
                                {{--                                    <h3> All Payments </h3>--}}
                                {{--                                </div>--}}
                                <div class="col-sm-6">
                                    <h3 class="m-0 text-dark">All Payments</h3>
                                </div>
                                <div class="col-sm-6" style="text-align: right">
                                    <a class="btn btn-info" href="{{route('dailyReportAssistant')}}">Daily Report</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Patient</th>
                                        <th>Practitioner</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Time Slot</th>
                                        <th>Fee</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Appointment Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($payments as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->patient->name}} </td>
                                            <td>{{$item->practitioner->name}} </td>
                                            <td>{{date('D d M Y', strtotime($item->date))}} </td>
                                            @if(isset($item->appointment->type))
                                                @if($item->appointment->type == 0)
                                                    <td> Physical</td>
                                                @elseif($item->appointment->type == 1)
                                                    <td> Online</td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
                                            @if(isset($item->appointment->time_slot))
                                                <td> {{ $item->appointment->time_slot }} </td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>PKR {{$item->amount}} </td>
                                            <td>{{$item->payment_method}} </td>
                                            <td>{{$item->payment_status}} </td>
                                            @if(isset($item->appointment->status))
                                                @if($item->appointment->status == 0)
                                                    <td> Pending</td>
                                                @elseif($item->appointment->status == 1)
                                                    <td> Under Process</td>
                                                @elseif($item->appointment->status == 2)
                                                    <td> Accepted</td>
                                                @elseif($item->appointment->status == 3)
                                                    <td> Rejected</td>
                                                @elseif($item->appointment->status == 4)
                                                    <td> Check In</td>
                                                @elseif($item->appointment->status == 5)
                                                    <td> Completed</td>
                                                @endif
                                                <td></td>
                                            @endif
                                            <td>
                                                <a class="btn btn-success"
                                                   href="{{route('assistantPaymentEdit', $item->id)}}"><i
                                                        class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/assistant/js/payment.js')}}"></script>
    @if(Session::has('success-message'))
        <script>
            toastr.success('{{ Session::get('success-message') }}')
        </script>
    @endif

    @if(Session::has('error-message'))
        <script>
            toastr.error('{{ Session::get('error-message') }}')
        </script>
    @endif
@endsection

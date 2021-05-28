@extends('layouts.backend')

@section('extra-css')
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
                            <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
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
                                    All Payments
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Practitioner Name</th>
                                        <th>Patient Name</th>
                                        <th>Appointment Type</th>
                                        <th>Date</th>
                                        <th>Fee</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->practitioner->name}} </td>
                                            <td>{{$item->patient->name}} </td>
                                            @if($item->appointment->type == 0)
                                            <td> Physical </td>
                                            @elseif($item->appointment->type == 1)
                                            <td> Online </td>
                                            @endif
                                            <td>{{date('D d M Y', strtotime($item->date))}} </td>
                                            {{-- <td> @if($item->type == 0) Credit Card @else Jazz Cash @endif </td> --}}
                                            <td>PKR {{$item->amount}} </td>
                                            <td>{{$item->payment_method}} </td>
                                            <td>{{$item->payment_status}} </td>
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
    <script src="{{asset('public/admin/js/payment.js')}}"></script>
@endsection
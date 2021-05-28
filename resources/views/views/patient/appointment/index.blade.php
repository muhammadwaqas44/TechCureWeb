@extends('layouts.patient')

@section('extra-css')
    <style>
        .blinking{
            animation:blinkingText 1.2s infinite;
        }
        @keyframes blinkingText{
            0%{     color: #000;    }
            49%{    color: #FFC107; }
            60%{    color: transparent; }
            99%{    color:transparent;  }
            100%{   color: #FFC107;    }
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
                                    <a href="{{ route('patientAppointmentCreate') }}" class="btn btn-primary pull-right">Add Appointment</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Practitioner</th>
                                        <th>Clinic</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->practitioner->name}}</td>
                                            <td>{{$item->clinic->name}}</td>
                                            <td>
                                                {{date('D d M Y', strtotime($item->date))}} 
                                                @if($item->status==1 || $item->status==3)
                                                    @if(date('Y-m-d') == $item->date)
                                                        <span class="blinking">Meeting!</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{$item->time_slot}} </td>
                                            <td> @if($item->type == 0) Physical @else Online @endif </td>
                                            <td> 
                                                @if($item->status==0) Under Process 
                                                @elseif($item->status==1) Accepted
                                                @elseif($item->status==2) Rejected
                                                @elseif($item->status==3) Check In
                                                @elseif($item->status==4) Completed
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->type == 1)
                                                    @if($item->status==1 || $item->status==3)
                                                        @if(date('Y-m-d', strtotime($item->date)) >= date('Y-m-d'))
                                                            @if(date('Y-m-d') == $item->date)
                                                                @if( \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('h:i a') >= $item->time_slot || $item->early_meeting==1)
                                                                    <a class="btn btn-primary" target="_blank" href="{{$item->patient_url}}" ><i class="fa fa-user" ></i> Join Meeting</a>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                {{-- <a class="btn btn-success" href="{{route('patientAppointmentEdit',$item->id)}}"><i class="fa fa-edit" ></i></a> --}}
                                            </td>
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
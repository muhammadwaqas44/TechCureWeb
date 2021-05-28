@extends('layouts.practitioner')

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
                            <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Home</a></li>
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
                                    <a href="{{ route('practitionerPatientCreate') }}" class="btn btn-primary pull-right">Add Patient</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="practitionerPatient" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>No. of Visits</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->phone}} </td>
                                            <td>{{\Carbon\Carbon::parse($item->dob)->diff(\Carbon\Carbon::now())->format('%y years')}}</td>
                                            <td> 
                                                @if($item->gender==1)Male @elseif($item->gender==2) Female @else Other @endif
                                            </td>
                                            <td>{{$item->visitCount(Auth::guard('practitioner')->user()->id, $item->id)}} </td>
                                            <td> 
                                                @if($item->status==1)Active @else In-Active @endif
                                            </td>
                                            <td style="text-align:center">
                                                <a class="btn btn-success" href="{{route('practitionerPatientEdit',$item->id)}}"><i class="fa fa-edit" ></i></a>
                                                <a class="btn btn-primary" href="{{route('practitionerPrescriptionList',$item->id)}}"><i class="fa fa-eye" ></i> Prescription</a><br><br>
                                                <a class="btn btn-primary" href="{{route('practitionerPatientAppointment',$item->id)}}"><i class="fa fa-eye" ></i> Appointment </a>

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
    <script src="{{asset('public/admin/js/patient.js')}}"></script>
@endsection
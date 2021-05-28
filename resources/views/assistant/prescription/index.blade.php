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
                                    <span><strong>Patient Detail</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row" style="width:100%">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Name: </strong></span> <span>{{$patient->name}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Email: </strong></span> <span>{{$patient->email}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Phone: </strong></span> <span>{{$patient->phone}}</span>
                                </div>
                                
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Age: </strong></span> <span>{{\Carbon\Carbon::parse($patient->dob)->diff(\Carbon\Carbon::now())->format('%y years')}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Gender: </strong></span> <span>@if($patient->gender==1)Male @elseif($patient->gender==2) Female @else Other @endif</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Address: </strong></span> <span>{{$patient->address}}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <a href="{{ route('practitionerPrescriptionCreate', $patient->id) }}" class="btn btn-primary pull-right">Add Prescription</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Date</th>
                                        <th>Follow Up</th>
                                        <th>Medications</th>
                                        <th>Practitioner</th>
                                        <th>Clinic/Hospital</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescriptions as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{date('D d M Y', strtotime($item->created_at))}}</td>
                                            <td>@if($item->follow_up){{date('D d M Y', strtotime($item->follow_up))}}@else None @endif</td>           
                                            <td>
                                                @foreach($item->medications as $medication)
                                                    <div class="permission-tag"> {{ $medication->title }} </div>
                                                @endforeach
                                            </td> 
                                            <td>@if($item->practitioner_id) {{$item->practitioner->name}} @else Added By Admin @endif</td>                                
                                            <td>{{$item->clinic->name}} </td>                                
                                            <td>
                                                <a class="btn btn-success" href="{{route('practitionerPrescriptionEdit',$item->id)}}"><i class="fa fa-edit" ></i></a>
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
    <script src="{{asset('public/admin/js/prescription.js')}}"></script>
@endsection
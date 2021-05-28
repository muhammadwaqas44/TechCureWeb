@extends('layouts.patient')

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
                                    Prescriptions
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="patientPrescription" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Date</th>
                                        <th>Follow Up</th>
                                        <th>Medications</th>
                                        <th>Practitioner</th>
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
                                            <td>@if($item->practitioner_id) {{$item->practitioner->name}} @else Added By Admin @endif  <a href="{{route('patientPractitionerProfile',$item->practitioner->id )}}">Profile</a></td>                                
                                            <td>
                                                <a class="btn btn-success" href="{{route('patientPrescriptionDetail',$item->id)}}"><i class="fa fa-eye" ></i></a>
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
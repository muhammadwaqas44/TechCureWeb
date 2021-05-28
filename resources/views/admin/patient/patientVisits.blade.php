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
                                    <a href="{{ route('patientList') }}" class="btn btn-primary pull-right">Back</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="patientVisitTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Visit Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientVisits as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td> 
                                                @if($item->status==1) Revised @else Not Revised @endif
                                            </td>
                                            <td>
                                            <a class="btn btn-primary" href="{{ route('patientPreviousVisitDetail',$item->id) }}"><i class="fa fa-eye" ></i></a>
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
@extends('layouts.clinic')

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
                            <li class="breadcrumb-item"><a href="{{route('clinicDashboard')}}">Home</a></li>
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
                                    <span><strong>Practitioner Profile</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row" style="width:100%">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Name: </strong></span> <span>{{$practitioner->name}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Email: </strong></span> <span>{{$practitioner->email}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Phone: </strong></span> <span>{{$practitioner->phone}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Address: </strong></span> <span>{{$practitioner->address}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Specialties: </strong>
                                    @foreach($practitioner->specialties as $specialty)
                                        <div class="permission-tag"> <span>{{ $loop->iteration }}- {{ $specialty->title }}</span> </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/admin/js/practitioner.js')}}"></script>
@endsection
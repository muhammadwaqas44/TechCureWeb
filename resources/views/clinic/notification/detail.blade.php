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
                        <h1 class="m-0 text-dark">Notification Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Notification Detail</li>
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
                                    <span><strong>Notification Detail</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row" style="width:100%">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <span><strong>Title: </strong></span> <span>{{$notification->title}}</span>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <span><strong>Message: </strong></span> <span>{{$notification->message}}</span>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <span><strong>Date/Time: </strong></span> <span>{{\Carbon\Carbon::parse($notification->created_at)->setTimezone('Asia/Karachi')->format('l d M Y h:i a')}}</span>
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
@endsection
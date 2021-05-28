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
                        <div class="card-body">
                            <table id="appointmentTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Patient</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->patient->name}}</td>
                                            <td>{{date('D d M Y', strtotime($item->date))}} </td>
                                            <td>{{$item->time}} </td>
                                            <td> @if($item->type == 0) Physical @else Online @endif </td>
                                            <td> 
                                                @if($item->status==0) Pending 
                                                @elseif($item->status==1) Under Process 
                                                @elseif($item->status==2) Accepted
                                                @elseif($item->status==3) Rejected
                                                @elseif($item->status==4) Check In
                                                @elseif($item->status==5) Completed
                                                @endif
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
    <script src="{{asset('public/admin/js/assistant.js')}}"></script>
@endsection
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
                                    <a href="{{ route('assistantCreate') }}" class="btn btn-primary pull-right">Add Assistant</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Specialties</th>
                                        <th>Practitioners</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assistants as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}} </td>
                                            <td>{{$item->phone}} </td>
                                            <td>
                                                @if(count($item->specialties) > 0)
                                                @foreach($item->specialties as $specialty)
                                                    <div class="permission-tag"> <li> {{ $specialty->title }} </li> </div>
                                                @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($item->practitioners) > 0)
                                                @foreach($item->practitioners as $practitioner)
                                                    <div class="permission-tag"> <li> {{ $practitioner->name }} </li> </div>
                                                @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td> 
                                                @if($item->status==1)Active @else In-Active @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{route('assistantEdit',$item->id)}}"><i class="fa fa-edit" ></i></a>
                                                <a class="btn btn-primary" href="{{route('assistantDetail',$item->id)}}"><i class="fa fa-eye" ></i></a>
                                                @if($item->status == 0)
                                                <a class="btn btn-success" href="javascript:void(0);" onclick="changeAssistantStatus({{ $item->id }},'1');" role="button">Activate</a>
                                                @else
                                                <a class="btn btn-danger" href="javascript:void(0);" onclick="changeAssistantStatus({{ $item->id }},'0');" role="button">Deactivate</a>
                                                @endif
                                                <a class="btn btn-success mt-1" href="{{ route('assistantAppointments', $item->id) }}">Appointments ({{ $item->assistantAppointments() }})</a>
                                                <a class="btn btn-success mt-1" href="{{ route('assistantPatients', $item->id) }}">Patients ({{ $item->assistantPatients() }})</a>
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
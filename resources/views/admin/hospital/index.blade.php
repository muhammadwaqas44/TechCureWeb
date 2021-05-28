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
                        {{-- <div class="card-header">
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <a href="{{ route('hospitalCreate') }}" class="btn btn-primary pull-right">Add
                                        Hospital</a>
                                </div>
                            </div>
                        </div> --}}

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Title</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Timing</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($hospitals as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->contact_no}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>@if($item->all_time == 0){{\Carbon\Carbon::parse($item->from_time)->isoFormat('h:mm A')}}
                                            - {{\Carbon\Carbon::parse($item->to_time)->isoFormat('h:mm A')}}@else
                                                24/7 @endif</td>
                                        <td>
                                            @if($item->status==1)Active @else In-Active @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{route('hospitalEdit',$item->id)}}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-success" href="{{route('hospitalDetail',$item->id)}}"><i
                                                    class="fa fa-eye"></i></a>
                                            {{-- <a class="btn btn-danger" onclick="deleteFunction('{{$item->id}}')"><i
                                                    class="fa fa-trash"></i></a> --}}

                                            {{-- @if($item->status == 0)
                                                <a class="btn btn-success" href="javascript:void(0);"
                                                   onclick="changeHospitalStatus({{ $item->id }},'1');" role="button">Activate</a>
                                            @else
                                                <a class="btn btn-danger" href="javascript:void(0);"
                                                   onclick="changeHospitalStatus({{ $item->id }},'0');" role="button">Deactivate</a>
                                            @endif --}}
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
    <script src="{{asset('public/admin/js/hospital.js')}}"></script>
@endsection
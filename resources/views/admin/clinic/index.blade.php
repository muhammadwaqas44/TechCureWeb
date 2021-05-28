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
                                    <a href="{{ route('clinicCreate') }}" class="btn btn-primary pull-right">Add Clinic</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>UserName</th>
                                        <th>Phone</th>
                                        <th>Specialties</th>
                                        <th>Facilities</th>
                                        <th>Medications</th>
                                        <th>Departments</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clinics as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}} </td>
                                            <td>{{$item->phone}} </td>
                                            <td>
                                                @if(count($item->specialties) > 0)
                                                    @foreach($item->specialties as $specialty)
                                                        <div class="permission-tag"> {{ $specialty->title }} </div>
                                                    @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($item->facilities) > 0)
                                                    @foreach($item->facilities as $facility)
                                                        <div class="permission-tag"> {{ $facility->title }} </div>
                                                    @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($item->medications) > 0)
                                                    @foreach($item->medications as $medication)
                                                        <div class="permission-tag"> {{ $medication->title }} </div>
                                                    @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($item->departments) > 0)
                                                    @foreach($item->departments as $department)
                                                        <div class="permission-tag"> {{ $department->title }} </div>
                                                    @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status==1)Active @else In-Active @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{route('clinicEdit',$item->id)}}"><i class="fa fa-edit" ></i></a>
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
    <script src="{{asset('public/admin/js/clinic.js')}}"></script>
@endsection

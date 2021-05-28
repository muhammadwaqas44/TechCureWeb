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
                                    <a href="{{ route('hospitalConfigurationCreate') }}"
                                       class="btn btn-primary pull-right">Add
                                        Hospital Configuration</a>
                                </div>
                            </div>
                        </div> --}}

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Title</th>
                                    <th>Hospital Name</th>
                                    <th>Facilities</th>
                                    <th>Lat Tests</th>
                                    <th>Medications</th>
                                    <th>Specialties</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($hospitalConfigurations as $item)
                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->key}}</td>
                                        <td>{{$item->hospital_name}}</td>
                                        <td>@if($item->facilities)
                                                @foreach($item->facilities as $facility)
                                                    <li>{{$facility->facility_name}}</li>
                                                @endforeach
                                            @endif</td>
                                        <td>@if($item->latTests)
                                                @foreach($item->latTests as $labTest)
                                                    <li>{{$labTest->lab_test_name}}</li>
                                                @endforeach
                                            @endif</td>
                                        <td>@if($item->medications)
                                                @foreach($item->medications as $medication)
                                                    <li>{{$medication->medication_name}}</li>
                                                @endforeach
                                            @endif</td>
                                        <td>@if($item->specialties)
                                                @foreach($item->specialties as $specialty)
                                                    <li>{{$specialty->specialty_name}}</li>
                                                @endforeach
                                            @endif</td>

                                        <td>
                                            <a class="btn btn-success"
                                               href="{{route('hospitalConfigurationEdit',$item->id)}}"><i
                                                    class="fa fa-edit"></i></a>

                                            <a class="btn btn-danger" onclick="deleteFunction('{{$item->id}}')"><i
                                                    class="fa fa-trash"></i></a>
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
    <script src="{{asset('public/admin/js/hospitalConfiguration.js')}}"></script>
@endsection

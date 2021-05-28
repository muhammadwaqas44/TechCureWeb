@extends('layouts.patient')

@section('extra-css')
    <style>
        .select2-container .select2-selection--single{
            height: 37px !important;
        }
    </style>
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
                                    <h2>All Practitioners</h2>
                                </div>
                            </div>
                        </div>

                        <form action="{{route('patientPractitionerListSearch')}}" method="POST">
                            @csrf
                            <div class="row mt-3" style="width:100%;justify-content:center">

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">

                                        <select name="specialty_id" id="specialty_id" class="form-control {{ $errors->has('specialty_id') ? ' is-invalid' : '' }}" title="Select Specialty" required>
                                            <option value="" selected disabled>Select Specialty</option>
                                            @foreach($specialties as $specialty)
                                                <option value="{{ $specialty->id }}" @isset($specialtySelected) @if($specialtySelected->id == $specialty->id) selected @endif @endisset>{{ $specialty->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('specialty_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('specialty_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('patientPractitionerList') }}" class="btn btn-danger">Reset</a>
                                </div>

                            </div>
                        </form>

                        <div class="card-body">
                            <table id="patientPractitioner" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Specialties</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($practitioners as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>info@myeonhealth.com </td>
                                            <td><a href="tel://03041110366"> 0304-111-0366</a> </td>
                                            <td>
                                                @foreach($item->specialties as $specialty)
                                                    <div class="permission-tag"> {{ $specialty->title }} </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{route('patientPractitionerProfile',$item->id)}}"><i class="fa fa-eye" ></i></a>
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

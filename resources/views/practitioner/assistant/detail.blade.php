@extends('layouts.practitioner')

@section('main-content')
     <div class="content-wrapper mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content ml-2 mr-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                    <tbody>
                                        <tr> 
                                            <td><b>Assistant ID</b></td>
                                            <td>{{ $assistant->id }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Assistant Name</b></td>
                                            <td>{{ $assistant->name }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{ $assistant->email }}</td>
                                        </tr>

                                        @if($assistant->image != null && Storage::exists($assistant->image))
                                        <tr> 
                                            <td><b>Profile Image</b></td>
                                            <td> <img src="{{ asset('storage/app/public/'.$assistant->image) }}" alt="Assistant Image"
                                                class="thumbnail-image-100"> </td>
                                        </tr>
                                        @endif

                                        @if(isset($assistant->phone))
                                        <tr>
                                            <td><b>Phone No.</b></td>
                                            <td>{{ $assistant->phone }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($assistant->qualification_id))
                                        <tr>
                                            <td><b>Qualification</b></td>
                                            <td>{{ $assistant->qualification->title }}</td>
                                        </tr>
                                        @endif

                                        @if(count($assistant->specialties) > 0)
                                        <tr>
                                            <td><b>Specialties</b></td>
                                            <td>
                                                @foreach($assistant->specialties as $speciality)
                                                    <div class="permission-tag"> <li> {{ $speciality->title }} </li> </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif

                                        @if(isset($assistant->address))
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $assistant->address }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($assistant->description))
                                        <tr> 
                                            <td><b>Description</b></td>
                                            <td>{{ $assistant->description }}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td><b>Appointments</b> </td>
                                            <td> {{ $assistant->assistantAppointments() }} Appointment(s) </td>
                                        </tr>

                                        <tr>
                                            <td><b>Patients</b> </td>
                                            <td> {{ $assistant->assistantPatients() }} Patient(s) </td>
                                        </tr>

                                        <tr>
                                            <td><b>Status</b> </td>
                                            <td> @if($assistant->status == 1) Active @else Inactive @endif </td>
                                        </tr>

                                    </tbody>
                                </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
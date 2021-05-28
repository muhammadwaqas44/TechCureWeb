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
                        <h1 class="m-0 text-dark">Practitioner Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Practitioner Detail</li>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                    <tbody>
                                        <tr> 
                                            <td><b>Practitioner ID</b></td>
                                            <td>{{ $practitioner->id }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Practitioner Name</b></td>
                                            <td>{{ $practitioner->name }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{ $practitioner->email }}</td>
                                        </tr>

                                        @if($practitioner->image != null && Storage::exists($practitioner->image))
                                        <tr> 
                                            <td><b>Image</b></td>
                                            <td> <img src="{{ asset('storage/app/public/'.$practitioner->image) }}" alt="Practitioner Image"
                                                class="thumbnail-image-100"> </td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->phone))
                                        <tr>
                                            <td><b>Phone No.</b></td>
                                            <td>{{ $practitioner->phone }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->address))
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $practitioner->address }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->description))
                                        <tr> 
                                            <td><b>Description</b></td>
                                            <td>{{ $practitioner->description }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->qualification_id))
                                        <tr>
                                            <td><b>Qualification</b></td>
                                            <td>{{ $practitioner->qualification->title }}</td>
                                        </tr>
                                        @endif

                                        @if(count($practitioner->specialties) > 0)
                                        <tr>
                                            <td><b>Specialties</b></td>
                                            <td>
                                                @foreach($practitioner->specialties as $speciality)
                                                    <li> {{ $speciality->title }} </li>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif

                                        @if(count($practitioner->days) > 0)
                                        <tr> 
                                            <td><b>Days</b></td>
                                            <td>
                                                @foreach($practitioner->days as $day)
                                                    <li> {{ ucfirst($day->day) }} </li>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->from_time))
                                        <tr>
                                            <td><b>From Time</b> </td>
                                            <td>{{ date('h:i:s a', strtotime($practitioner->from_time)) }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->to_time))
                                        <tr>
                                            <td><b>To Time</b> </td>
                                            <td>{{ date('h:i:s a', strtotime($practitioner->to_time)) }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->physical_fee))
                                        <tr>
                                            <td><b>Physical Fee</b> </td>
                                            <td>PKR {{ $practitioner->physical_fee }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->online_fee))
                                        <tr>
                                            <td><b>Online Fee</b> </td>
                                            <td>PKR {{ $practitioner->online_fee }}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td><b>Status</b> </td>
                                            <td> @if($practitioner->status == 1) Active @else Inactive @endif </td>
                                        </tr>

                                        <tr>
                                            <td><b>Patients</b> </td>
                                            <td> 10 </td>
                                        </tr>
                                        
                                        <tr>
                                            <td><b>Appointments</b> </td>
                                            <td> <a href="{{ route('practitionerAppointments', $practitioner->id) }}"> {{ $practitioner->practitionerAppointments() }} Appointment(s) </a> </td>
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

@section('scripts')
@endsection
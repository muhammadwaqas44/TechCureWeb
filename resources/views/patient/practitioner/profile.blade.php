@extends('layouts.patient')

@section('main-content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Practitioner Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('patientDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Practitioner Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
                                    <td>info@myeonhealth.com</td>
                                </tr>

                                @if($practitioner->image != null && Storage::exists($practitioner->image))
                                <tr>
                                    <td><b>Profile Image</b></td>
                                    <td> <img src="{{ asset('storage/app/public/'.$practitioner->image) }}"
                                            alt="Practitioner Image" class="thumbnail-image-100"> </td>
                                </tr>
                                @endif

{{--                                @if(isset($practitioner->phone))--}}
                                <tr>
                                    <td><b>Phone No.</b></td>
                                    <td><a href="tel://03041110366"> 0304-111-0366</a></td>
                                </tr>
{{--                                @endif--}}

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

                                @if(isset($practitioner->license_no))
                                <tr>
                                    <td><b>License No.</b></td>
                                    <td>{{ $practitioner->license_no }}</td>
                                </tr>
                                @endif

                                @if($practitioner->license_image != null &&
                                Storage::exists($practitioner->license_image))
                                <tr>
                                    <td><b>License Image</b></td>
                                    <td> <img src="{{ asset('storage/app/public/'.$practitioner->license_image) }}"
                                            alt="Practitioner License Image" class="thumbnail-image-100"> </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            @php $count = 1; @endphp
            @foreach($practitioner->practitionerClinics as $clinic)
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>

                                <h2 class="ml-2 mt-2"> Clinic {{ $count }}</h2>

                                @if(isset($clinic->clinic_id))
                                <tr>
                                    <td><b>Clinic Name</b></td>
                                    <td>
                                        {{ $clinic->clinic->name }}
                                    </td>
                                </tr>
                                @endif

                                @if(isset($clinic->days))
                                <tr>
                                    <td><b>Day(s)</b></td>
                                    <td>
                                        @foreach($clinic->days as $day)
                                        <li> {{ ucfirst($day->day) }} </li>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif

                                @if(isset($clinic->from_time) && isset($clinic->to_time))
                                <tr>
                                    <td><b>Time (From - To)</b></td>
                                    <td>
                                        {{ date("h:i A", strtotime($clinic->from_time)) }} - {{ date("h:i A", strtotime($clinic->to_time)) }}
                                    </td>
                                </tr>
                                @endif

                                @if(isset($clinic->physical_fee))
                                <tr>
                                    <td><b>Physical Fee</b></td>
                                    <td>
                                        PKR {{ $clinic->physical_fee }}
                                    </td>
                                </tr>
                                @endif

                                @if(isset($clinic->online_fee))
                                <tr>
                                    <td><b>Online Fee</b></td>
                                    <td>
                                        PKR {{ $clinic->online_fee }}
                                    </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @php $count++; @endphp
            @endforeach

        </div>
    </section>
</div>
@endsection

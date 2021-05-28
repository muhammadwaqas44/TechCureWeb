@extends('layouts.assistant')

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
                            <li class="breadcrumb-item"><a href="{{route('assistantDashboard')}}">Home</a></li>
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
                                            <td><b>Profile Image</b></td>
                                            <td> <img src="{{ asset('storage/app/public/'.$practitioner->image) }}" alt="Assistant Image"
                                                class="thumbnail-image-100"> </td>
                                        </tr>
                                        @endif

                                        @if(isset($practitioner->phone))
                                        <tr>
                                            <td><b>Phone No.</b></td>
                                            <td>{{ $practitioner->phone }}</td>
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
                                                    <div class="permission-tag"> <li> {{ $speciality->title }} </li> </div>
                                                @endforeach
                                            </td>
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

                                        <tr>
                                            <td><b>Status</b> </td>
                                            <td> @if($practitioner->status == 1) Active @else Inactive @endif </td>
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

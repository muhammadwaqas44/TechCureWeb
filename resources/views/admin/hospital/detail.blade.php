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
                        <h1 class="m-0 text-dark">Hospital Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Hospital Detail</li>
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
                                    <td><b>Hospital ID</b></td>
                                    <td>{{ $hospital->id }}</td>
                                </tr>

                                <tr>
                                    <td><b>Hospital Name</b></td>
                                    <td>{{ $hospital->title }}</td>
                                </tr>

                                <tr>
                                    <td><b>Email</b></td>
                                    <td>{{ $hospital->email }}</td>
                                </tr>


                                @if(isset($hospital->contact_no))
                                    <tr>
                                        <td><b>Phone No.</b></td>
                                        <td>{{ $hospital->contact_no }}</td>
                                    </tr>
                                @endif

                                @if(isset($hospital->address))
                                    <tr>
                                        <td><b>Address</b></td>
                                        <td>{{ $hospital->address }}</td>
                                    </tr>
                                @endif

                                @if(isset($hospital->about))
                                    <tr>
                                        <td><b>Description</b></td>
                                        <td>{{ $hospital->about }}</td>
                                    </tr>
                                @endif
                                @if(count($hospital->departments) > 0)
                                    <tr>
                                        <td><b>Departments</b></td>

                                        <td>
                                            @foreach($hospital->departments as $department)
                                                <li> {{ $department->department_name }} </li>
                                            @endforeach
                                        </td>

                                    </tr>
                                @endif

                                @if(count($hospital->facilities) > 0)
                                    <tr>
                                        <td><b>Facilities</b></td>
                                        <td>
                                            @foreach($hospital->facilities as $facility)
                                                <li> {{ $facility->facility_name }} </li>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                                @if(count($hospital->days) > 0)
                                    <tr>
                                        <td><b>Days</b></td>
                                        <td>
                                            @foreach($hospital->days as $day)
                                                <li> {{ ucfirst($day->day) }} </li>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                                @if($hospital->all_time == 1)
                                    <tr>
                                        <td><b>Timing</b></td>
                                        <td>24/7</td>
                                    </tr>
                                @endif
                                @if(isset($hospital->from_time))
                                    <tr>
                                        <td><b>From Time</b></td>
                                        <td>{{ date('h:i:s a', strtotime($hospital->from_time)) }}</td>
                                    </tr>
                                @endif

                                @if(isset($hospital->to_time))
                                    <tr>
                                        <td><b>To Time</b></td>
                                        <td>{{ date('h:i:s a', strtotime($hospital->to_time)) }}</td>
                                    </tr>
                                @endif


                                <tr>
                                    <td><b>Status</b></td>
                                    <td> @if($hospital->status == 1) Active @else Inactive @endif </td>
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

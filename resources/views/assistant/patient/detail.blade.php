@extends('layouts.assistant')

@section('main-content')
     <div class="content-wrapper mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Patient Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('assistantDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Patient Detail</li>
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
                                            <td><b>Patient ID</b></td>
                                            <td>{{ $patient->id }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Mr. Number</b></td>
                                            <td>{{ $patient->mr_number }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Patient Name</b></td>
                                            <td>{{ $patient->name }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{ $patient->email }}</td>
                                        </tr>

                                        @if($patient->image != null && Storage::exists($patient->image))
                                        <tr>
                                            <td><b>Profile Image</b></td>
                                            <td> <img src="{{ asset('storage/app/public/'.$patient->image) }}" alt="Patient Image"
                                                class="thumbnail-image-100"> </td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->phone))
                                        <tr>
                                            <td><b>Phone No.</b></td>
                                            <td>{{ $patient->phone }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->gender))
                                        <tr>
                                            <td><b>Gender</b></td>
                                            <td>@if($patient->gender==1) Male @elseif($patient->gender==2) Female @else Other @endif</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->dob))
                                        <tr>
                                            <td><b>Date of Birth</b></td>
                                            <td>{{ date('d-m-Y', strtotime($patient->dob)) }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->age))
                                        <tr>
                                            <td><b>Age (Years)</b></td>
                                            <td>{{ $patient->age }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->weight_kgs) && $patient->weight_kgs > 0)
                                        <tr>
                                            <td><b>Weight (Kilograms)</b></td>
                                            <td>{{ $patient->weight_kgs }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->weight_lbs) && $patient->weight_lbs > 0)
                                        <tr>
                                            <td><b>Weight (Pounds)</b></td>
                                            <td>{{ $patient->weight_lbs }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->height_ft) && $patient->height_ft > 0 && isset($patient->height_in) && $patient->height_in > 0)
                                        <tr>
                                            <td><b>Height (Feet) (Inches)</b></td>
                                            <td>{{ $patient->height_ft }} Feet {{ $patient->height_in }} Inches</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->height_cms) && $patient->height_cms > 0)
                                        <tr>
                                            <td><b>Height (Centimeters)</b></td>
                                            <td>{{ $patient->height_cms }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->marital_status))
                                        <tr>
                                            <td><b>Marital Status</b></td>
                                            <td>{{ $patient->marital_status }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->address))
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $patient->address }}</td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->hospitalization))
                                        <tr>
                                            <td><b>Hospitalization</b></td>
                                            <td>@if($patient->hospitalization==1) Yes @else No @endif</td>
                                        </tr>
                                        @endif

                                        @if(count($patient->allergies) > 0)
                                        <tr>
                                            <td><b>Allergies</b></td>
                                            <td>
                                                @foreach($patient->allergies as $allergy)
                                                    <li style="list-style: circle;"> {{ $allergy->allergy_title }} </li>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif

                                        @if(isset($patient->currently_on_drug))
                                        <tr>
                                            <td><b>Currently on any Drug</b></td>
                                            <td>@if($patient->currently_on_drug==1) Yes @else No @endif</td>
                                        </tr>
                                        @endif

                                        @if(count($patient->drugs) > 0)
                                        <tr>
                                            <td><b>Drugs</b></td>
                                            <td>
                                                @foreach($patient->drugs as $drug)
                                                    <li style="list-style: circle;"> {{ $drug->drug_title }} </li>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif

                                        @if(count($patient->reports) > 0)
                                        <tr>
                                            <td><b>Attachments</b></td>
                                            <td>
                                                <div class="row" style="width:100%">
                                                @foreach($patient->reports as $report)
                                                    <div class="item col-xs-3 col-lg-3 target del">
                                                        <div class="thumbnail card">
                                                            <a data-toggle="modal" data-target="#reportsPopupModal{{$report->id}}" class="img-event mt-1" style="text-align:center" href="{{asset('storage/app/public/'.$report->image_url)}}">
                                                                <i class="fa fa-image fa-5x group list-group-image img-fluid"></i>
                                                            </a>
                                                            <div style="text-align:center">{{ $report->title }} @if($report->type == 0) (Lab Test) @elseif($report->type == 1) (Invoice) @elseif($report->type == 2) (Other) @endif</div>
                                                            <div class="mb-1" style="text-align:center"> {{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}} </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td><b>Status</b> </td>
                                            <td> @if($patient->status == 1) Active @else Inactive @endif </td>
                                        </tr>

                                    </tbody>
                                </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    @foreach($patient->reports as $report)
    <div id="reportsPopupModal{{$report->id}}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title" id="modal-title">
                       Attachment ({{$report->title}}) ({{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}) @if($report->type == 0) (Lab Test) @elseif($report->type == 1) (Invoice) @elseif($report->type == 2) (Other) @endif
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('storage/app/public/'.$report->image_url)}}"
                         class="img-responsive img-center-popup">
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection

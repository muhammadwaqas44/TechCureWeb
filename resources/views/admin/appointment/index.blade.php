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

        <form action="{{ route('appointmentFilter') }}" method="POST" class="custom-filter">
                {{csrf_field()}}
            
                @if(isset($messageError))
                <div align="center">
                    <div class="alert alert-danger col-lg-6">{{ $messageError }}</div>
                </div>
                @endif 

                <div class="row">
            
                    <div class="form-group col-lg-3">
                        <label class="control-label">Appointment Date From</label>
                        <div class="input-group date previous">
                            <input class="form-control {{ $errors->has('date_from') ? ' is-invalid' : '' }}" type="text"
                                name="date_from" @if(isset($selectedValues['date_from']))
                                value="{{(isset($selectedValues['date_from']))? $selectedValues['date_from']: ''}}"
                                @endif placeholder="Choose Date From" />
                            <span class="input-group-addon">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        @if ($errors->has('date_from'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date_from') }}</strong>
                        </span>
                        @endif
                    </div>
            
                    <div class="form-group col-lg-3">
                        <label class="control-label">Appointment Date To</label>
                        <div class="input-group date previous">
                            <input class="form-control {{ $errors->has('date_to') ? ' is-invalid' : '' }}" type="text"
                                name="date_to"
                                value="{{(isset($selectedValues['date_to']))? $selectedValues['date_to']: ''}}"
                                placeholder="Choose Date To" />
                            <span class="input-group-addon">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        @if ($errors->has('date_to'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date_to') }}</strong>
                        </span>
                        @endif
                    </div>
            
                    <div class="form-group col-lg-3">
                        <label class="control-label">Status</label>
                        <select name="status" id="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}">
                            <option value="" selected disabled>Select Status </option>
                            <option @if(isset($selectedValues['status']) && $selectedValues['status']== "0" ) selected @endif
                                value="0"> Pending </option>
                            <option @if(isset($selectedValues['status']) && $selectedValues['status']== "1" ) selected @endif
                                value="1"> Under Process </option>
                            <option @if(isset($selectedValues['status']) && $selectedValues['status']== "2" ) selected @endif
                                value="2"> Accepted </option>
                            <option @if(isset($selectedValues['status']) && $selectedValues['status']== "3" ) selected @endif
                                value="3"> Rejected </option>
                            <option @if(isset($selectedValues['status']) && $selectedValues['status']== "4" ) selected @endif
                                value="4"> Check In </option>
                            <option @if(isset($selectedValues['status']) && $selectedValues['status']== "5" ) selected @endif
                                value="5"> Completed </option>
                        </select>
                        @if ($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('appointmentList') }}" class="btn btn-danger">Reset</a>
                </div>
            
        </form>

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <a href="{{ route('appointmentCreate') }}" class="btn btn-primary pull-right">Add Appointment</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Practitioner</th>
                                        <th>Patient</th>
                                        <th>Patient Type</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item['practitioner']['name']}}</td>
                                            <td>{{$item['patient']['name']}}</td>
                                            @if(isset($item['patient_type']['title']))
                                            <td>{{$item['patient_type']['title']}}</td>
                                            @else
                                            <td> -- </td>
                                            @endif
                                            <td>{{date('D d M Y', strtotime($item['date']))}} </td>
                                            <td>{{$item['time_slot']}} </td>
                                            <td> @if($item['type'] == 0) Physical @else Online @endif </td>
                                            <td> 
                                                @if($item['status']==0) Pending 
                                                @elseif($item['status']==1) Under Process 
                                                @elseif($item['status']==2) Accepted
                                                @elseif($item['status']==3) Rejected
                                                @elseif($item['status']==4) Check In
                                                @elseif($item['status']==5) Completed
                                                @endif
                                            </td>
                                            @if(isset($item['payment']['payment_status']))
                                            <td> {{ $item['payment']['payment_status'] }} </td>
                                            @else
                                            <td> Unpaid </td>
                                            @endif
                                            <td>
                                                <a class="btn btn-success" href="{{route('appointmentEdit',$item['id'])}}"><i class="fa fa-edit" ></i></a>
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
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets":9 },
                ]
            });
        });

        $(".date").datepicker({
            autoclose: true,
            todayHighlight: true,
            // startDate: new Date(),
            todayBtn: "linked",
        });
    </script>
@endsection
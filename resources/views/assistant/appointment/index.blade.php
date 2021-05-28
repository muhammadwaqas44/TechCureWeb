@extends('layouts.assistant')

@section('extra-css')
    <style>
        .blinking {
            animation: blinkingText 1.2s infinite;
        }

        @keyframes blinkingText {
            0% {
                color: #000;
            }
            49% {
                color: #FFC107;
            }
            60% {
                color: transparent;
            }
            99% {
                color: transparent;
            }
            100% {
                color: #FFC107;
            }
        }
    </style>
@endsection

@section('main-content')
    <section class="dashboard-counts section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="clearfix">
                        <ul class="m-0 p-0 calender-btns">
                            <li>
                                <form action="#" method="get">
                                    <div class="input-group mg-b-15">
                                        <div class="input-group-prepend">
                                            <input type="text" class="form-control fc-datepicker date-style"
                                                   data-provide="datepicker" placeholder="MM/DD/YYYY" autocomplete="off"
                                                   name="search_date">
                                            <button style="float: right" class="btn btn-info btn-outline-success btn-sm"
                                                    type="submit"><i
                                                    class="fa fa-search"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </li>

                            <li>
                                <form>
                                    <a href="{{ route('assistantAppointmentList') }}"
                                       class="btn btn-danger btn-outline-danger btn-sm" style="text-decoration:none;">Reset</a>
                                </form>
                            </li>

                            <li>
                                <form>
                                    <input type="hidden" value="5" name="status">
                                    <button type="submit" class="btn btn-info btn-outline-primary btn-sm">Completed
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form>
                                    <input type="hidden" value="1" name="payment">
                                    <button type="submit" class="btn btn-info btn-outline-primary btn-sm">Paid</button>
                                </form>
                            </li>

                            {{-- <li><a href="#">Wishlist</a></li> --}}

                            <a href="{{ route('assistantAppointmentCreate') }}" class="btn btn-primary pull-right">Add
                                Appointment</a>


                        </ul>
                    </div>
                    <div class="table-responsive mt-25">
                        <table class="table new-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>MR#</th>
                                <th>Name</th>
                                <th>Appointment</th>
                                <th>Patient Status</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($appointments) > 0)
                                @foreach ($appointments as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="yellow text-center pl-0">
                                            @if($item['status']==0) <span style="color:red;"> Pending </span>
                                            @elseif($item['status']==1) <span style="color:red;"> Under Process </span>
                                            @elseif($item['status']==2) <span style="color:red;"> Accepted </span>
                                            @elseif($item['status']==3) <span style="color:red;"> Rejected </span>
                                            @elseif($item['status']==4) <span style="color:red;"> Check In </span>
                                            @elseif($item['status']==5) <span style="color:#0AF321;"> Completed </span>
                                            @endif
                                        </td>

                                        <td>{{$item['patient']['mr_number']}}</td>
                                        <td>{{$item['patient']['name']}}</td>
                                        <td> @if($item['type'] == 0) <i class="fas fa-hospital"
                                                                        style="font-size:22px; color:red; margin-right:4px;"></i> @elseif($item['type'] == 1)
                                                <i class="fas fa-camera"
                                                   style="font-size:20px; color:#708090; margin-right:4px;"></i> @endif {{$item['time_slot']}}
                                            - {{\Carbon\Carbon::parse($item['date'])->format('d M, Y')}} </td>
                                        <td>@if($item['appointment_complete'] == 0)
                                                <div
                                                    style="background-color:red;width:20px;height:20px;border-radius:50%"
                                                    title="Offline" id="offline{{$item['id']}}"></div>
                                                <div
                                                    style="background-color:green;width:20px;height:20px;border-radius:50%;display:none"
                                                    title="Online" id="online{{$item['id']}}"></div>
{{--                                                <div--}}
{{--                                                    style="background-color:blue;width:20px;height:20px;border-radius:50%;display:none"--}}
{{--                                                    title="Complete" id="complete{{$item['id']}}"></div>--}}

                                            @endif</td>
                                        <td class="d-flex">
                                            <a href="{{route('manageAssistantAppointment',['patientId'=>$item['patient_id'],'appointmentId'=>$item['id'],'practitionerId'=>$item['practitioner_id']])}}"
                                               class="manage-btn mr-1">Manage</a>
                                            <a href="{{route('assistantAppointmentEdit',$item['id'])}}"
                                               class="report-btn mr-1">Edit</a>

                                            @if($item['type'] == 1)
                                                @php $link = URL::to('/joinAppointment'.'/'.$item['patient_id'].'/'.$item['practitioner_id'].'/'.$item['id']); @endphp
                                                <button class="btn-copy btn btn-primary mr-1 btn-sm btn-copy-link"
                                                        data-clipboard-text="{{ $link }}"
                                                        onclick="successMessagePopup();">
                                                    Copy Link
                                                </button>
                                            @endif

                                            @if(isset($item['patient_visits']['0']['pdf_report'] ))
                                                @if($item['patient_visits']['0']['pdf_report'] != null)
                                                    @php  $link = URL::to('/') . '/reports/' . $item['patient_visits']['0']['pdf_report']; @endphp

                                                    <button class="btn-copy btn btn-primary btn-sm btn-copy-link"
                                                            data-clipboard-text="{{ $link }}"
                                                            onclick="successMessagePopup();">
                                                        Copy Link Prescription
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center text-capitalize text-info"><h3>No Record
                                            Found</h3></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="col-sm-3 col-lg-3 border-left-col">
                    <div class="total-case">
                        <small class="mb-17 d-inline-block grey">Total Appointments</small>
                        <div class="row">
                            <div class="col my-auto">
                                <h4 class="SourceSansProBold">{{$appointmentsCount}}</h4>
                                <small class="percentage-no"><img src="{{asset('public/images/down-percent.png')}}" class="pr-1">13.8%</small>
                            </div>
                            <div class="col text-right mt-3">
                                <img src="{{asset('public/images/total-case.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="total-case mt-0">
                        <small class="mb-17 d-inline-block grey">Completed Appointments</small>
                        <div class="row">
                            <div class="col my-auto">
                                <h4 class="SourceSansProBold">{{$completedCount}}</h4>
                                <small class="percentage-no up-percent-color"><img src="{{asset('public/images/up-percent.png')}}"
                                                                                   class="pr-1">13.8%</small>
                            </div>
                            <div class="col text-right mt-3">
                                <img src="{{asset('public/images/total-case.png')}}">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('public/assistant/js/appointment.js')}}"></script>
    <script src="{{asset('public/admin/plugins/clipboard.js-master/dist/clipboard.min.js')}}"></script>
    <script>
        $('#myTable').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": 7},
            ]
        });

        new ClipboardJS('.btn-copy');

        function successMessagePopup() {
            window.toastr.success('Link Copied!');
        }
    </script>

    <script>
        $(document).ready(function () {
            setInterval(checkPatientStatus, 5000);
        });

        function checkPatientStatus() {
            $.ajax({
                method: "GET",
                url: "{{url('assistant/checkPatientStatus')}}",
                success: function (response) {

                    if (response.status == 0) {
                        alert(response.message);
                        return false;
                    }
                    if (response.status == 1) {
                        response.appointments.forEach(function (item) {
                            if (parseInt(item.check_in) == 1 && parseInt(item.appointment_complete) == 0) {
                                $('#offline' + parseInt(item.id)).hide();
                                $('#online' + parseInt(item.id)).show();
                                $('#complete' + parseInt(item.id)).hide();
                            } else if (parseInt(item.check_in) == 0 && parseInt(item.appointment_complete) == 0) {
                                $('#online' + parseInt(item.id)).hide();
                                $('#offline' + parseInt(item.id)).show();
                                $('#complete' + parseInt(item.id)).hide();
                            } else if (parseInt(item.check_in) == 1 && parseInt(item.appointment_complete) == 1) {
                                $('#online' + parseInt(item.id)).hide();
                                $('#offline' + parseInt(item.id)).hide();
                                $('#complete' + parseInt(item.id)).show();
                            }
                        });
                    }

                }
            });
        }
    </script>

    @if(Session::has('success-message'))
        <script>
            toastr.success('{{ Session::get('success-message') }}')
        </script>
    @endif

    @if(Session::has('error-message'))
        <script>
            toastr.error('{{ Session::get('error-message') }}')
        </script>
    @endif
@endsection

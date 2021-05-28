@extends('frontend.layout.master')

@section('title')
    <title>Doctor | {{$doctor->name}}</title>
@endsection

@section('css')
@endsection

@section('main-content')

    @include('frontend.layout.header')

    <main>
        <div id="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{route('indexPage')}}">Home</a></li>
                    <li><a href="{{route('doctorsPage')}}">Doctors</a></li>
                    <li>{{$doctor->name}}</li>
                </ul>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <nav id="secondary_nav">
                        <div class="container">
                            <ul class="clearfix">
                                <li style="color: #fff;">General info</li>
                            </ul>
                        </div>
                    </nav>
                    <div id="section_1">
                        <div class="box_general_3">
                            <div class="profile">
                                <div class="row">
                                    <div class="col-lg-5 col-md-4">
                                        <figure>
                                            <img
                                                @if($doctor->image) src="{{asset('storage/app/public/'.$doctor->image)}}"
                                                style="width:260px;height:260px"
                                                @else src="{{asset('public/frontend/img/doctor_listing_3.jpg')}}"
                                                @endif class="img-fluid" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-lg-7 col-md-8">
                                        <h1>{{$doctor->name}}</h1>
                                        <small>{{$doctor->qualification->title}}</small>

                                        <ul class="contacts">
                                            @if($doctor->address != null)
                                                <li>
                                                    <h6>Address</h6>
                                                    {{$doctor->address}}
                                                </li>
                                            @endif
                                            											<li>
                                            												<h6>Phone</h6> <a href="tel://03041110366"> 0304-111-0366</a>
                                            											</li>
                                            											<li>
                                            												<h6>Email</h6>
                                                                                            info@myeonhealth.com
                                            											</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- /profile -->
                            <div class="indent_title_in">
                                <i class="pe-7s-user"></i>
                                <h3>Professional Description</h3>
                                {{-- <p>Mussum ipsum cacilds, vidis litro abertis.</p> --}}
                            </div>
                            <div class="wrapper_indent">
                                <p>{{$doctor->description}}</p>
                                <br>
                                <h6>Specialties</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="bullets">
                                            @foreach($doctor->specialties as $specialty)
                                                <li>{{ $specialty->title }}</li>
                                            @endforeach

                                        </ul>
                                    </div>

                                </div>
                                <!-- /row-->
                            </div>
                            <!-- /wrapper indent -->

                            <hr>

                            <div class="indent_title_in">
                                <i class="pe-7s-news-paper"></i>
                                <h3>Education</h3>
                                <p>{{$doctor->qualification->title}}</p>
                            </div>
                            <div class="wrapper_indent">
                                <h6>Clinics</h6>
                                <ul class="bullets">
                                    @foreach($doctor->practitionerClinics as $item)
                                        <li><strong>{{ $loop->iteration }} - {{ $item->clinic->name }} </strong> - (
                                            @foreach ($item->days as $clinic)
                                                {{ucfirst($clinic->day)}},
                                            @endforeach
                                        )
                                            ( {{ date("h:i a", strtotime($item->from_time)) }}
                                            to {{ date("h:i a", strtotime($item->to_time)) }} )
                                        </li>

                                    @endforeach

                                </ul>
                            </div>
                            <!--  End wrapper indent -->

                            <!--  /wrapper_indent -->
                        </div>
                        <!-- /section_1 -->
                    </div>
                    <!-- /box_general -->


                    <!-- /section_2 -->
                </div>
                <!-- /col -->
                <aside class="col-xl-4 col-lg-4" id="sidebar">
                    <div class="box_general_3 booking">
                        <form>
                            <div class="title">
                                <h3>Book a Visit</h3>
                                <small>Create your accout to book a visit.</small>
                            </div>
                        {{-- <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="booking_date" data-lang="en" data-min-year="2017" data-max-year="2020" data-disabled-days="10/17/2017,11/18/2017">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="booking_time" value="9:00 am">
                                </div>
                            </div>
                        </div> --}}
                        <!-- /row -->

                            <a href="{{route('patientRegisterForm')}}" class="btn_1 full-width">Book Now</a>
                        </form>
                    </div>
                    <!-- /box_general -->
                </aside>
                <!-- /asdide -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

@endsection

@section('script')
@endsection

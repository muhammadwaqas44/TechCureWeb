@extends('frontend.layout.master')

@section('title')
    <title>Chaudhry Muhammad Akram Teaching &amp; Research Hospital</title>
@endsection

@section('css')
@endsection

@section('main-content')

    <header class="header_sticky sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div id="logo_home">
                        <h1><a href="{{route('indexPage')}}" title="Findoctor"><img src="{{asset('public/frontend/img/logo.png')}}">
                            <h2>Chaudhry Muhammad Akram Teaching & Research Hospital</h2>
                        </a></h1>
                    </div>
                </div>
                <nav class="col-lg-9 col-6">
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
                    
                    <div  class="main-menu main_nav">
                        <ul>
                            <li class="submenu">
                                <a href="{{route('indexPage')}}" class="{{ (Route::currentRouteName() == 'indexPage') ? 'active-class' : '' }}">Home</a>
                            </li>
                            <li class="submenu">
                                <a href="{{route('facilitiesPage')}}" class="{{ (Route::currentRouteName() == 'facilitiesPage') ? 'active-class' : '' }}">Facilities</a>
                            </li>
                            {{-- <li class="submenu">
                                <a href="{{route('clinicsPage')}}" class="{{ (Route::currentRouteName() == 'clinicsPage' || Route::currentRouteName() == 'clinicSearch') ? 'active-class' : '' }}">Clinics</a>
                            </li> --}}
                            <li class="submenu">
                                <a href="{{route('doctorsPage')}}" class="{{ (Route::currentRouteName() == 'doctorsPage' || Route::currentRouteName() == 'doctorSearch') ? 'active-class' : '' }}">Doctors</a>
                            </li>
                            <li class="submenu">
                                <a href="{{route('homeScreen')}}" target="_blank"><button type="button" class="btn_1">Create Account</button></a>
                            </li>

                        </ul>
                    </div>
                    <!-- /main-menu -->
                </nav>
            </div>
        </div>
        <!-- /container -->
    </header>
    <!-- /header -->	

    <main id="top1">

        <div class="header-video">
            <div id="hero_video">
                <div class="content">
                    <h3>Find a Doctor!</h3>
                    <p>Search best doctors by name or Specialization
                    </p>
                    <form method="post" action="{{route('doctorSearch')}}">
                        @csrf
                        <div id="custom-search-input">
                            <div class="input-group">
                                <input type="text" name="keyword" class=" search-query" placeholder="Ex. Name, Specialization ...." required>
                                <input type="submit" class="btn_search" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <img src="{{asset('public/frontend/img/banner.jpg')}}" alt="" class="header-video--media" data-video-src="{{asset('public/frontend/video/intro')}}" data-teaser-source="{{asset('public/frontend/video/intro')}}" data-provider="" data-video-width="1920" data-video-height="750">
        </div>
        <!-- /Header video -->

        <div id="clinic1" class="container margin_120_95">
            <div class="main_title">
                <h2>Facility</h2>
                <p>We pride ourselves on offering a modern and technologically advanced medical facility with world leading equipment to provide you with the best healthcare possible</p>
            </div>
            <div class="row">

                @foreach ($facilities as $item)
                    
                    <div class="col-lg-3 col-md-6">
                        <a  class="box_cat_home" style="height:192px !important">
                            <i class="icon-info-4"></i>
                            <img @if($item->image) src="{{asset('storage/app/public/'.$item->image)}}" @else src="{{asset('public/frontend/img/icon_cat_1.svg')}}" @endif width="60" height="60" alt="">
                            <h3>{{$item->title}}</h3>
                        </a>
                    </div>

                @endforeach

                
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div id="doctor1" class="bg_color_1">
            <div class="container margin_120_95">
                <div class="main_title">
                    <h2>Doctors</h2>
                    <p></p>
                </div>
                <div class="row">

                    @foreach ($doctors as $item)
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="box_list home">
                                <figure>

                                    <a href="{{route('doctorProfilePage',$item->id)}}">
                                        <img @if($item->image) src="{{asset('storage/app/public/'.$item->image)}}" style="width:350px;height:350px" @else src="{{asset('public/frontend/img/doctor_listing_3.jpg')}}" @endif class="img-fluid" alt="">
                                    </a>
                                    <div class="preview"><span>Read more</span></div>
                                </figure>
                                <div class="wrapper">
                                    @if(isset($item->qualification->title))
                                    <small>{{$item->qualification->title}}</small>
                                    @endif
                                    <h3>{{$item->name}}</h3>
                                    {{-- <p>{{$item->address}}<br>{{$item->phone}}<br>{{$item->email}}</p> --}}
                                </div>
                                <ul>
                                    <li><a href="{{route('doctorProfilePage',$item->id)}}">Book now</a></li>
                                </ul>
                            </div>
                        </div>

                    @endforeach

                </div>
                <!-- /row -->
                <p class="text-center add_top_30"><a href="{{route('doctorsPage')}}" class="btn_1 medium">View all Doctors</a></p>
            </div>
            <!-- /container -->
        </div>
        <!-- /white_bg -->
        
        <div class="container margin_120_95">
            <div class="main_title">
                <h2>Discover the <strong>online</strong> appointment!</h2>
                <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel.</p>
            </div>
            <div class="row add_bottom_30">
                <div class="col-lg-4">
                    <div class="box_feat" id="icon_1">
                        <span></span>
                        <h3>Find a Doctor</h3>
                        <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_feat" id="icon_2">
                        <span></span>
                        <h3>View profile</h3>
                        <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_feat" id="icon_3">
                        <h3>Book a visit</h3>
                        <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                    </div>
                </div>
            </div>
            <!-- /row -->
            <p class="text-center"><a href="{{route('doctorsPage')}}" class="btn_1 medium">Find Doctor</a></p>
        </div>
        <!-- /container -->

    </main>

@endsection

@section('script')
@endsection
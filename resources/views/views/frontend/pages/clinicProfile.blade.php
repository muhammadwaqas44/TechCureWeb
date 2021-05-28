@extends('frontend.layout.master')

@section('title')
    <title>Clinic | {{$clinic->name}}</title>
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
					<li><a href="{{route('clinicsPage')}}">Clinics</a></li>
					<li>{{$clinic->name}}</li>
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
											<img @if ($clinic->logo) src="{{asset('storage/app/public/'.$clinic->logo)}}" style="width:260px;height:260px" @else src="{{asset('public/frontend/img/clinic1.jpg')}}" @endif alt="" class="img-fluid">
										</figure>
									</div>
									<div class="col-lg-7 col-md-8">
										<h1>{{$clinic->name}}</h1>
										
										
										<ul class="contacts">
											<li>
												<h6>Address</h6>
												{{$clinic->address}}
											</li>
											<li>
												<h6>Phone</h6> <a href="tel://{{$clinic->phone}}">{{$clinic->phone}}</a> 
											</li>
											<li>
												<h6>Email</h6>
												{{$clinic->email}}
											</li>
										</ul>
									</div>
								</div>
							</div>
							
							<hr>
							
							
							<div class="row">
								<div class="col-md-6">
									<div class="wrapper_indent">
										
										<h5>Specialties</h5>
										<div class="row">
											<div class="col-lg-6" >
												<ul class="bullets">
													@foreach($clinic->specialties as $specialty)
														<li>{{ $specialty->title }}</li>
													@endforeach
													
												</ul>
											</div>
											
										</div>
										<!-- /row-->
									</div>
								</div>
								<!-- /wrapper indent -->

								<div class="col-md-6">
									<div class="wrapper_indent">
										
										<h5>Facilities</h5>
										<div class="row">
											<div class="col-lg-6" >
												<ul class="bullets">
													@foreach($clinic->facilities as $facility)
														<li>{{ $facility->title }}</li>
													@endforeach
													
												</ul>
											</div>
											
										</div>
										<!-- /row-->
									</div>
								</div>
								<!-- /wrapper indent -->
							</div>

							<hr>

							<div class="indent_title_in">
								<i class="pe-7s-user"></i>
								<h3>Doctors</h3>
							</div>
							<div class="wrapper_indent">
								
								<ul class="bullets">
                                    @foreach($clinic->getPractitioners as $item)
                                        <li><strong>{{ $loop->iteration }} - {{ $item->name }} </strong> -  ({{ $item->phone }}) -  ({{ $item->email }})</li>
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
							<h3>Create Account</h3>
							<small>Register Your Clinic Here</small>
							</div>
							
						
							<a href="{{route('homeScreen')}}" class="btn_1 full-width">Register</a>
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
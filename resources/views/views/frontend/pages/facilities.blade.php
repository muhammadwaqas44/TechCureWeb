@extends('frontend.layout.master')

@section('title')
    <title>Facilities </title>
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
					<li>Facilities</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60">
			<div class="row">
				<div id="clinic1" class="container margin_120_95" style="padding:0% !important">
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
					<nav aria-label="" class="add_top_20" style="display: flex;justify-content: center;">
						{{$facilities->links()}}
					</nav>
				</div>
				<!-- /container -->
			</div>
		</div>
	</main>

@endsection

@section('script')
@endsection
@extends('frontend.layout.master')

@section('title')
    <title>Clinics</title>
@endsection

@section('css')
@endsection

@section('main-content')

    @include('frontend.layout.header')

    <main>
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{route('clinicSearch')}}">
                            @csrf
                            <div class="search_bar_list">
                                <input type="text" value="{{$keyword}}" name="keyword" class="form-control" placeholder="Clinic Name ..." required>
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /results -->
    
            
        <div class="container margin_60_35">
            <div class="row">
                @if(count($clinics)>0)
                    <div class="col-lg-12">
                        <div class="row">

                            @foreach ($clinics as $item)

                                <div class="col-md-4">
                                    <div class="box_list wow fadeIn">
                                        <figure>
                                            <a href="{{route('clinicProfilePage',$item->id)}}"><img @if ($item->logo) src="{{asset('storage/app/public/'.$item->logo)}}" style="width:350px;height:350px" @else src="{{asset('public/frontend/img/clinic1.jpg')}}" @endif class="img-fluid" alt=""></a>
                                        </figure>
                                        <div class="wrapper">

                                            <h3><a href="{{route('clinicProfilePage',$item->id)}}">{{$item->name}}</a></h3>

                                            <p>{{$item->address}}<br>{{$item->phone}}<br>{{$item->email}}</p>

                                        </div>
                                    </div>
                                </div>
                                <!-- /box_list -->

                            @endforeach
                            
                        </div>
                        <!-- /row -->
                    </div>
                @else 
                    <div class="col-md-12 text-center">
                        No Record Found.
                    </div>
                @endif
                
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

@endsection

@section('script')
@endsection
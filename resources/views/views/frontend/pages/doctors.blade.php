@extends('frontend.layout.master')

@section('title')
    <title>Doctors</title>
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
                        <form method="POST" action="{{route('doctorSearch')}}">
                            @csrf
                            <div class="search_bar_list">
                                <input type="text" name="keyword" class="form-control" placeholder="Ex. Specialist, Name, Doctor..." required>
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
                @if(count($doctors)>0)
                    <div class="col-lg-12">
                        <div class="row">

                            @foreach ($doctors as $item)

                                <div class="col-md-4">
                                    <div class="box_list wow fadeIn">
                                        <figure>
                                            <a href="{{route('doctorProfilePage',$item->id)}}">
                                                <img @if($item->image) src="{{asset('storage/app/public/'.$item->image)}}" style="width:350px;height:350px" @else src="{{asset('public/frontend/img/doctor_listing_3.jpg')}}"  @endif class="img-fluid" alt="">
                                                <div class="preview"><span>Read more</span></div>
                                            </a>
                                        </figure>
                                        <div class="wrapper">
                                            <small>{{$item->qualification->title}}</small>
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

                        <nav aria-label="" class="add_top_20" style="display: flex;justify-content: center;">
                            {{$doctors->links()}}
                        </nav>
                        <!-- /pagination -->
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
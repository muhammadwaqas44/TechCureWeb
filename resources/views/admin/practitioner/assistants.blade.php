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

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="assistantTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Specialties</th>
                                        <th>Practitioners</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assistants as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}} </td>
                                            <td>{{$item->phone}} </td>
                                            <td>
                                                @if(count($item->specialties) > 0)
                                                @foreach($item->specialties as $specialty)
                                                    <div class="permission-tag"> <li> {{ $specialty->title }} </li> </div>
                                                @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($item->practitioners) > 0)
                                                @foreach($item->practitioners as $practitioner)
                                                    <div class="permission-tag"> <li> {{ $practitioner->name }} </li> </div>
                                                @endforeach
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td> 
                                                @if($item->status==1)Active @else In-Active @endif
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
    <script src="{{asset('public/admin/js/practitioner.js')}}"></script>
@endsection
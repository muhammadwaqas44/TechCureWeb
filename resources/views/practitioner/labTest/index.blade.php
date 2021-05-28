@extends('layouts.practitioner')

@section('extra-css')
@endsection

@section('main-content')
    <div class="content-wrapper mt-3">
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
                        <div class="card-header">
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <a href="{{ route('practitionerLabTestCreate') }}"
                                       class="btn btn-primary pull-right">Add Favourite Lab Test</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Title</th>
                                    <th>Recommended Lab</th>
                                    <th>Type</th>
                                    <th>Instructions</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($labTests->count() > 0)
                                    @foreach ($labTests as $item)
                                        <tr>

                                            <td>{{$loop->iteration}}</td>
                                            <td>{{isset($item->labTest->title)?$item->labTest->title:'--'}}</td>
                                            <td>{{isset($item->labTest->lab->title)?$item->labTest->lab->title:'--'}}</td>
                                            <td>{{isset($item->labTest->type)?$item->labTest->type:'--'}}</td>
                                            <td>{{isset($item->labTest->instructions)?$item->labTest->instructions:'--'}}</td>
                                            <td>
                                                <a class="btn btn-danger" onclick="deleteFunction('{{$item->id}}')"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
    <script src="{{asset('public/practitioner/js/labTest.js')}}"></script>
@endsection

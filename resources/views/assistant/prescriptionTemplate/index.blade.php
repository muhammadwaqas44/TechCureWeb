@extends('layouts.assistant')

@section('extra-css')
@endsection

@section('main-content')
     <div class="content-wrapper">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header mt-2">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('assistantDashboard')}}">Dashboard</a></li>
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
                                <div class="col-lg-6">
                                    <h3 class="pull-left"> All Prescription Templates </h3>
                                </div>
                                <div class="col-lg-6">
                                    <a href="{{ route('assistantPrescriptionTemplateCreate') }}" class="btn btn-primary pull-right">Add Prescription Template</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Favourite</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prescriptionTemplates as $prescriptionTemplate)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$prescriptionTemplate->title}}</td>
                                                <td>
                                                    @if($prescriptionTemplate->status==1)Active @else In-Active @endif
                                                </td>
                                                <td>
                                                    @if($prescriptionTemplate->is_favourite==1)Yes @else No @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-success" href="{{route('assistantPrescriptionTemplateEdit', $prescriptionTemplate->id)}}"><i class="fa fa-edit" ></i></a>
                                                    <a class="btn btn-danger" onclick="deleteFunction('{{$prescriptionTemplate->id}}')"><i class="fa fa-trash" ></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/assistant/js/prescriptionTemplate.js')}}"></script>
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

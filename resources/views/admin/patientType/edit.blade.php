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
                        <div class="card-header">
                            <h3 class="card-title">Edit Patient Type</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('patientTypeUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                        
                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Title <span style="color:red">*</span></label>
                                                <input type="text" name="title" id="title"
                                                    class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Title" value="{{ $patientType->title }}" required>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Discount (%) <span style="color:red">*</span></label>
                                                <input type="number" name="discount_percentage" id="discount_percentage"
                                                    class="form-control {{ $errors->has('discount_percentage') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Discount Percentage" value="{{ $patientType->discount_percentage }}" required>
                                                @if ($errors->has('discount_percentage'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('discount_percentage') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Start Date </label>
                                            <div class="input-group date">
                                                <input type="text" name="start_date" id="start_date" 
                                                    class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Start Date" @if(isset($patientType->start_date)) value="{{date('m/d/Y', strtotime($patientType->start_date)) }}" @else value="{{ old('start_date') }}" @endif>
                                                <span class="input-group-addon">
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                                @if ($errors->has('start_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('start_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>End Date </label>
                                            <div class="input-group date">
                                                <input type="text" name="end_date" id="end_date" 
                                                    class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter End Date" @if(isset($patientType->end_date)) value="{{date('m/d/Y', strtotime($patientType->end_date)) }}" @else value="{{ old('end_date') }}" @endif>
                                                <span class="input-group-addon">
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                                @if ($errors->has('end_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('end_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                                            <div class="form-group ">
                                                <label>Status <span style="color:red">*</span></label>
                                                <select name="status" id="status"
                                                    class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Select Option</option>
                                                    <option {{ ($patientType->status == 1)? 'Selected':'' }} value="1">Active
                                                    </option>
                                                    <option {{ ($patientType->status == 0)? 'Selected':'' }} value="0">In-Active
                                                    </option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                        
                                    </div>


                                <div class="col-lg-12" >
                                    <input type="hidden" name="patient_type_id" value="{{$patientType->id}}">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/admin/js/patientType.js')}}"></script>
@endsection
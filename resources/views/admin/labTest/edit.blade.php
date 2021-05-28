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
                            <h3 class="card-title">Edit Lab Test</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('labTestUpdate') }}" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Title <span style="color:red">*</span></label>
                                            <input type="text" name="title" id="title"
                                                   class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Title" value="{{ $labTest->title }}" required>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Type <span style="color:red">*</span></label>
                                            <select name="type_id" id="type_id"
                                                    class="form-control {{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                            >
                                                <option value="" selected disabled>Select Lab</option>
                                                @foreach($labTestTypes as $labTestType)
                                                    <option
                                                        value="{{$labTestType->id}}" {{ ($labTest->type_id== $labTestType->id) ? 'selected' : '' }}>{{$labTestType->title}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('type_id'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('type_id') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Status <span style="color:red">*</span></label>
                                            <select name="status" id="status"
                                                    class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                    required>
                                                <option value="" selected disabled>Select Option</option>
                                                <option {{ ($labTest->status == 1)? 'Selected':'' }} value="1">Active
                                                </option>
                                                <option {{ ($labTest->status == 0)? 'Selected':'' }} value="0">In-Active
                                                </option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Fasting <span style="color:#ff0000">*</span></label>
                                            <select name="fasting" id="fasting"
                                                    class="form-control {{ $errors->has('fasting') ? ' is-invalid' : '' }}"
                                                    required>
                                                <option selected
                                                        value="1" {{ ($labTest->fasting == '1') ? 'selected' : '' }}>
                                                    True
                                                </option>
                                                <option value="0" {{ ($labTest->fasting == '0') ? 'selected' : '' }}>
                                                    False
                                                </option>
                                            </select>
                                            @if ($errors->has('fasting'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('fasting') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 multiselect-options">
                                        <div class="form-group">
                                            <label>Recommended Lab </label>
                                            <select name="lab_id" id="lab_id"
                                                    class="form-control {{ $errors->has('lab_id') ? ' is-invalid' : '' }}"
                                            >
                                                <option value="" selected disabled>Select Lab</option>
                                                @foreach($labs as $lab)
                                                    <option
                                                        value="{{$lab->id}}" {{ ($labTest->lab_id == $lab->id) ? 'selected' : '' }}>{{$lab->title}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('lab_id'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lab_id') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Instructions</label>
                                            <textarea rows="5" name="instructions"
                                                      style="width:100% !important">{{ $labTest->instructions }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Description</label>
                                            <textarea rows="5" name="description"
                                                      style="width:100% !important">{{ $labTest->description }}</textarea>
                                        </div>
                                    </div>


                                </div>


                                <div class="col-lg-12">
                                    <input type="hidden" name="labTest_id" value="{{$labTest->id}}">
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
    <script src="{{asset('public/admin/js/labTest.js')}}"></script>
@endsection



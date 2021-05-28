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
                            <h3 class="card-title">Edit Duration</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('durationUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Duration <span style="color:red">*</span></label>
                                                <input type="text" name="duration" id="duration"
                                                    class="form-control {{ $errors->has('duration') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Duration" value="{{ $duration->duration }}" required>
                                                @if ($errors->has('duration'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('duration') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Status <span style="color:red">*</span></label>
                                                <select name="status" id="status"
                                                    class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Select Option</option>
                                                    <option {{ ($duration->status == 1)? 'Selected':'' }} value="1">Active
                                                    </option>
                                                    <option {{ ($duration->status == 0)? 'Selected':'' }} value="0">In-Active
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
                                    <input type="hidden" name="duration_id" value="{{$duration->id}}">
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
    <script src="{{asset('public/admin/js/duration.js')}}"></script>
@endsection
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
                            <h3 class="card-title">Edit Prescription Template</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('prescriptionTemplateUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                        
                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Title <span style="color:red">*</span></label>
                                                <input type="text" name="title" id="title"
                                                    class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Title" value="{{ $prescriptionTemplate->title }}" required>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Practitioners <span style="color:red">*</span></label>
                                            <select name="practitioner_id" id="practitioner_id" class="form-control {{ $errors->has('practitioner_id') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Practitioner</option>
                                                @foreach ($practitioners as $practitioner)
                                                    <option @if($prescriptionTemplate->practitioner_id == $practitioner->id) selected @endif value="{{ $practitioner->id }}">{{ $practitioner->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('practitioner_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('practitioner_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Description <span style="color:red">*</span></label>
                                            <textarea name="description" maxlength="5000" id="description" style="resize:none"
                                                class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="5"
                                                placeholder="Enter Description" required>{{ $prescriptionTemplate->description }}</textarea>
                                            @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Status <span style="color:red">*</span></label>
                                                <select name="status" id="status"
                                                    class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Select Option</option>
                                                    <option {{ ($prescriptionTemplate->status == 1)? 'Selected':'' }} value="1">Active
                                                    </option>
                                                    <option {{ ($prescriptionTemplate->status == 0)? 'Selected':'' }} value="0">In-Active
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


                                <div class="col-lg-12 mt-3">
                                    <input type="hidden" name="prescription_template_id" value="{{$prescriptionTemplate->id}}">
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
    <script src="{{asset('public/admin/js/prescriptionTemplate.js')}}"></script>
@endsection
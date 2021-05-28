@extends('layouts.assistant')

@section('extra-css')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('main-content')
     <div class="content-wrapper mt-2">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content mr-2 ml-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Prescription Template</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('assistantPrescriptionTemplateUpdate') }}" method="post">
                                {{csrf_field()}}

                                    <div class="row" style="width:100%">
                                        <div class="col-sm-12 col-md-12 col-lg-12 multiselect-options">
                                            <div class="form-group">
                                                <label>Practitioners <span style="color:red">*</span></label>
                                                <select name="practitioner_id" required id="practitioner_id" class="form-control {{ $errors->has('practitioner_id') ? ' is-invalid' : '' }}" title="Select Practitioner" >
                                                    <option value="" selected disabled>Select Practitioner</option>
                                                    @foreach($practitioners as $practitioner)
                                                        <option value="{{ $practitioner->id }}" {{ ($prescriptionTemplate->practitioner_id == $practitioner->id) ? 'selected' : '' }}>{{ $practitioner->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('practitioner_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('practitioner_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
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

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label>Description <span style="color:red">*</span></label>
                                            <textarea name="description" id="description"
                                                class="form-control textarea {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="5"
                                                placeholder="Enter Description" required>{{ $prescriptionTemplate->description }}</textarea>
                                            @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
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

                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                                            <div class="form-group ">
                                                <label>Favourite? <span style="color:red">*</span></label>
                                                <select name="is_favourite" id="is_favourite"
                                                    class="form-control {{ $errors->has('is_favourite') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Select Favourite</option>
                                                    <option {{ ($prescriptionTemplate->is_favourite == 1)? 'Selected':'' }} value="1">Yes
                                                    </option>
                                                    <option {{ ($prescriptionTemplate->is_favourite == 0)? 'Selected':'' }} value="0">No
                                                    </option>
                                                </select>
                                                @if ($errors->has('is_favourite'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('is_favourite') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>


                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="prescription_template_id" value="{{$prescriptionTemplate->id}}">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
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
    <script src="{{asset('public/assistant/js/prescriptionTemplate.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/vco1c3zzq3bmkufcmoilf5f7mnuv7hxqiqtlfgb910jgpywc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{--    <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>--}}
    <script>
        // $(function () {
        // // Summernote
        //     $('.textarea').summernote({height: 250});
        // });

        tinymce.init({
            selector: '.textarea',
            plugins: 'link lists code visualblocks table hr image template',
            toolbar: 'undo redo | styleselect | bold italic strikethrough backcolor | bullist numlist link image hr | code',
            height: 'calc(70vh - 4rem)',
            setup: function (editor) {

                var val;

                editor.on('focus', function(e) {
                    val = editor.getContent();
                });

                editor.on('blur', function(e) {
                    editor.save();
                    if(val!=editor.getContent()){
                        $(this).submit();
                    }
                });

                editor.on('change', function () {
                    editor.save();
                });

            }
        });
    </script>
@endsection
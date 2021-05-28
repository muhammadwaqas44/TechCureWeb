@extends('layouts.assistant')

@section('extra-css')
    <style>
        .required-star {
            color: red;
        }

        .full-width-select .select2-container, .full-width-select .selection {
            width: 100% !important;
        }

        .select2-container {
            width: 100% !important;
        }
        .selection{
            width: 100% !important;
        }

    </style>
@endsection

@section('main-content')
    <div class="content-wrapper m-3">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('assistantDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Favourite Lab Test</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('assistantLabTestStore') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Practitioner <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="practitioner_id" id="practitioner_id"
                                                    class="form-control w-100 {{ $errors->has('practitioner_id') ? ' is-invalid' : '' }}"
                                                    title="Select Practitioner" required>
                                                <option value="">Select Practitioner</option>
                                                @foreach($practitioners as $practitioner)
                                                    <option value="{{ $practitioner->id }}">{{ $practitioner->name }}</option>
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
                                            <label>Lab Tests <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="lab_tests[]" id="lab_tests" multiple="multiple"
                                                    class="selectpicker form-control w-100 {{ $errors->has('lab_tests') ? ' is-invalid' : '' }}"
                                                    title="Select Lab Tests" required>
                                                @foreach($labTests as $labTest)
                                                    <option value="{{ $labTest->id }}">{{ $labTest->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('lab_tests'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lab_tests') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
    <script src="{{asset('public/practitioner/js/labTest.js')}}"></script>
@endsection



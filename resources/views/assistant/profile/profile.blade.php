@extends('layouts.assistant')

@section('extra-css')
     <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>

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
    <div class="m-3">
        <div class="content-wrapper">
            {{-- Header/BreadCrumbs --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Edit Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('assistantDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
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
                                <h3 class="card-title">Edit Profile</h3>
                            </div>

                            <div class="card-body">
                                <form role="form" class="row" action="{{ route('assistantUpdateProfile') }}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    <div class="row" style="width:100%">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Name <span class="required-star">*</span></label>
                                                <input type="text" name="name" id="name"
                                                       class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Name"
                                                       value="{{Auth::guard('assistant')->user()->name}}" required>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Email <span class="required-star">*</span></label>
                                                <input type="text" name="email" id="email" disabled
                                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                       placeholder="Enter Email"
                                                       value="{{ Auth::guard('assistant')->user()->email }}"
                                                       required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Phone <span style="color:red">*</span></label>
                                                <input type="text" placeholder="Enter Phone "
                                                       data-inputmask="'mask': '0999-9999999'" maxlength="12"
                                                       class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                       name="phone"
                                                       class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                       value="{{ Auth::guard('assistant')->user()->phone }}"
                                                       required>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 full-width-select">
                                            <div class="form-group">
                                                <label>Specialties </label>
                                                <div class="cleafix"></div>
                                                <select name="specialties[]" id="specialties" multiple
                                                        data-live-search="true"
                                                        class="selectpicker form-control  {{ $errors->has('specialties') ? ' is-invalid' : '' }} ">
                                                    @foreach($specialties as $specialty)
                                                        <option value="{{$specialty->id}}"
                                                                @foreach(Auth::guard('assistant')->user()->specialties as $practitionerSpecialty)
                                                                @if($specialty->id == $practitionerSpecialty->id) selected @endif
                                                            @endforeach
                                                        >
                                                            {{ $specialty->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('specialties'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('specialties') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6 multiselect-options">
                                            <div class="form-group">
                                                <label>Qualification <span style="color:red">*</span></label>
                                                <select name="qualification_id" id="qualification_id"
                                                        class="form-control {{ $errors->has('qualification_id') ? ' is-invalid' : '' }}"
                                                        title="Select Qualification" required>
                                                    <option value="" selected disabled>Select Qualification</option>
                                                    @foreach($qualifications as $qualification)
                                                        <option
                                                            value="{{ $qualification->id }}" {{ (Auth::guard('assistant')->user()->qualification_id == $qualification->id) ? 'selected' : '' }}>{{ $qualification->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('qualification_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qualification_id') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 full-width-select">
                                            <div class="form-group">
                                                <label>Practitioners </label>
                                                <div class="cleafix"></div>
                                                <select name="practitioners[]" id="practitioners" multiple
                                                        data-live-search="true"
                                                        class="selectpicker form-control  {{ $errors->has('practitioners') ? ' is-invalid' : '' }} ">
                                                    @foreach($practitioners as $specialty)
                                                        <option value="{{$specialty->id}}"
                                                                @foreach(Auth::guard('assistant')->user()->practitioners as $practitioner)
                                                                @if($specialty->id == $practitioner->id) selected @endif
                                                            @endforeach
                                                        >
                                                            {{ $specialty->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('practitioners'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('practitioners') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Address</label>
                                                <textarea rows="3" name="address"
                                                          class=" {{ $errors->has('address') ? ' is-invalid' : '' }} "
                                                          style="width:100% !important">{{ Auth::guard('assistant')->user()->address }}</textarea>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group ">
                                                <label>Description</label>
                                                <textarea rows="5" name="description"
                                                          class=" {{ $errors->has('description') ? ' is-invalid' : '' }} "
                                                          style="width:100% !important">{{ Auth::guard('assistant')->user()->description }}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Profile Image</label>
                                                <input accept="image/*" type="file"
                                                       class="form-control  {{ $errors->has('image') ? ' is-invalid' : '' }} dropify"
                                                       name="image" @if (Auth::guard('assistant')->user()->image)
                                                       data-default-file="{{asset('storage/app/public/'.Auth::guard('assistant')->user()->image)}}" @endif>
                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="width:100%">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="assistant_id"
                                                   value="{{Auth::guard('assistant')->user()->id}}"/>
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
    </div>
@endsection

@section('scripts')
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="{{asset('public/assistant/js/assistant.js')}}"></script>
    <script>
        // $('#days').select2();
        // $('#specialties').select2();
        // $('.dropify').dropify();

        // $(':input').inputmask();
        // $('#from_time').datetimepicker({
        //     format: 'LT',
        //     pickDate: false,
        //     pickTime: true,
        //     // useSeconds: false,
        //     // format: 'hh:mm',
        //     stepping: 15 //will change increments to 15m, default is 1m
        // });
        // $('#to_time').datetimepicker({
        //     format: 'LT',
        //     pickDate: false,
        //     pickTime: true,
        //     // useSeconds: false,
        //     // format: 'hh:mm',
        //     stepping: 15 //will change increments to 15m, default is 1m
        // });
    </script>
@endsection




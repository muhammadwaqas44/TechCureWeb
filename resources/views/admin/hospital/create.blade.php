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
                            <h3 class="card-title">Create Hospital</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('hospitalStore') }}" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <span style="color:red">*</span></label>
                                            <input type="text" name="title" id="title"
                                                   class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Name" value="{{ old('title') }}" required>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Email <span style="color:red">*</span></label>
                                            <input type="email" name="email" id="email"
                                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter Email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone <span style="color:red">*</span></label>
                                            <input type="text" placeholder="Enter Phone "
                                                   data-inputmask="'mask': '0999-9999999'" maxlength="12"
                                                   class="form-control {{ $errors->has('contact_no') ? ' is-invalid' : '' }}"
                                                   name="contact_no"
                                                   class="form-control {{ $errors->has('contact_no') ? ' is-invalid' : '' }}"
                                                   value="{{ old('contact_no') }}" required>
                                            @if ($errors->has('contact_no'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('contact_no') }}</strong>
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
                                                <option value="" selected disabled>Status</option>
                                                <option value="1" {{ (old('status') == '1') ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ (old('status') == '0') ? 'selected' : '' }}>
                                                    In-Active
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

                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Departments <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="departments[]" id="departments" multiple="multiple"
                                                    class="selectpicker form-control {{ $errors->has('departments') ? ' is-invalid' : '' }}"
                                                    title="Select Specialties" required>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                            @foreach(old('departments', ['value']) as $id)
                                                            @if($department->id == $id) selected @endif
                                                        @endforeach
                                                    >{{ $department->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('departments'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('departments') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Facilities <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="facilities[]" id="facilities" multiple="multiple"
                                                    class="selectpicker form-control {{ $errors->has('facilities') ? ' is-invalid' : '' }}"
                                                    title="Select facilities" required>
                                                @foreach($facilities as $facility)
                                                    <option value="{{ $facility->id }}"
                                                            @foreach(old('facilities', ['value']) as $id)
                                                            @if($facility->id == $id) selected @endif
                                                        @endforeach
                                                    >{{ $facility->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('facilities'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('facilities') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Days <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="days[]" id="days" multiple="multiple"
                                                    class="selectpicker form-control {{ $errors->has('days') ? ' is-invalid' : '' }}"
                                                    title="Select days" required>

                                                @foreach($days as $key=>$value)
                                                    <option value="{{$value}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('days'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('days') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Timing <span style="color:red">*</span></label>
                                            <select name="all_time" id="all_time"
                                                    class="form-control {{ $errors->has('all_time') ? ' is-invalid' : '' }}"
                                                    title="Select" required>
                                                <option value="" selected disabled>Select</option>
                                                <option value="1">24/7</option>
                                                <option value="0">Timing (Form-To)</option>
                                            </select>
                                            @if ($errors->has('all_time'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('all_time') }}</strong>
                                                    </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div id="timing_open_close" style="display: none; width: 100%">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="bootstrap-timepicker">
                                                        <div class="form-group">
                                                            <label>Opening Time <span style="color:red">*</span></label>
                                                            <div class="input-group date from_time" id="from_time"
                                                                 data-target-input="nearest">
                                                                <input type="text" name="from_time"
                                                                       class="form-control datetimepicker-input"
                                                                       data-target="#from_time"
                                                                       value="{{ old('from_time') }}"
                                                                />

                                                                <div class="input-group-append" data-target="#from_time"
                                                                     data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="far fa-clock"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="bootstrap-timepicker">
                                                        <div class="form-group">
                                                            <label>Closing Time <span style="color:red">*</span></label>
                                                            <div class="input-group date to_time" id="to_time"
                                                                 data-target-input="nearest">
                                                                <input type="text" name="to_time"
                                                                       class="form-control datetimepicker-input"
                                                                       data-target="#to_time"
                                                                       value="{{ old('to_time') }}"
                                                                />

                                                                <div class="input-group-append" data-target="#to_time"
                                                                     data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="far fa-clock"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Address</label>
                                            <textarea rows="2" name="address"
                                                      style="width:100% !important">{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group ">
                                            <label>Description</label>
                                            <textarea rows="5" name="description"
                                                      style="width:100% !important">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
    <script src="{{asset('public/admin/js/hospital.js')}}"></script>
@endsection



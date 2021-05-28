@extends('layouts.patient')

@section('extra-css')
    <style>
        .invalid-feedback{
            display: block !important;
        }
    </style>
@endsection

@section('main-content')
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
                            <li class="breadcrumb-item"><a href="{{route('patientDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                {{-- Row For Profile Edit --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Profile</h3>
                            </div>

                            <form role="form" method="post" action="{{ route('patientUpdateProfile') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputName">Name</label><span style="color:red">*</span>
                                                <input type="text" class="form-control" id="" name="patient_name" placeholder="Enter name" value="{{ Auth::guard('patient')->user()->name }}" required>
                                                @if ($errors->has('patient_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('patient_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label><span style="color:red">*</span>
                                                <input type="email" class="form-control" id="" name="patient_email" placeholder="Enter email" value="{{ Auth::guard('patient')->user()->email }}"  readonly>
                                                @if ($errors->has('patient_email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('patient_email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputOldPass">Old Password</label><span style="color:red">*</span>
                                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password" required>
                                                <span toggle="#old_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                @if ($errors->has('old_password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('old_password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputNewPass">New Password</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                                                <span toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                @if ($errors->has('new_password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('new_password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-primary float-right">Update</button>
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
<script>
    $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
    });
</script>
@endsection
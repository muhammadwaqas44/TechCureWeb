@extends('layouts.practitioner')

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
        <div class="content-header mt-4">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Change Password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form role="form" method="post" action="{{ route('practitionerUpdateChangePassword') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputOldPass"><b>Old Password</b> <span style="color:red">*</span></label>
                                                <input type="password" class="form-control {{ $errors->has('old_password') ? ' is-invalid' : '' }}" id="old_password" name="old_password" placeholder="Enter Old Password" required>
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
                                                <label for="exampleInputNewPass"><b>New Password</b> <span style="color:red">*</span></label>
                                                <input type="password" class="form-control {{ $errors->has('new_password') ? ' is-invalid' : '' }}" id="new_password" name="new_password" placeholder="Enter New Password" required>
                                                <span toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                @if ($errors->has('new_password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('new_password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputNewPass"><b>Confirm New Password</b> <span style="color:red">*</span></label>
                                                <input type="password" class="form-control {{ $errors->has('confirm_new_password') ? ' is-invalid' : '' }}" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm New Password" required>
                                                <span toggle="#confirm_new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                @if ($errors->has('confirm_new_password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="mb-4 mr-3">
                                    <button type="submit" class="btn btn-primary float-left mb-2 ml-4">Update</button>
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

@if(Session::has('success-message'))
<script>
   toastr.success('{{  Session::get('success-message') }}')
</script>
@endif

@if(Session::has('error-message'))
<script>
   toastr.error('{{  Session::get('error-message') }}')
</script>
@endif
@endsection
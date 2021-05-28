@extends('layouts.backend')

@section('extra-css')
    <style>
        .required-star{
            color: red;
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
                            <h3 class="card-title">Edit User</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('userUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                        
                                <div class="row" style="width:100%">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <span class="required-star">*</span></label>
                                            <input type="text" name="name" id="name"
                                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Name" value="{{$user->name}}" required>
                                            
                                        </div>
                                    </div>
        
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Email <span class="required-star">*</span></label>
                                            <input type="text" name="email" id="email" disabled
                                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Email" value="{{ $user->email }}" required>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" style="width:100%">
                                    <div class="form-group col-lg-6">
                                        <label>Status <span style="color:red">*</span></label>
                                        <select name="status" id="status"
                                            class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                            <option value="" selected disabled>Select Option</option>
                                            <option {{ ($user->status == 1)? 'Selected':'' }} value="1">Active
                                            </option>
                                            <option {{ ($user->status == 0)? 'Selected':'' }} value="0">In-Active
                                            </option>
                                        </select>
                                       
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Permissions <span class="required-star">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="permissions[]" id="permissions" multiple data-live-search="true"
                                                class="selectpicker form-control" required>
                                                @foreach($permissions as $permission)
                                                    <option value="{{$permission->id}}"
                                                        @foreach($user->permissions as $userPermission)
                                                            @if($permission->id == $userPermission->id) selected @endif
                                                        @endforeach
                                                        >
                                                        {{ $permission->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="col-md-12" style="width:100%">
                                    <label> Change Password? </label>
                                    <input type="checkbox" id="change_password" onclick="adminChangePassword()">
                                </div>

                                <br/>
                                <div class="row" id="password_box" style="width:100%;display:none;">
                                    <div class="form-group col-lg-6">
                                        <label>Password <span class="required-star"></span></label>
                                        <input type="password" name="password" id="password"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            placeholder="Enter Password" value="{{ old('password') }}" >
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
        
                                    <div class="form-group col-lg-6">
                                        <label>Confirm Password <span class="required-star"></span></label>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                                            placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}" >
                                        @if ($errors->has('confirm_password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="user_id" value="{{$user->id}}" />
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
    <script src="{{asset('public/admin/js/user.js')}}"></script>
@endsection




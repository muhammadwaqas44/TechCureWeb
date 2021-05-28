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
                            <h3 class="card-title">Create User</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('userStore') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                        
                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Name <span style="color:red">*</span></label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    placeholder="Enter Name" value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
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
                                        <div class="form-group col-lg-6">
                                            <label>Password <span style="color:red">*</span></label>
                                            <input type="password" name="password" id="password"
                                                class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Password" value="{{ old('password') }}" required>
                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
            
                                        <div class="form-group col-lg-6">
                                            <label>Confirm Password <span style="color:red">*</span></label>
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}" required>
                                            <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            @if ($errors->has('confirm_password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="row" style="width:100%">

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label>Status <span style="color:red">*</span></label>
                                                <select name="status" id="status"
                                                    class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                    <option value="" selected disabled>Status</option>
                                                    <option value="1" {{ (old('status') == '1') ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ (old('status') == '0') ? 'selected' : '' }}>In-Active</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Permissions <span style="color:red">*</span></label>
                                                <div class="cleafix"></div>
                                                <select name="permissions[]" id="permissions" multiple="multiple" class="selectpicker form-control {{ $errors->has('permission') ? ' is-invalid' : '' }}" title="Select Permissions" required>
                                                    @foreach($permissions as $permission)
                                                        <option value="{{ $permission->id }}" 
                                                            @foreach(old('permissions', ['value']) as $id)
                                                                @if($permission->id == $id) selected @endif
                                                            @endforeach
                                                            
                                                        >{{ $permission->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('permissions'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('permissions') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
            
                                    </div>


                                <div class="col-lg-12">
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
    <script src="{{asset('public/admin/js/user.js')}}"></script>
@endsection



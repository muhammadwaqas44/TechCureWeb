@extends('layouts.practitioner')

@section('extra-css')
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
        <section class="content ml-2 mr-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Payment</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerPaymentUpdate', $payment->id) }}" method="post">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Patient Name </label>
                                            <input type="text" class="form-control"  readonly value="{{$payment->patient->name}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Fee </label>
                                            <input type="text"  class="form-control"  readonly value="PKR {{$payment->amount}}">
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Payment Method <span style="color:red">*</span></label>
                                            <select name="payment_method" id="payment_method"
                                                    class="form-control {{ $errors->has('payment_method') ? ' is-invalid' : '' }}"
                                                    required>
                                                <option
                                                    value="Cash" {{ ($payment->payment_method == 'Cash') ? 'selected' : '' }}>
                                                    Cash
                                                </option>
                                                <option
                                                    value="Online" {{ ($payment->payment_method == 'Online') ? 'selected' : '' }}>
                                                    Online
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Payment Status <span style="color:red">*</span></label>
                                            <select name="payment_status" id="payment_status"
                                                    class="form-control {{ $errors->has('payment_status') ? ' is-invalid' : '' }}"
                                                    required>
                                                <option
                                                    value="Paid" {{ ($payment->payment_status == 'Paid') ? 'selected' : '' }}>
                                                    Paid
                                                </option>
                                                <option
                                                    value="Unpaid" {{ ($payment->payment_status == 'Unpaid') ? 'selected' : '' }}>
                                                    Unpaid
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <input value="{{$payment->id}}" name="payment_id" type="hidden">

                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
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


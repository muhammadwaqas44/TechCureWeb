@extends('layouts.patient')

@section('extra-css')

@endsection

@section('main-content')
     <div class="content-wrapper">
        {{-- Header/BreadCrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Payment View</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('patientDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Payment View</li>
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
                            <div class="row pt-10">
                                <div class="col-lg-12">
                                    <span><strong>Appointment Information</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row" style="width:100%">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Practitioner : </strong></span> <span>{{$appointmentInfo['practitioner_name']}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Patient : </strong></span> <span>{{$appointmentInfo['patient_name']}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Clinic : </strong></span> <span>{{$appointmentInfo['clinic_name']}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Date : </strong></span> <span>{{$appointmentInfo['date']}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Time Slot: </strong></span> <span>{{$appointmentInfo['time_slot']}}</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Type : </strong></span> <span>@if($appointmentInfo['type'] == 0) Physical @else Online @endif</span>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span><strong>Amount: </strong></span> <span>{{$appointmentInfo['amount']}} PKR</span>
                                </div>

                            

                            </div>

                            <div class="row mt-3" style="width:100%">
                                <form method="post" action="{{ $PostURL }}" style="text-align:right;width:100%">
                                    <input type="hidden" name="pp_Version" value="{{ $finalData['pp_Version'] }}"/>
                                    <input type="hidden" name="pp_TxnType" value="{{ $finalData['pp_TxnType'] }}"/>
                                    <input type="hidden" name="pp_Language" value="{{ $finalData['pp_Language'] }}"/>
                                    <input type="hidden" name="pp_MerchantID" value="{{ $finalData['pp_MerchantID'] }}"/>
                                    <input type="hidden" name="pp_SubMerchantID" value="{{ $finalData['pp_SubMerchantID'] }}"/>
                                    <input type="hidden" name="pp_Password" value="{{ $finalData['pp_Password'] }}"/>
                                    <input type="hidden" name="pp_TxnRefNo" value="{{ $finalData['pp_TxnRefNo'] }}"/>
                                    <input type="hidden" name="pp_Amount" value="{{ $finalData['pp_Amount'] }}"/>
                                    <input type="hidden" name="pp_TxnCurrency" value="{{ $finalData['pp_TxnCurrency'] }}"/>
                                    <input type="hidden" name="pp_TxnDateTime" value="{{ $finalData['pp_TxnDateTime'] }}"/>
                                    <input type="hidden" name="pp_BillReference" value="{{ $finalData['pp_BillReference'] }}"/>
                                    <input type="hidden" name="pp_Description" value="{{ $finalData['pp_Description'] }}"/>
                                    <input type="hidden" id="pp_DiscountedAmount" name="pp_DiscountedAmount" value="{{ $finalData['pp_DiscountedAmount'] }}"/>
                                    <input type="hidden" id="pp_DiscountBank" name="pp_DiscountBank" value="{{ $finalData['pp_DiscountBank'] }}"/>
                                    <input type="hidden" name="pp_TxnExpiryDateTime" value="{{ $finalData['pp_TxnExpiryDateTime'] }}"/>
                                    <input type="hidden" name="pp_ReturnURL" value="{{ $finalData['pp_ReturnURL'] }}"/>
                                    <input type="hidden" name="pp_SecureHash" value="{{ $finalData['pp_SecureHash'] }}"/>
                                    <input type="hidden" name="ppmpf_1" value="{{ $finalData['ppmpf_1'] }}"/>
                                    <input type="hidden" name="ppmpf_2" value="{{ $finalData['ppmpf_2'] }}"/>
                                    <input type="hidden" name="ppmpf_3" value="{{ $finalData['ppmpf_3'] }}"/>
                                    <input type="hidden" name="ppmpf_4" value="{{ $finalData['ppmpf_4'] }}"/>
                                    <input type="hidden" name="ppmpf_5" value="{{ $finalData['ppmpf_5'] }}"/>

                                    <button id="submit" type="submit" class="btn btn-primary btn-lg">Pay Now</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/patient/js/payment.js')}}"></script>
@endsection



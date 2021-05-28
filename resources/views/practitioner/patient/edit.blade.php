@extends('layouts.practitioner')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('public/admin/plugins/lightbox/lightbox.min.css')}}">
    <style>
        .required-star{
            color: red;
        }

        /* .dropify-wrapper{
            height:120px !important;
        } */

        .required-star {
            color: red;
        }

        .full-width-select .select2-container, .full-width-select .selection {
            width: 100% !important;
        }

        .select2-container {
            width: 100% !important;
        }

        .selection {
            width: 100% !important;
        }
    </style>
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
                            <li class="breadcrumb-item"><a href="{{route('practitionerDashboard')}}">Home</a></li>
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
                            <h3 class="card-title">Edit Patient</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" class="row" action="{{ route('practitionerPatientUpdate') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row" style="width:100%">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name <span class="required-star">*</span></label>
                                            <input type="text" name="name" id="name"
                                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Name" value="{{$patient->name}}" required>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Email <span class="required-star">*</span></label>
                                            <input type="text" name="email" id="email" disabled
                                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Email" value="{{ $patient->email }}" required>

                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone <span style="color:red">*</span></label>
                                            <input type="text" placeholder="Enter Phone " data-inputmask="'mask': '0999-9999999'" maxlength="12" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                                class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                value="{{ $patient->phone }}" required>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label>Date of Birth <span style="color:red">*</span></label>
                                        <div class="input-group date">
                                            <input type="text" name="dob" id="dob"
                                                class="form-control {{ $errors->has('dob') ? ' is-invalid' : '' }}"
                                                placeholder="Enter DOB" value="{{ date('m/d/Y', strtotime($patient->dob)) }}" required>
                                            <span class="input-group-addon">
                                                <button class="btn btn-outline-secondary" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                            @if ($errors->has('dob'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dob') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label>Age <span style="color:red">*</span></label>
                                        <div class="input-group">
                                            <input type="number" name="age" id="age"
                                                class="form-control {{ $errors->has('age') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Age" value="{{ $patient->age }}" required>
                                            @if ($errors->has('age'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('age') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Gender <span style="color:red">*</span></label>
                                            <select name="gender" id="gender"
                                                class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Gender</option>
                                                <option value="1" {{ ($patient->gender == 1) ? 'selected' : '' }}>Male</option>
                                                <option value="2" {{ ($patient->gender == 2) ? 'selected' : '' }}>Female</option>
                                                <option value="3" {{ ($patient->gender == 3) ? 'selected' : '' }}>Other</option>

                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group ">
                                            <label>Marital Status <span style="color:red">*</span></label>
                                            <select name="marital_status" id="marital_status"
                                                class="form-control {{ $errors->has('marital_status') ? ' is-invalid' : '' }}" required>
                                                <option value="" selected disabled>Select Marital Status</option>
                                                <option value="Single" {{ ($patient->marital_status == "Single") ? 'selected' : '' }}>Single</option>
                                                <option value="Married" {{ ($patient->marital_status == "Married") ? 'selected' : '' }}>Married</option>
                                            </select>
                                            @if ($errors->has('marital_status'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2" id="weight_kgs_div">
                                        <a href="javascript:void(0);" id="vital_lbs" class="btn-space float-right">LBs</a>
                                        <label>Weight (Kilograms) </label>
                                        <div class="input-group">
                                            <input type="text" name="weight_kgs" id="weight_kgs"
                                                class="form-control {{ $errors->has('weight_kgs') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Weight in Kilograms" value="{{ $patient->weight_kgs }}">
                                            @if ($errors->has('weight_kgs'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('weight_kgs') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2" id="weight_lbs_div">
                                        <label>Weight (Pounds) </label>
                                        <a href="javascript:void(0);" id="vital_kgs" class="btn-space float-right" @if(isset($patient->weight_lbs) && $patient->weight_lbs > 0) style="" @else style="display:none;" @endif>KGs</a>
                                        <div class="input-group">
                                            <input type="text" name="weight_lbs" id="weight_lbs"
                                                class="form-control {{ $errors->has('weight_lbs') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Weight in Pounds" value="{{ $patient->weight_lbs }}">
                                            @if ($errors->has('weight_lbs'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('weight_lbs') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3 col-lg-3 mt-2" id="height_ft_div">
                                        <label>Height (Feet) </label>
                                        <div class="input-group">
                                            <input type="text" name="height_ft" id="height_ft"
                                                class="form-control {{ $errors->has('height_ft') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Height in Feet" value="{{ $patient->height_ft }}">
                                            @if ($errors->has('height_ft'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('height_ft') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3 col-lg-3 mt-2" id="height_in_div">
                                        <label>Height (Inches) </label>
                                        <a href="javascript:void(0);" id="vital_cms" class="btn-space float-right">CMs</a>
                                        <div class="input-group">
                                            <input type="text" name="height_in" id="height_in"
                                                class="form-control {{ $errors->has('height_in') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Height in Inches" value="{{ $patient->height_in }}">
                                            @if ($errors->has('height_in'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('height_in') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 mt-2" id="height_cms_div">
                                        <label>Height (Centimeters) </label>
                                        <a href="javascript:void(0);" id="vital_ft" class="btn-space float-right" @if(isset($patient->height_cms) && $patient->height_cms > 0) style="" @else style="display:none;" @endif>Ft</a>
                                        <div class="input-group">
                                            <input type="text" name="height_cms" id="height_cms"
                                                class="form-control {{ $errors->has('height_cms') ? ' is-invalid' : '' }}"
                                                placeholder="Enter Height in Centimeters" value="{{ $patient->height_cms }}">
                                            @if ($errors->has('height_cms'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('height_cms') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group ">
                                            <label>Hospitalization </label>
                                            <select name="hospitalization" id="hospitalization"
                                                class="form-control {{ $errors->has('hospitalization') ? ' is-invalid' : '' }}">
                                                <option value="" selected disabled>Select Hospitalization</option>
                                                <option value="1" {{ ($patient->hospitalization == "1") ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ ($patient->hospitalization == "0") ? 'selected' : '' }}>No</option>
                                            </select>
                                            @if ($errors->has('hospitalization'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('hospitalization') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group">
                                            <label>Allergies </label>
                                            <div class="cleafix"></div>
                                            <select name="allergies[]" id="allergies" multiple data-live-search="true"
                                                class="selectpicker form-control" >
                                                @foreach($allergies as $allergy)
                                                    <option value="{{$allergy->id}}"
                                                        @foreach($patient->allergies as $patientAllergy)
                                                            @if($allergy->id == $patientAllergy->allergy_id) selected @endif
                                                        @endforeach
                                                        >
                                                        {{ $allergy->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group ">
                                            <label>Currently on Any Drug </label>
                                            <select name="currently_on_drug" id="currently_on_drug"
                                                class="form-control {{ $errors->has('currently_on_drug') ? ' is-invalid' : '' }}">
                                                <option value="" selected disabled>Select Currently on Any Drug</option>
                                                <option value="1" {{ ($patient->currently_on_drug == "1") ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ ($patient->currently_on_drug == "0") ? 'selected' : '' }}>No</option>
                                            </select>
                                            @if ($errors->has('currently_on_drug'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('currently_on_drug') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($patient->currently_on_drug == 1)
                                    <div class="col-sm-12 col-md-6 col-lg-6 drug-dropdown mt-2" id="drugs_div">
                                        <div class="form-group">
                                            <label>Drugs <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="drugs[]" id="drugs" multiple data-live-search="true"
                                                class="selectpicker form-control" title="Select Drugs" required>
                                                @foreach($drugs as $drug)
                                                    <option value="{{$drug->id}}"
                                                        @foreach($patient->drugs as $patientDrug)
                                                            @if($drug->id == $patientDrug->drug_id) selected @endif
                                                        @endforeach
                                                        >
                                                        {{ $drug->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @else

                                    <div class="col-sm-12 col-md-6 col-lg-6 drug-dropdown mt-2 {{ (old('currently_on_drug') == '1') ? '' : 'hidden' }}" id="drugs_div">
                                        <div class="form-group">
                                            <label>Drugs <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="drugs[]" id="drugs" multiple="multiple" class="selectpicker form-control {{ $errors->has('drugs') ? ' is-invalid' : '' }}" title="Select Drugs" required>
                                                @foreach($drugs as $drug)
                                                    <option value="{{ $drug->id }}"
                                                        @foreach(old('drugs', ['value']) as $id)
                                                            @if($drug->id == $id) selected @endif
                                                        @endforeach
                                                    >{{ $drug->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('drugs'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('drugs') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                </div>

                                <div class="row" style="width:100%">

                                    <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                        <div class="form-group ">
                                            <label>Address</label>
                                            <textarea rows="5" name="address" style="width:100% !important">{{ $patient->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Patient Profile Image</label>
                                            <input accept="image/*" type="file" class="form-control dropify-image" name="image" @if ($patient->image)
                                            data-default-file="{{asset('storage/app/public/'.$patient->image)}}" @endif>
                                        </div>
                                    </div>

                                </div>

                                @if(count($patient->reports)>0)
                                    <div class="row" style="width:100%">
                                        <div class="card-header" style="width:100%;padding:20px">
                                            <h3 class="card-title">Previous Attachments</h3>
                                        </div>
                                    </div>
                                @endif

                                <div class="row" style="width:100%">
                                    @foreach ($patient->reports as $item)
                                        <div class="item col-xs-2 col-lg-2 target del" data-id={{ $item->id }}>
                                            <div class="thumbnail card">
                                                <a data-toggle="modal" data-target="#reportsPopupModal{{$item->id}}" class="img-event" style="text-align:center" href="{{asset('storage/app/public/'.$item->image_url)}}">
                                                    <i class="fa fa-image fa-5x group list-group-image img-fluid"></i>
                                                </a>
                                                <div style="text-align:center">{{ $item->title }} @if($item->type == 0) (Lab Test) @elseif($item->type == 1) (Invoice) @elseif($item->type == 2) (Other) @endif</div>
                                                <div style="text-align:center">
                                                    {{\Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                                </div>
                                                <div style="text-align:center">

                                                    <button type="button" onclick="reportDeleteFunction('{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <div class="row" style="width:100%">
                                    <div class="card-header" style="width:100%;padding:10px">
                                        <h3 class="card-title">Add New Attachments</h3>
                                    </div>
                                </div>



                                <div class="row mt-3" style="width:100%">
                                    <div class="repeater-default" style="width:100%">
                                        <div data-repeater-list="patient_reports" style="padding-left: 16px;
                                        padding-right: 16px;">
                                            <div data-repeater-item class="row">

                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Title <span style="color:red">*</span></label>
                                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"  required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                    <div class="form-group ">
                                                        <label>Type <span style="color:red">*</span></label>
                                                        <select name="type" id="type"
                                                            class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                                            <option value="" selected disabled>Select Type</option>
                                                            <option value="0">Lab</option>
                                                            <option value="1">Invoice</option>
                                                            <option value="2">Complaint</option>
                                                            <option value="3">Prescription</option>
                                                            <option value="4">Sugar Chart</option>
                                                            <option value="5">Vital</option>
                                                        </select>
                                                        @if ($errors->has('type'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('type') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-1 col-lg-1" style="text-align:center">
                                                    <button style="margin-top:30px" type="button" class="btn btn-danger" data-repeater-delete> <i class="fa fa-trash"></i> </button>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="customFile">Image/File <span style="color:red">*</span></label>
                                                        <input  type="file" class="form-control dropify" name="image_url" required>

                                                      </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="form-group overflow-hidden">
                                            <div class="col-12" style="text-align:end">
                                                <button style="margin-right:12px" data-repeater-create class="btn btn-primary" type="button"> <i class="fa fa-plus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="lastValueDropify" value="">

                                <br/>
                                <br/>

                                <div class="row" style="width:100%">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="patient_id" value="{{$patient->id}}" />
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

    @foreach($patient->reports as $report)
    <div id="reportsPopupModal{{$report->id}}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title" id="modal-title">
                       Attachment ({{$report->title}}) ({{\Carbon\Carbon::parse($report->created_at)->format('d M, Y')}}) @if($report->type == 0) (Lab Test) @elseif($report->type == 1) (Invoice) @elseif($report->type == 2) (Other) @endif
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('storage/app/public/'.$report->image_url)}}"
                         class="img-responsive img-center-popup w-100">
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection

@section('scripts')
    <script src="{{asset('public/admin/plugins/lightbox/lightbox.min.js')}}"></script>
    <script src="{{asset('public/admin/js/patient.js')}}"></script>
    <script>
        $(document).ready( function () {
            if($('#weight_kgs').val() == 0)
            {
                $('#weight_lbs_div').show();
                // $('#weight_lbs').prop('required', true);
                $('#weight_kgs_div').hide();
                $('#weight_kgs').prop('required', false);
            }

            if($('#weight_lbs').val() == 0)
            {
                $('#weight_kgs_div').show();
                // $('#weight_kgs').prop('required', true);
                $('#weight_lbs_div').hide();
                $('#weight_lbs').prop('required', false);
            }

            if($('#height_ft').val() == 0 && $('#height_in').val() == 0)
            {
                $('#height_ft_div').hide();
                $('#height_ft').prop('required', false);
                $('#height_in_div').hide();
                $('#height_in').prop('required', false);
                $('#height_cms_div').show();
                // $('#height_cms').prop('required', true);
            }

            if($('#height_cms').val() == 0)
            {
                $('#height_ft_div').show();
                // $('#height_ft').prop('required', true);
                $('#height_in_div').show();
                // $('#height_in').prop('required', true);
                $('#height_cms_div').hide();
                $('#height_cms').prop('required', false);
            }
        });
    </script>
@endsection




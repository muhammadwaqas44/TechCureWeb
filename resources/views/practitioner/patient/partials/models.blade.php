<div id="modalPMHx" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">PAST MEDICAL HISTORY</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <form id="past_medical_histories_form_model">
                    @csrf
                    <div class="modal-body pd-25">
                        <div class="total-chq-c-pmh">
                            @if(count($pastMedicalHistoryVisitGets) > 0)
                                @foreach($pastMedicalHistoryVisitGets as $pastMedicalHistoryVisitGet)
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 set-dropdown-width">
                                            <div class="mb-2">
                                                <label class="text-bold">Disease <span
                                                        style="color:red">*</span></label>
                                                <div class="cleafix"></div>
                                                <select name="diseases[]" data-live-search="true"
                                                        class="selectpicker diseases form-control w-100 {{ $errors->has('diseases') ? ' is-invalid' : '' }}"
                                                        title="Select Disease" required>
                                                    @foreach($diseases as $disease)
                                                        <option
                                                            value="{{ $disease->id }}" {{($pastMedicalHistoryVisitGet->disease_id == $disease->id)?'selected':''}}>{{ $disease->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('diseases'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('diseases') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="input-group mb-2">
                                                <label class="text-bold">Year</label>
                                                <input type="number" name="no_of_years[]"
                                                       class="form-control {{ $errors->has('no_of_years') ? ' is-invalid' : '' }}"
                                                       placeholder="No. of Years"
                                                       value="{{ $pastMedicalHistoryVisitGet->no_of_years }}">
                                                @if ($errors->has('no_of_years'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('no_of_years') }}</strong>
                                                </span>
                                                @endif
                                                <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span>
                                                <input type="number" name="year[]"
                                                       class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}"
                                                       placeholder="YYYY"
                                                       value="{{ $pastMedicalHistoryVisitGet->year }}">
                                                @if ($errors->has('year'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="input-group">
                                                <label class="text-bold">Remarks</label>
                                                <textarea name="remarks[]" rows="4"
                                                          class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                                          placeholder="Remarks">{{ $pastMedicalHistoryVisitGet->remarks }}</textarea>
                                                @if ($errors->has('remarks'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-3 text-right">
                                            <button type="button"
                                                    class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 set-dropdown-width">
                                        <div class="mb-2">
                                            <label class="text-bold">Disease <span
                                                    style="color:#ff0000">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="diseases[]" data-live-search="true"
                                                    class="selectpicker diseases form-control w-100 {{ $errors->has('diseases') ? ' is-invalid' : '' }}"
                                                    title="Select Disease" required>
                                                @foreach($diseases as $disease)
                                                    <option value="{{ $disease->id }}">{{ $disease->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('diseases'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('diseases') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="input-group mb-2">
                                            <label class="text-bold">Year</label>
                                            <input type="number" name="no_of_years[]"
                                                   class="form-control {{ $errors->has('no_of_years') ? ' is-invalid' : '' }}"
                                                   placeholder="No. of Years">
                                            @if ($errors->has('no_of_years'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('no_of_years') }}</strong>
                                                    </span>
                                            @endif
                                            <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span>
                                            <input type="number" name="year[]"
                                                   class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}"
                                                   placeholder="YYYY">
                                            @if ($errors->has('year'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('year') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="input-group">
                                            <label class="text-bold">Remarks</label>
                                            <textarea name="remarks[]" rows="4"
                                                      class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                                      placeholder="Remarks"></textarea>
                                            @if ($errors->has('remarks'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3 text-right">
                                        <button type="button"
                                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                        <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">

                        <div align="left" class="mt-3 clearfixss">
                            <button type="button"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_pmh">+
                                Add
                                More
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                            Changes
                        </button>
                        <button type="button"
                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalPSHx" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">PAST SURGICAL HISTORY</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <form id="past_surgical_histories_form_model">
                    @csrf
                    <div class="modal-body pd-25">
                        <div class="total-chq-c-psh">
                            @if(count($pastSurgicalHistoryVisitGets) > 0)
                                @foreach($pastSurgicalHistoryVisitGets as $pastSurgicalHistoryVisitGet)
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 set-dropdown-width">
                                            <div class="mb-2">
                                                <label class="text-bold">Surgery <span
                                                        style="color:red">*</span></label>
                                                <div class="cleafix"></div>
                                                <select name="surgeries[]" data-live-search="true"
                                                        class="selectpicker surgeries form-control w-100 {{ $errors->has('surgeries') ? ' is-invalid' : '' }}"
                                                        title="Select Surgery" required>
                                                    @foreach($surgeries as $surgery)
                                                        <option
                                                            value="{{ $surgery->id }}" {{($pastSurgicalHistoryVisitGet->surgery_id == $surgery->id)?'selected':''}}>{{ $surgery->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('surgeries'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('surgeries') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="input-group mb-2">
                                                <label class="text-bold">Year</label>
                                                <input type="number" name="no_of_years[]"
                                                       class="form-control {{ $errors->has('no_of_years') ? ' is-invalid' : '' }}"
                                                       placeholder="No. of Years"
                                                       value="{{ $pastSurgicalHistoryVisitGet->no_of_years }}">
                                                @if ($errors->has('no_of_years'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('no_of_years') }}</strong>
                                                </span>
                                                @endif
                                                <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span>
                                                <input type="number" name="year[]"
                                                       class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}"
                                                       placeholder="YYYY"
                                                       value="{{ $pastSurgicalHistoryVisitGet->year }}">
                                                @if ($errors->has('year'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="input-group">
                                                <label class="text-bold">Remarks</label>
                                                <textarea name="remarks[]" rows="4"
                                                          class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                                          placeholder="Remarks">{{ $pastSurgicalHistoryVisitGet->remarks }}</textarea>
                                                @if ($errors->has('remarks'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-3 text-right">
                                            <button type="button"
                                                    class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 set-dropdown-width">
                                        <div class="mb-2">
                                            <label class="text-bold">Surgery <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="surgeries[]" data-live-search="true"
                                                    class="selectpicker surgeries form-control w-100 {{ $errors->has('surgeries') ? ' is-invalid' : '' }}"
                                                    title="Select Surgery" required>
                                                @foreach($surgeries as $surgery)
                                                    <option value="{{ $surgery->id }}">{{ $surgery->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('surgeries'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('surgeries') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="input-group mb-2">
                                            <label class="text-bold">Year</label>
                                            <input type="number" name="no_of_years[]"
                                                   class="form-control {{ $errors->has('no_of_years') ? ' is-invalid' : '' }}"
                                                   placeholder="No. of Years">
                                            @if ($errors->has('no_of_years'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('no_of_years') }}</strong>
                                                    </span>
                                            @endif
                                            <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span>
                                            <input type="number" name="year[]"
                                                   class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}"
                                                   placeholder="YYYY">
                                            @if ($errors->has('year'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('year') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="input-group">
                                            <label class="text-bold">Remarks</label>
                                            <textarea name="remarks[]" rows="4"
                                                      class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                                      placeholder="Remarks"></textarea>
                                            @if ($errors->has('remarks'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3 text-right">
                                        <button type="button"
                                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                        <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">

                        <div align="left" class="mt-3 clearfixss">
                            <button type="button"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_psh">+
                                Add
                                More
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                            Changes
                        </button>
                        <button type="button"
                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalFMHx" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">FAMILY MEDICAL HISTORY</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <form id="family_medical_histories_form_model">
                    @csrf
                    <div class="modal-body pd-25">
                        <div class="total-chq-c-fmh">
                            @if(count($familyMedicalHistoryVisitGets) > 0)
                                <input type="hidden" name="next_deceased_index" id="next_deceased_index"
                                       value="{{count($familyMedicalHistoryVisitGets)}}"/>
                                @foreach($familyMedicalHistoryVisitGets as $key=>$familyMedicalHistoryVisitGet)
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="row">
                                                <div class="mb-2 col-sm-6 col-lg-6 d-blcok">
                                                    <label class="text-bold">Relation <span
                                                            style="color:red">*</span></label>
                                                    <div class="cleafix"></div>
                                                    <select name="relations[{{$key}}]" data-live-search="true"
                                                            class="selectpicker relations form-control w-100 {{ $errors->has('relations') ? ' is-invalid' : '' }}"
                                                            title="Select Relation" required>
                                                        @foreach($relations as $relation)
                                                            <option
                                                                value="{{ $relation->id }}" {{($familyMedicalHistoryVisitGet->relation_id == $relation->id)?'selected':''}}>{{ $relation->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('relations'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('relations') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="mb-2 col-sm-6 col-lg-6 set-dropdown-width">
                                                    <label class="text-bold">Disease <span
                                                            style="color:red">*</span></label>
                                                    <div class="cleafix"></div>
                                                    <select name="diseases[{{$key}}]" data-live-search="true"
                                                            class="selectpicker diseases form-control w-100 {{ $errors->has('diseases') ? ' is-invalid' : '' }}"
                                                            title="Select Disease" required>
                                                        @foreach($diseases as $disease)
                                                            <option
                                                                value="{{ $disease->id }}" {{($familyMedicalHistoryVisitGet->disease_id == $disease->id)?'selected':''}}>{{ $disease->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('diseases'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('diseases') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="input-group mb-2">
                                                <label class="text-bold">Year</label>
                                                <input type="number" name="no_of_years[{{$key}}]"
                                                       class="form-control {{ $errors->has('no_of_years') ? ' is-invalid' : '' }}"
                                                       placeholder="No. of Years"
                                                       value="{{ $familyMedicalHistoryVisitGet->no_of_years }}">
                                                @if ($errors->has('no_of_years'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('no_of_years') }}</strong>
                                                </span>
                                                @endif
                                                <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span>
                                                <input type="number" name="year[{{$key}}]"
                                                       class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}"
                                                       placeholder="YYYY"
                                                       value="{{ $familyMedicalHistoryVisitGet->year }}">
                                                @if ($errors->has('year'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="input-grou mt-2">
                                                <label><b>Status</b><br>
                                                    {{--                                                <input type="hidden" name="next_deceased_index" id="next_deceased_index" value="{{$key}}" />--}}
                                                    <input type="hidden" name="deceased_status[{{$key}}]" value="0"/>
                                                    <input type="checkbox" name="deceased_status[{{$key}}]"
                                                           class="float-left mr-2 mt-1 deceased-status"
                                                           @if($familyMedicalHistoryVisitGet->deceased_status == 1) checked
                                                           value="1" @endif> Deceased
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="input-group">
                                                <label class="text-bold">Remarks</label>
                                                <textarea name="remarks[{{$key}}]" rows="4"
                                                          class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                                          placeholder="Remarks">{{ $familyMedicalHistoryVisitGet->remarks }}</textarea>
                                                @if ($errors->has('remarks'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-3 text-right">
                                            <button type="button"
                                                    class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="row">
                                            <div class="mb-2 col-sm-6 col-lg-6 d-blcok">
                                                <label class="text-bold">Relation <span
                                                        style="color:red">*</span></label>
                                                <div class="cleafix"></div>
                                                <select name="relations[0]" data-live-search="true"
                                                        class="selectpicker relations form-control w-100 {{ $errors->has('relations') ? ' is-invalid' : '' }}"
                                                        title="Select Relation" required>
                                                    @foreach($relations as $relation)
                                                        <option
                                                            value="{{ $relation->id }}">{{ $relation->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('relations'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('relations') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="mb-2 col-sm-6 col-lg-6 set-dropdown-width">
                                                <label class="text-bold">Disease <span
                                                        style="color:red">*</span></label>
                                                <div class="cleafix"></div>
                                                <select name="diseases[0]" data-live-search="true"
                                                        class="selectpicker diseases form-control w-100 {{ $errors->has('diseases') ? ' is-invalid' : '' }}"
                                                        title="Select Disease" required>
                                                    @foreach($diseases as $disease)
                                                        <option
                                                            value="{{ $disease->id }}">{{ $disease->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('diseases'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('diseases') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label class="text-bold">Year</label>
                                            <input type="number" name="no_of_years[0]"
                                                   class="form-control {{ $errors->has('no_of_years') ? ' is-invalid' : '' }}"
                                                   placeholder="No. of Years">
                                            @if ($errors->has('no_of_years'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('no_of_years') }}</strong>
                                                    </span>
                                            @endif
                                            <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span>
                                            <input type="number" name="year[0]"
                                                   class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}"
                                                   placeholder="YYYY">
                                            @if ($errors->has('year'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('year') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                        <div class="input-grou mt-2">
                                            <label><b>Status</b><br>
                                                <input type="hidden" name="next_deceased_index" id="next_deceased_index"
                                                       value="1"/>
                                                <input type="hidden" name="deceased_status[0]" value="0"/>
                                                <input type="checkbox" name="deceased_status[0]" value="1"
                                                       class="float-left mr-2 mt-1 deceased-status"> Deceased
                                                {{--                                                <input type="checkbox" name="deceased_status[]"  onclick="myFunction(this)" class="float-left mr-2 mt-1 deceased-status"> Deceased--}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="input-group">
                                            <label class="text-bold">Remarks</label>
                                            <textarea name="remarks[0]" rows="4"
                                                      class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                                      placeholder="Remarks"></textarea>
                                            @if ($errors->has('remarks'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3 text-right">
                                        <button type="button"
                                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                        <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">

                        <div align="left" class="mt-3 clearfixss">
                            <button type="button"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_fmh">+
                                Add
                                More
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                            Changes
                        </button>
                        <button type="button"
                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalPE" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">PHYSICAL EXAMINATION</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="physical_exams_form_model">
                @csrf
                <div class="modal-body pd-25">

                    <div class="total-chq-c-pe">
                        @if(count($physicalExaminationVisitGets) > 0)
                            @foreach($physicalExaminationVisitGets as $physicalExaminationVisitGet)
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="mb-2">
                                            <label class="text-bold">Physical Exams <span
                                                    style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="physical_exams[]" data-live-search="true"
                                                    class="selectpicker physical_exams form-control w-100 {{ $errors->has('physical_exams') ? ' is-invalid' : '' }}"
                                                    title="Select Physical Exams" required>
                                                @foreach($physicalExams as $physicalExam)
                                                    <option
                                                        value="{{ $physicalExam->id}}" {{($physicalExaminationVisitGet->physical_exam_id == $physicalExam->id)?'selected':''}}>{{ $physicalExam->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('physical_exams'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('physical_exams') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="input-group">
                                            <label class="text-bold">Description</label>
                                            <textarea rows="4" name="remarks[]"
                                                      class="form-control">{{$physicalExaminationVisitGet->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3 text-right">
                                        <button type="button"
                                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="mb-2">
                                        <label class="text-bold">Physical Exams <span style="color:red">*</span></label>
                                        <div class="cleafix"></div>
                                        <select name="physical_exams[]" data-live-search="true"
                                                class="selectpicker physical_exams form-control w-100 {{ $errors->has('physical_exams') ? ' is-invalid' : '' }}"
                                                title="Select Physical Exams" required>
                                            @foreach($physicalExams as $physicalExam)
                                                <option
                                                    value="{{ $physicalExam->id }}">{{ $physicalExam->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('physical_exams'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('physical_exams') }}</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="input-group">
                                        <label class="text-bold">Description</label>
                                        <textarea rows="4" name="remarks[]" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3 text-right">
                                    <button type="button"
                                            class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                    <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                    <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">

                    <div align="left" class="mt-3 clearfixss">
                        <button type="button"
                                class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_pe">+ Add
                            More
                        </button>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save Changes
                    </button>
                    <button type="button"
                            class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalhistory" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">HISTORY</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="patient_history_form_model">
                @csrf
                <div class="modal-body pd-25">

                    <div class="total-chq-c-history">
                        <div class="row">

                            @if(isset($history))
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label>History <span style="color:#ff0000">*</span></label>
                                    <textarea name="history" id="description" style="height: 250px;color: #000"
                                              class="form-control textarea {{ $errors->has('history') ? ' is-invalid' : '' }}"
                                              rows="20"
                                              placeholder="Enter Description"
                                              required>{!! $history->description !!}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('history') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            @else
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label>History <span style="color:red">*</span></label>
                                    <textarea name="history" id="description" style="height: 250px;color: #000"
                                              class="form-control textarea {{ $errors->has('history') ? ' is-invalid' : '' }}"
                                              rows="20"
                                              placeholder="Enter Description" required>{{ old('history') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('history') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                    <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                    <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">

                </div>
                <div class="modal-footer clearfix">
                    <button type="submit"
                            class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save Changes
                    </button>
                    <button type="button"
                            class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalsmoking" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">SMOKING HISTORY</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <form id="patient_smoking_model_post">
                    @csrf
                    <div class="total-chq-c-history">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <label>

                                    <input type="checkbox" name="ever_smoke" value="1"
                                           @if(isset($smokingHistory)){{($smokingHistory->ever_smoke == 1)?'checked':''}} @endif class="first-level-smoke">
                                    Did you ever smoke?
                                </label>
                                <div style="clear: both;"></div>
                                <div class="even-smoke pl-4"
                                     @if(isset($smokingHistory)) @if($smokingHistory->ever_smoke == 1) style="display: block" @endif @endif>
                                    <label><input type="radio" name="still_smoke" value="1"
                                                  @if(isset($smokingHistory)){{($smokingHistory->still_smoke == 1)?'checked':''}} @endif class="mr-2 show-still-smoke">Do
                                        you
                                        still smoke?</label>
                                    <label><input type="radio" name="still_smoke" value="0"
                                                  @if(isset($smokingHistory)) {{($smokingHistory->still_smoke == 0)?'checked':''}} @endif
                                                  class="mr-2 remove-still-smoke">Non-Smoker</label>
                                    <div style="clear: both;"></div>
                                    <div class="still-smoke mb-3"
                                         @if(isset($smokingHistory))@if($smokingHistory->still_smoke == 1) style="display: block" @endif @endif>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3">
                                                Years*
                                                <input type="number" name="years"
                                                       @if(isset($smokingHistory)) value="{{($smokingHistory->no_of_years != null)?$smokingHistory->no_of_years:''}}"
                                                       @endif class="form-control">
                                            </div>
                                            <div class="col-sm-3 col-lg-3">
                                                Cig/Day *
                                                <input type="text" name="cig_day"
                                                       @if(isset($smokingHistory)) value="{{($smokingHistory->cig_per_day != null)?$smokingHistory->cig_per_day:''}}"
                                                       @endif class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label>
                                    <input type="checkbox" name="ever_drink" value="1"
                                           @if(isset($smokingHistory)) {{($smokingHistory->ever_drink == 1)?'checked':''}} @endif class="show-ever-drink">
                                    Did you ever drink?
                                </label>
                                <div class="ever-drink pl-4 mb-3"
                                     @if(isset($smokingHistory)) @if($smokingHistory->ever_drink == 1) style="display: block" @endif @endif>
                                    <label><input type="checkbox" name="still_drink" value="1"
                                                  @if(isset($smokingHistory)){{($smokingHistory->still_drink == 1)?'checked':''}} @endif class="mr-2">Do
                                        you still drink?</label>
                                    <textarea rows="2" class="form-control" name="drink_remarks"
                                              placeholder="Drink remarks"> @if(isset($smokingHistory)){{($smokingHistory->drink_remarks != null)?$smokingHistory->drink_remarks:''}}@endif</textarea>
                                </div>
                                <label>
                                    <input type="checkbox" name="ever_use_drugs" value="1"
                                           @if(isset($smokingHistory)){{($smokingHistory->ever_use_drugs == 1)?'checked':''}} @endif class="show-ever-drugs">
                                    Did you ever use drugs?
                                </label>
                                <div class="ever-drugs pl-4"
                                     @if(isset($smokingHistory)) @if($smokingHistory->ever_use_drugs == 1) style="display: block" @endif @endif>
                                    <label><input type="checkbox" name="still_use_drugs" value="1"
                                                  @if(isset($smokingHistory)){{($smokingHistory->still_use_drugs == 1)?'checked':''}} @endif class="mr-2">Do
                                        you still use
                                        drugs?</label>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 mb-3">
                                                <textarea rows="2" class="form-control" name="what_drug_use"
                                                          placeholder="What drugs do you use?">@if(isset($smokingHistory)){{($smokingHistory->what_drug_use != null)?$smokingHistory->what_drug_use:''}}@endif</textarea>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                                <textarea rows="2" class="form-control" name="how_use_drug"
                                                          placeholder="How do you use the drugs?">@if(isset($smokingHistory)){{($smokingHistory->how_use_drug != null)?$smokingHistory->how_use_drug:''}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                        <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">
                    </div>

                    <div class="modal-footer clearfix">
                        <button type="submit"
                                class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                            changes
                        </button>
                        <button type="button"
                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalros" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">REVIEW ON SYSTEM</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="ros_form_model_post">
                @csrf
                <div class="modal-body pd-25">

                    <div class="total-chq-c-history">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 mb-3">
                                <textarea rows="3" name="rs_first_description"
                                          class="form-control">@if(isset($ros)) {{($ros->first_description != null)?$ros->first_description:''}} @endif</textarea>
                            </div>
                            <div class="col-sm-12 col-lg-12 mb-3">

                                <textarea rows="3" name="rs_second_description"
                                          class="form-control">@if(isset($ros)) {{($ros->second_description != null)?$ros->second_description:''}} @endif</textarea>

                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <textarea rows="3" name="rs_third_description"
                                          class="form-control">@if(isset($ros)) {{($ros->third_description != null)?$ros->third_description:''}} @endif</textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                    <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                    <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">
                </div>
                <div class="modal-footer clearfix">
                    <button type="submit"
                            class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                        changes
                    </button>
                    <button type="button"
                            class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modaladr" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ADR</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="modaladr_form_post">
                @csrf
                <div class="modal-body pd-25">

                    <div class="total-chq-c-adr">
                        @if(count($adrGets)> 0)
                            @php $count = 1; @endphp
                            @foreach($adrGets as $adrGet)
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="mb-2">
                                            <label>Drug:</label>
                                            <select class="selectpicker bg-transparent border w-100 drugs{{$count}}"
                                                    name="drugs[{{$count - 1}}]" onchange="onChangeDrug($(this))"
                                                    data-live-search="true" title="Select Drug">
                                                @foreach($drugs as $drug)
                                                    <option
                                                        value="{{$drug->id}}" {{($adrGet->drug_id == $drug->id)?'selected':''}}>{{$drug->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="mb-2">
                                            <label>Reaction:</label>
                                            <select class="selectpicker bg-transparent border w-100 reactions{{$count}}"
                                                    multiple
                                                    name="reactions[{{$count - 1}}][]"
                                                    data-live-search="true" title="Select Reactions">
                                                @foreach($reactions as $reaction)
                                                    <option
                                                        value="{{$reaction->id}}"
                                                        @foreach($adrGet->reactions as $reactionSingle)
                                                        @if($reactionSingle->reaction_id == $reaction->id) selected @endif
                                                        @endforeach>{{$reaction->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3 text-right">
                                        <button type="button"
                                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                @php $count++ @endphp
                            @endforeach

                        @else
                            <div class="row">

                                <div class="col-sm-6 col-lg-6">
                                    <div class="mb-2">
                                        <label>Drug:</label>
                                        <select class="selectpicker bg-transparent border w-100 drugs1"
                                                name="drugs[0]" onchange="onChangeDrug($(this))"
                                                data-live-search="true" title="Select Drug">
                                            @foreach($drugs as $drug)
                                                <option value="{{$drug->id}}">{{$drug->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="mb-2">
                                        <label>Reaction:</label>
                                        <select class="selectpicker bg-transparent border w-100 reactions1" multiple
                                                name="reactions[0][]"
                                                data-live-search="true" title="Select Reactions">
                                            @foreach($reactions as $reaction)
                                                <option value="{{$reaction->id}}">{{$reaction->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3 text-right">
                                    <button type="button"
                                            class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="adr_previous_count" class="adr_previous_count"
                               value="{{$adrGets->count()+1}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                        <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">
                    </div>

                    <div align="left" class="mt-3 clearfixss">
                        <button type="button"
                                class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_adr">+
                            Add
                            More
                        </button>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                        changes
                    </button>
                    <button type="button"
                            class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalrxm" class="modal fade popup-style rxm-model-width" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">CuRx (MEDICINES)</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <form id="rx_medicines_form_model">
                    @csrf
                    <div class="modal-body pd-25">
                        <div class="total-chq-c-rxm">
                            @if(count($rxMedicineVisitGets) > 0)
                                @php $count = 1; @endphp
                                @foreach($rxMedicineVisitGets as $rxMedicineVisitGet)
                                    <div class="row">
                                        <div class="col-sm-3 col-lg-3 d-blcok set-dropdown-width">
                                            <label class="text-bold">Medicine <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="medicines[]" data-live-search="true"
                                                    onchange="changeMedicine($(this))"
                                                    class="selectpicker form-control w-100 medicines{{$count}} {{ $errors->has('medicines') ? ' is-invalid' : '' }}"
                                                    title="Select Medicine" required>
                                                @foreach($medicines as $medicine)
                                                    <option
                                                        value="{{ $medicine->id }}" {{($rxMedicineVisitGet->medicine_id == $medicine->id)?'selected':''}}>{{ $medicine->title }} @if(isset($medicine->generic_name)) ({{ $medicine->generic_name }}) @endif</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('medicines'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('medicines') }}</strong>
</span>
                                            @endif
                                        </div>

                                        <div class="col-sm-1 col-lg-1 d-blcok">
                                            <label class="text-bold">Dose </label>
                                            <div class="cleafix"></div>
                                            <select name="doses[]" data-live-search="true"
                                                    class="selectpicker doses{{$count}} form-control w-100 {{ $errors->has('doses') ? ' is-invalid' : '' }}"
                                                    title="Dose">
                                                @foreach($doses as $dose)
                                                    <option
                                                        value="{{ $dose->id }}" {{($rxMedicineVisitGet->dose_id == $dose->id)?'selected':''}}>{{ $dose->dose }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('doses'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('doses') }}</strong>
</span>
                                            @endif
                                        </div>

                                        <div class="col-sm-1 col-lg-1 d-blcok">
                                            <label class="text-bold">Unit </label>
                                            <div class="cleafix"></div>
                                            <select name="units[]" data-live-search="true"
                                                    class="selectpicker units{{$count}} form-control w-100 {{ $errors->has('units') ? ' is-invalid' : '' }}"
                                                    title="Unit">
                                                @foreach($units as $unit)
                                                    <option
                                                        value="{{ $unit->id }}" {{($rxMedicineVisitGet->unit_id == $unit->id)?'selected':''}}>{{ $unit->unit }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('units'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('units') }}</strong>
</span>
                                            @endif
                                        </div>

                                        <div class="col-sm-2 col-lg-2 d-blcok set-dropdown-width">
                                            <label class="text-bold">Frequency <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="frequencies[]" data-live-search="true"
                                                    class="selectpicker frequencies{{$count}} form-control w-100 {{ $errors->has('frequencies') ? ' is-invalid' : '' }}"
                                                    title="Select Frequency" required>
                                                @foreach($frequencies as $frequency)
                                                    <option
                                                        value="{{ $frequency->id }}" {{($rxMedicineVisitGet->frequency_id == $frequency->id)?'selected':''}}>{{ $frequency->frequency }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('frequencies'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('frequencies') }}</strong>
</span>
                                            @endif
                                        </div>

                                        <div class="col-sm-2 col-lg-2 d-blcok">
                                            <label class="text-bold">Duration <span style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="durations[]" data-live-search="true"
                                                    class="selectpicker durations{{$count}} form-control w-100 {{ $errors->has('durations') ? ' is-invalid' : '' }}"
                                                    title="Select Duration" required>
                                                @foreach($durations as $duration)
                                                    <option
                                                        value="{{ $duration->id }}" {{($rxMedicineVisitGet->duration_id == $duration->id)?'selected':''}}>{{ $duration->duration }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('durations'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('durations') }}</strong>
</span>
                                            @endif
                                        </div>

                                        <div class="col-sm-3 col-lg-3 d-blcok set-dropdown-width">
                                            <label class="text-bold"> Diagnosis Type <span
                                                    style="color:red">*</span></label>
                                            <div class="cleafix"></div>
                                            <select name="diagnosis_types[]" data-live-search="true"
                                                    class="selectpicker diagnosis_types{{$count}} form-control w-100 {{ $errors->has('diagnosis_types') ? ' is-invalid' : '' }}"
                                                    title="Select Diagnosis Type" required>
                                                @foreach($diagnosisTypes as $diagnosisType)
                                                    <option
                                                        value="{{ $diagnosisType->id }}" {{($rxMedicineVisitGet->diagnosis_type_id == $diagnosisType->id)?'selected':''}}>{{ $diagnosisType->type }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('diagnosis_types'))
                                                <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('diagnosis_types') }}</strong>
</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-12 mt-3 text-right">
                                            <button type="button"
                                                    class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                    @php $count++ @endphp
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3 d-blcok set-dropdown-width">
                                        <label class="text-bold">Medicine <span style="color:red">*</span></label>
                                        <div class="cleafix"></div>
                                        <select name="medicines[]" data-live-search="true"
                                                onchange="changeMedicine($(this))"
                                                class="selectpicker form-control w-100 medicines1 {{ $errors->has('medicines') ? ' is-invalid' : '' }}"
                                                title="Select Medicine" required>
                                            @foreach($medicines as $medicine)
                                                <option value="{{ $medicine->id }}">{{ $medicine->title }} @if(isset($medicine->generic_name)) ({{ $medicine->generic_name }}) @endif</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('medicines'))
                                            <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('medicines') }}</strong>
</span>
                                        @endif
                                    </div>

                                    <div class="col-sm-1 col-lg-1 d-blcok">
                                        <label class="text-bold">Dose </label>
                                        <div class="cleafix"></div>
                                        <select name="doses[]" data-live-search="true"
                                                class="selectpicker doses1 form-control w-100 {{ $errors->has('doses') ? ' is-invalid' : '' }}"
                                                title="Dose">
                                            @foreach($doses as $dose)
                                                <option value="{{ $dose->id }}">{{ $dose->dose }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('doses'))
                                            <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('doses') }}</strong>
</span>
                                        @endif
                                    </div>

                                    <div class="col-sm-1 col-lg-1 d-blcok">
                                        <label class="text-bold">Unit </label>
                                        <div class="cleafix"></div>
                                        <select name="units[]" data-live-search="true"
                                                class="selectpicker units1 form-control w-100 {{ $errors->has('units') ? ' is-invalid' : '' }}"
                                                title="Unit">
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('units'))
                                            <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('units') }}</strong>
</span>
                                        @endif
                                    </div>

                                    <div class="col-sm-2 col-lg-2 d-blcok set-dropdown-width">
                                        <label class="text-bold">Frequency <span style="color:red">*</span></label>
                                        <div class="cleafix"></div>
                                        <select name="frequencies[]" data-live-search="true"
                                                class="selectpicker frequencies1 form-control w-100 {{ $errors->has('frequencies') ? ' is-invalid' : '' }}"
                                                title="Select Frequency" required>
                                            @foreach($frequencies as $frequency)
                                                <option
                                                    value="{{ $frequency->id }}">{{ $frequency->frequency }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('frequencies'))
                                            <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('frequencies') }}</strong>
</span>
                                        @endif
                                    </div>

                                    <div class="col-sm-2 col-lg-2 d-blcok">
                                        <label class="text-bold">Duration <span style="color:red">*</span></label>
                                        <div class="cleafix"></div>
                                        <select name="durations[]" data-live-search="true"
                                                class="selectpicker durations1 form-control w-100 {{ $errors->has('durations') ? ' is-invalid' : '' }}"
                                                title="Select Duration" required>
                                            @foreach($durations as $duration)
                                                <option value="{{ $duration->id }}">{{ $duration->duration }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('durations'))
                                            <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('durations') }}</strong>
</span>
                                        @endif
                                    </div>

                                    <div class="col-sm-3 col-lg-3 d-blcok set-dropdown-width">
                                        <label class="text-bold"> Diagnosis Type <span
                                                style="color:red">*</span></label>
                                        <div class="cleafix"></div>
                                        <select name="diagnosis_types[]" data-live-search="true"
                                                class="selectpicker diagnosis_types1 form-control w-100 {{ $errors->has('diagnosis_types') ? ' is-invalid' : '' }}"
                                                title="Select Diagnosis Type" required>
                                            @foreach($diagnosisTypes as $diagnosisType)
                                                <option
                                                    value="{{ $diagnosisType->id }}">{{ $diagnosisType->type }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('diagnosis_types'))
                                            <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('diagnosis_types') }}</strong>
</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-12 mt-3 text-right">
                                        <button type="button"
                                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <input type="hidden" name="rx_medicine_previous_count" class="rx_medicine_previous_count"
                               value="{{$rxMedicineVisitGets->count()+1}}">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                        <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">

                        <div align="left" class="mt-3 clearfixss">
                            <button type="button"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_rxm">+
                                Add
                                More
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                            Changes
                        </button>
                        <button type="button"
                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalEditLabTest" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Lab Test</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="edit_lab_test_form_post">
                @csrf
                <div class="modal-body pd-25">

                    <div class="">
                        <div class="row">
                            <input type="hidden" name="patient_lab_test_id" id="patient_lab_test_id">
                            <div class="col-sm-6 col-lg-6">
                                <div class="mb-2">
                                    <label>Lab Tests <span style="color:red">*</span></label>

                                    <input name="lab_test_id" id="lab_test_id" class="form-control " type="hidden">
                                    <input id="lab_test_name" class="form-control" value=""
                                           type="text" readonly>

                                    {{--                                    <select name="lab_test_id" id="lab_test_id"--}}
                                    {{--                                            class="form-control" readonly--}}
                                    {{--                                            required>--}}
                                    {{--                                        <option value="" selected disabled>Select Lab Test</option>--}}
                                    {{--                                        @foreach($labTests as $labTest)--}}
                                    {{--                                            <option value="{{$labTest->id}}">{{$labTest->title}}</option>--}}
                                    {{--                                        @endforeach--}}
                                    {{--                                        <option value=""></option>--}}
                                    {{--                                    </select>--}}

                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="mb-2">
                                    <label>Type <span style="color:red">*</span></label>
{{--                                    <input type="text" name="type" id="type_lab_test"--}}
{{--                                           class="form-control "--}}
{{--                                           placeholder="Enter Type" required>--}}
                                    <select name="type_id" id="type_lab_test"
                                            class="form-control {{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                    >
                                        <option value="" selected disabled>Select Lab</option>
                                        @foreach($labTestTypes as $labTestType)
                                            <option value="{{$labTestType->id}}" {{ (old('type_id') == $labTestType->id) ? 'selected' : '' }}>{{$labTestType->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type_id'))
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('type_id') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="mb-2">
                                    <label>Fasting <span style="color:#ff0000">*</span></label>
                                    <select name="fasting" id="fasting_lab_test"
                                            class="form-control"
                                            required>
                                        <option selected
                                                value="1">
                                            Yes
                                        </option>
                                        <option value="0">
                                            No
                                        </option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="mb-2">
                                    <label>Recommended Lab </label>
                                    <select name="recommended_lab" id="recommended_lab_test"
                                            class="form-control"
                                            >
                                        <option value="" selected disabled>Select Lab</option>
                                        @foreach($labs as $lab)
                                            <option value="{{$lab->id}}">{{$lab->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group ">
                                    <label>Instructions</label>
                                    <textarea rows="5" name="instructions" id="instructions_lab_test"
                                              style="width:100% !important"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="practitioner_id" value="{{$practitioner->id}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                        <input type="hidden" name="patient_visit_id" value="{{$patientVisit->id}}">
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save
                        changes
                    </button>
                    <button type="button"
                            class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="viewAllPreviousVisit" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">All Previous Visit</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pd-25">

                <div class="">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12" >
                            <div class="table-responsive previous-visit">
                                <table class="table new-table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($patientVisitPrevious) > 0 )
                                        @foreach($patientVisitPrevious as $patientVisitP)
                                            <tr>
                                                <td>{{\Carbon\Carbon::parse($patientVisitP->appointment->date)->format('d M, Y')}}</td>
                                                <td class="yellow">
                                                        @if($patientVisitP->appointment->status == 0) Pending
                                                        @elseif($patientVisitP->appointment->status == 1) Under
                                                        Process @elseif($patientVisitP->appointment->status == 2)
                                                        Accepted @elseif($patientVisitP->appointment->status == 3)
                                                        Rejected @elseif($patientVisitP->appointment->status == 4) Check
                                                        In @elseif($patientVisitP->appointment->status == 5)
                                                        Completed @endif</td>
                                                <td class="yellow">{{ ($patientVisitP->revise_of != null)? 'Revised - '.\Carbon\Carbon::parse($patientVisitP->revise_of)->format('d M, Y') : '' }}</td>
                                                <td><a type="button"
                                                                onclick="viewPreviousVisit({{$patientVisitP->patient_id}} ,{{$patientVisitP->practitioner_id}},{{$patientVisitP->id}})"
                                                                class="view-btn">View</a> <a type="button"
                                                                                                onclick="copyPreviousVisits({{$patientVisitP->patient_id}} ,{{$patientVisitP->practitioner_id}},{{$patientVisitP->id}})"
                                                                                                class="copy-btn">Copy</a><a
                                                        type="button" onclick="revisePatientVisit({{$patientVisitP->patient_id}} ,{{$patientVisitP->practitioner_id}},{{$patientVisitP->id}})" class="revise-btn">Revise</a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> <p style="font-size:13px;" class="mt-3"> No Previous Visit Found! </p> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <div class="modal-footer clearfix">
                <button type="button"
                        class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                        data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div>

<div id="viewPreviousVisit" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Previous Visit</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pd-25"style="overflow: auto;">

                <div class="">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12" id="view-previous-visit-details">

                        </div>
                    </div>

                </div>


            </div>
            <div class="modal-footer clearfix">
                {{--                <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Copy--}}
                {{--                </button>--}}
                <button type="button"
                        class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold"
                        data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>

</div>

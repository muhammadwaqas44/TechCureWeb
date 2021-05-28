<div class="total-chq-c-rxm-partial" style="display: none">
    <div class="row">
        <div class="mt-2 col-sm-3 col-lg-3 d-blcok set-dropdown-width">
            <label class="text-bold">Medicine <span style="color:red">*</span></label>
            <div class="cleafix"></div>
            <select name="medicines[]" data-live-search="true" onchange="changeMedicine($(this))"
                    class="selectpicker medicines form-control w-100 {{ $errors->has('medicines') ? ' is-invalid' : '' }}" title="Select Medicine" required>
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

        <div class="mt-2 col-sm-1 col-lg-1 d-blcok">
            <label class="text-bold">Dose </label>
            <div class="cleafix"></div>
            <select name="doses[]" data-live-search="true"
                    class="selectpicker doses form-control w-100 {{ $errors->has('doses') ? ' is-invalid' : '' }}" title="Dose">
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

        <div class="mt-2 col-sm-1 col-lg-1 d-blcok">
            <label class="text-bold">Unit </label>
            <div class="cleafix"></div>
            <select name="units[]" data-live-search="true"
                    class="selectpicker units form-control w-100 {{ $errors->has('units') ? ' is-invalid' : '' }}" title="Unit">
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

        <div class="mt-2 col-sm-2 col-lg-2 d-blcok set-dropdown-width">
            <label class="text-bold">Frequency <span style="color:red">*</span></label>
            <div class="cleafix"></div>
            <select name="frequencies[]" data-live-search="true"
                    class="selectpicker frequencies form-control w-100 {{ $errors->has('frequencies') ? ' is-invalid' : '' }}" title="Select Frequency" required>
                @foreach($frequencies as $frequency)
                    <option value="{{ $frequency->id }}">{{ $frequency->frequency }}</option>
                @endforeach
            </select>
            @if ($errors->has('frequencies'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('frequencies') }}</strong>
                </span>
            @endif
        </div>

        <div class="mt-2 col-sm-2 col-lg-2 d-blcok">
            <label class="text-bold">Duration <span style="color:red">*</span></label>
            <div class="cleafix"></div>
            <select name="durations[]" data-live-search="true"
                    class="selectpicker durations form-control w-100 {{ $errors->has('durations') ? ' is-invalid' : '' }}" title="Select Duration" required>
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

        <div class="mt-2 col-sm-3 col-lg-3 d-blcok set-dropdown-width">
            <label class="text-bold"> Diagnosis Type <span style="color:red">*</span></label>
            <div class="cleafix"></div>
            <select name="diagnosis_types[]" data-live-search="true"
                    class="selectpicker diagnosis_types form-control w-100 {{ $errors->has('diagnosis_types') ? ' is-invalid' : '' }}" title="Select Diagnosis Type" required>
                @foreach($diagnosisTypes as $diagnosisType)
                    <option value="{{ $diagnosisType->id }}">{{ $diagnosisType->type }}</option>
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

        {{-- <input type="hidden" name="medicine_count" class="medicine_count" value="1"> --}}
    </div>
</div>
<div class="total-chq-c-psh-partial" style="display: none">
    <div class="row">
        <div class="col-sm-6 col-lg-6 set-dropdown-width">
            <div class="mb-2">
                <label class="text-bold">Surgery <span style="color:red">*</span></label>
                <div class="cleafix"></div>
                <select name="surgeries[]" data-live-search="true"
                        class="selectpicker surgeries form-control w-100 {{ $errors->has('surgeries') ? ' is-invalid' : '' }}" title="Select Surgery" required>
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
                    <input type="number" name="no_of_years[]" class="form-control {{ $errors->has('no_of_years') ? ' is-invalid' : '' }}" placeholder="No. of Years">
                    @if ($errors->has('no_of_years'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('no_of_years') }}</strong>
                        </span>
                    @endif
                    <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span>
                    <input type="number" name="year[]" class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}" placeholder="YYYY">
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
                <textarea name="remarks[]" rows="4" class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}" placeholder="Remarks"></textarea>
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
</div>

<div class="total-chq-c-adr-partial" style="display: none">
    <div class="row">
        <div class="col-sm-6 col-lg-6">
            <div class="mb-2">
                <label>Drug:</label>
                <select class="selectpicker bg-transparent border w-100 drugs"
                        name="drugs[0]" onchange="onChangeDrug($(this))"
                        data-live-search="true"  title="Select Drug">
                    @foreach($drugs as $drug)
                        <option value="{{$drug->id}}">{{$drug->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="mb-2">
                <label>Reaction:</label>
                <select class="selectpicker bg-transparent border w-100 reactions" multiple
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
</div>

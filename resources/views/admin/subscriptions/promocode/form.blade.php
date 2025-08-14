<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="name">Promo Code</label>
            <input type="text" name="code" id="code" class="form-control" required placeholder="Enter Promo Code" value="{{ old('code', optional($promocode)->code) }}">
        </div>
    </div>
    <div class="form-group">
        <label for="discount_type">Discount Type</label>
        <select name="discount_type" class="form-control" required>
            <option value="Fixed Amount" {{ old('discount_type', optional($promocode)->discount_type) == 'Fixed Amount' ? 'selected' : '' }}>Fixed Amount</option>
            <option value="percentage" {{ old('discount_type', optional($promocode)->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
        </select>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="name">Discount value</label>
            <input type="text" name="discount" id="discount" class="form-control" required placeholder="Discount" value="{{ old('discount', optional($promocode)->discount) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="name">Expire at</label>
            <input type="date" name="expires_at" id="expires_at" class="form-control" required value="{{ old('expires_at', optional(optional($promocode)->expires_at)->format('Y-m-d')) }}">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label for="duration">MemberShip (in months)</label>
            <select name="duration" id="duration" class="form-control" required>
                <option value="2" {{ old('duration', optional($promocode)->duration) == 2 ? 'selected' : '' }}>2 Months</option>
                <option value="4" {{ old('duration', optional($promocode)->duration) == 4 ? 'selected' : '' }}>4 Months</option>
                <option value="6" {{ old('duration', optional($promocode)->duration) == 6 ? 'selected' : '' }}>6 Months</option>
            </select>
        </div>
    </div>
</div>
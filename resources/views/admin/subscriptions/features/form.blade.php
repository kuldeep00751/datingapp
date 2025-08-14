<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="name">Feature Name</label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter feature name" value="{{ old('name', optional($features)->name) }}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="duration">Description </label>
            <textarea name="description" id="description" class="form-control" required placeholder="Enter description about feature">{{ old('description', optional($features)->description) }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label for="name">Subscription Name</label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter subscription plan name" value="{{ old('name', optional($subscriptions)->name) }}">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" required placeholder="Enter subscription plan price" value="{{ old('price', optional($subscriptions)->price) }}">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label for="duration">Duration (in months)</label>
            <input type="number" name="duration" id="duration" class="form-control" required placeholder="Enter duration" value="{{ old('duration', optional($subscriptions)->duration) }}">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="0" {{ old('status', optional($subscriptions)->status) == '0' ? 'selected' : '' }}>Inactive</option>
                <option value="1" {{ old('status', optional($subscriptions)->status) == '1' ? 'selected' : '' }}>Active</option>
            </select>
        </div>
    </div>
   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="duration">Features </label>
            <select name="features[]" id="features" class="form-control" multiple >
                @foreach($featuresAll as $feature)
                    <option value="{{ $feature->id }}" 
                        
                        @if(isset($subscriptions['features']) && is_array($subscriptions['features']) && in_array($feature->id, $subscriptions['features']))
                            selected
                        @endif>
                        {{ $feature->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
       
       $('#features').select2({
            placeholder: "Select Feature", 
            allowClear: true 
        });
   });
</script>
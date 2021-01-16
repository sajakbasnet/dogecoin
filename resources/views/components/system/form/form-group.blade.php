<div class="form-group row" id="{{ $input['groupId'] ?? '' }}">
    <label for="{{ $input['name'] ?? '' }}" class="col-sm-2 col-form-label {{ (isset($input['required']) || isset($input['label-required'])) ? 'require' : '' }}">
        {{ isset($input['label']) ? translate($input['label']) : '' }}
    </label>
    <div class="{{ isset($input['fullWidth']) ? 'col-sm-10' : 'col-sm-6' }}">
        @if(isset($inputs))
        {{$inputs}}
        @else
        <x-system.form.input-normal :input="$input"/>
        @endif
    </div>
</div>
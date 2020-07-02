<select name="{{ $input['name'] ?? '' }}" id="{{ $input['id'] ?? $input['name'] ?? ''}}" 
class="form-control {{ (isset($input['error']) && $input['error'] !== "") ? 'is-invalid' : '' }}" {{ (isset($input['disabled']) && $input['disabled'] !== "") ? 'disabled' : '' }} {{ isset($input['multiple']) ? 'multiple' : '' }}>
    @if(isset($input['placeholder']))
    <option value="">{{ trans($input['placeholder']) }}</option>
    @endif
    @if(isset($input['options']))
    @foreach($input['options'] as $option)
    <option value="{{ $option['key'] }}" {{ $input['default'] == $option['key'] ? 'selected' : '' }}>{{ $option['value'] }}</option>
    @endforeach
    @endif
</select>
@if(isset($input['helpText']))
<small class="form-text text-muted">{{ trans($input['helpText']) ?? '' }}</small>
@endif
@if(isset($input['error']))<div class="invalid-feedback">{{ trans($input['error']) }}</div>@endif

<select name="{{ $input['name'] ?? '' }}" id="{{ $input['id'] ?? $input['name'] ?? ''}}" 
class="form-control {{ isset($input['error']) ? 'is-invalid' : '' }}" {{ isset($input['disabled']) ? 'disabled' : '' }} {{ isset($input['multiple']) ? 'multiple' : '' }}>
    @if(isset($input['placeholder']))
    <option value="">{{ trans($input['placeholder']) }}</option>
    @endif
    @if(isset($input['options']))
    @foreach($input['options'] as $option)
    <option value="{{ $option->id }}" {{ $input['default'] == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
    @endforeach
    @endif
</select>
@if(isset($input['helpText']))
<small class="form-text text-muted">{{ trans($input['helpText']) ?? '' }}</small>
@endif
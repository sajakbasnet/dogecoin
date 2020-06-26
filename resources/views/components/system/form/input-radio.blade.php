@foreach($input['options'] as $radioOption)
<div class="form-check {{ isset($input['stacked']) ? '' : 'form-check-inline' }}">
  <input class="form-check-input {{ isset($input['error']) ? 'is-invalid' : '' }}" type="radio"
         id="{{ $input['name'] }}-{{ $radioOption['value'] }}"
         value="{{ $radioOption['value'] }}"
         @if($input['default'] == $radioOption['value'])
         checked
         @endif
         name="{{ $input['name'] }}" {{ isset($input['disabled']) ? 'disabled' : '' }} >
  <label class="form-check-label" for="{{ $input['name'] }}-{{ $radioOption['value'] }}">{{ trans($radioOption['label'] ?? $radioOption['key']) }}</label>
</div>
@endforeach

@if(isset($input['helpText']))
  <small class="form-text text-muted">{{ trans($input['helpText']) ?? '' }}</small>
@endif

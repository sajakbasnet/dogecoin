<input type="{{ $input['type'] ?? 'text' }}" class="form-control {{ (isset($input['error']) && $input['error'] !== "") ? 'is-invalid' : '' }} {{ isset($input['class']) ? $input['class'] : '' }}"
value="{{$input['default'] ?? ''}}" id="{{$input['id'] ?? $input['name']}}" placeholder="{{ trans($input['placeholder'] ?? $input['label'] ?? '') }}" name="{{$input['name'] ?? ''}}"
{{isset($input['disabled']) ? 'disabled' : ''}} {{ isset($input['readonly']) ? 'readonly' : '' }} {{isset($input['min']) ? 'min='.$input['min'] : ''}}>
@if(isset($input['helpText']))
  <small class="form-text text-muted">{{ trans($input['helpText']) ?? '' }}</small>
@endif

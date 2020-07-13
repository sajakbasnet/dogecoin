<textarea class="form-control {{ isset($input['editor']) ? 'tinymce' : '' }} {{ (isset($input['error']) && $input['error'] !== "") ? 'is-invalid' : '' }}"
 id="{{ $input['id'] ?? $input['name'] }}" name="{{ $input['name'] }}" placeholder="{{ trans($input['placeholder'] ?? $input['label']) }}" rows="{{ $input['rows'] ?? 4 }}"
 {{ isset($input['disabled']) ? 'disabled' : '' }} >{!! $input['default'] ?? '' !!}</textarea>
 @if(isset($input['helpText']))
  <small class="form-text text-muted">{{ trans($input['helpText']) ?? '' }}</small>
@endif
@if(isset($input['error']))<div class="invalid-feedback">{{ trans($input['error']) }}</div>@endif
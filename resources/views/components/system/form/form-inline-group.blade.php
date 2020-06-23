<div class="col-auto mb-2" id="{{ $input['groupId'] ?? '' }}">
  <label class="sr-only" for="{{ $input['name'] ?? '' }}">{{ trans($input['label'] ?? '') }}</label>
  @if(isset($inputs))
  {{$inputs}}
  @else
  @include('components.system.form.input-normal')
  @endif
  {{--{{ elIf('<div class="invalid-feedback">$self</div>', input.error, input.error) }}--}}
</div>

<div class="col-auto mb-2" id="{{ $input['groupId'] ?? '' }}">
  <label class="sr-only" for="{{ $input['name'] ?? '' }}">{{ translate($input['label'] ?? '') }}</label>
  @if(isset($inputs))
  {{$inputs}}
  @else
   <div class="mb-3">
        <div class="mb-3">
            <x-system.form.input-normal :input="$input"/>
        </div>
  @endif
</div>

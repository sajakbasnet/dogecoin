@extends('system.layouts.form')
@section('inputs')
<x-system.form.form-group :input="['name'=> 'name', 'label'=>'Role name', 'required' => 'true', 'default'=> $item->name ?? old('name'), 'error' => $errors->first('name')]" />
<x-system.form.form-group :input="['name'=> 'permissions', 'label'=>'Permissions', 'required' => 'true']">
  <x-slot name="inputs">
    @error('permissions')
    <p class="text-danger">{{translate($message)}}</p>
    @enderror
    @foreach(modules() as $module)
    @if(isset($item))
    @include('system.role.edit')
    @else
    @include('system.role.create')
    @endif
    @endforeach
  </x-slot>
</x-system.form.form-group>
@endsection
@section('scripts')
<script>
  // whenever user checks any permission other than "view permission", "view permission" is automatically selected
  $('.permission').on('click', function() {
    if (this.checked) {
      let route = JSON.parse($(this).val())
      if (Array.isArray(route)) {
        route = route[0]
      }
      const keys = route.url.split('/')
      if (!(route.method === 'get' && keys.length === 1)) {
        if (keys.length > 1) {
          const selectRoute = {
            url: '/' + keys[1],
            method: 'get',
          }
          $(":checkbox[value='" + JSON.stringify(selectRoute) + "']").prop("checked", "true")
        }
        // for nested resource route
        // url = '/campaigns/:campaign_id/products'
        if (keys.length >= 5) {
          const selectRoute = {
            url: '/' + keys[1] + '/' + keys[2] + '/' + keys[3],
            method: 'get',
          }
          $(":checkbox[value='" + JSON.stringify(selectRoute) + "']").prop("checked", "true")
        }
      }
    }
  })

  $("input[type='checkbox']").each(function() {
    $(this).click(function() {
      var c = $(this).attr("class");
      if ($(this).is(":checked")) {
        $("." + c).attr("checked", true);
      } else {
        $("." + c).attr("checked", false);
      }
    })
  })
</script>
@endsection
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
  $(function() {

    let mainPermissions = $(".module");
    for (let i = mainPermissions.length - 1; i >= 0; i--) {
      let permission = mainPermissions[i];
      let moduleName = $(permission).data("module")
      let subModuleName = $(permission).data("module") + '-sub'
      var checkBoxes = $(".permission[data-module='" + subModuleName + "']").length;
      var checkedCheckBoxes = $('input[type="checkbox"].' + subModuleName + ':checked').length;
      if (checkBoxes === checkedCheckBoxes) {
        $(".module[data-module='" + moduleName + "']").prop('checked', true);
      } else {
        $(".module[data-module='" + moduleName + "']").prop('checked', false);
      }

    }

    $(".module").change(function() {
      var moduleValue = $(this).data('module');
      $(":checkbox[class='" + moduleValue + "-sub permission" + "']").prop("checked", this.checked);
    });

    $('.permission').change(function() {
      var moduleValue = $(this).data('module');
      var main = moduleValue.split('-sub')
      var checkBoxes = $(".permission[data-module='" + moduleValue + "']").length;
      var checkedCheckBoxes = $('input[type="checkbox"].' + moduleValue + ':checked').length;
      if (checkBoxes === checkedCheckBoxes) {
        $(".module[data-module='" + main[0] + "']").prop('checked', true);
      } else {
        $(".module[data-module='" + main[0] + "']").prop('checked', false);
      }
    });

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
  });
</script>
@endsection
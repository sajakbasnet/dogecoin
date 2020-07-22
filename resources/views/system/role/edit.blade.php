@if($module['name'] !== 'Dashboard')
  <h4>{{ translate($module['name']) }}</h4>
  @if($module['hasSubmodules'])
    @foreach($module['submodules'] as $submodule)
    <h5>{{ translate($submodule['name']) }}</h5>
    @foreach($submodule['permissions'] as $permission)
    <label class="checkbox-inline">
      <input class="permission" type="checkbox" value="{{json_encode($permission['route'], JSON_UNESCAPED_SLASHES)}}" name="permissions[]"
      @if(isPermissionSelected(json_encode($permission['route'], JSON_UNESCAPED_SLASHES), json_encode($item->permissions, JSON_UNESCAPED_SLASHES)))
             checked
             @endif
      @if(in_array(json_encode($permission['route'], JSON_UNESCAPED_SLASHES), old('permissions',[])))
             checked
        @endif> {{ translate($permission['name']) }}
    </label>
    @endforeach
    @endforeach
  @else
    @if($module['permissions'])
      @foreach($module['permissions'] as $permission)
      <label class="checkbox-inline">
        <input class="permission" type="checkbox" value="{{json_encode($permission['route'], JSON_UNESCAPED_SLASHES)}}" name="permissions[]"
      @if(in_array(json_encode($permission['route'], JSON_UNESCAPED_SLASHES), old('permissions',[])))
             checked
        @endif> {{ translate($permission['name']) }}
      </label>
      @endforeach
    @endif
  @endif
  <hr>
@endif

@if($module['name'] !== 'Dashboard')
    @error('permissions')
    <p class="text-danger">{{trans($message)}}</p>
    @enderror
  <h4>{{$module['name']}}</h4>
  @if($module['hasSubmodules'])
    @foreach($module['submodules'] as $submodule)
    <h5>{{$submodule['name']}}</h5>
    @foreach($submodule['permissions'] as $permission)
    <label class="checkbox-inline">
      <input class="permission" type="checkbox" value="{{json_encode($permission['route'], JSON_UNESCAPED_SLASHES)}}" name="permissions[]"
      @if(in_array(json_encode($permission['route'], JSON_UNESCAPED_SLASHES), old('permissions',[])))
             checked
        @endif> {{$permission['name']}}
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
        @endif> {{$permission['name']}}
      </label>
      @endforeach
    @endif
  @endif
  <hr>
@endif

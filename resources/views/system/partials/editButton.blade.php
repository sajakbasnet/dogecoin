@if(hasPermission($indexUrl.'/'.$item->id.'/edit', 'get'))
  <a href="{{url($indexUrl.'/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm">{{translate('Edit')}}</a>
@endif

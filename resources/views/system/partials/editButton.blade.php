@if(hasPermission($indexUrl.'/'.$item->id.'/edit', 'get'))
  <a href="{{url($indexUrl.'/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-square-o"></i> {{translate('Edit')}}</a>
@endif

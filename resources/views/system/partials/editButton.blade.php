@if(hasPermission($indexUrl.'/'.$item->id.'/edit', 'get'))
  <a href="{{url($indexUrl.'/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm"><em class="fa fa-pencil-square-o"></em> {{translate('Edit')}}</a>
@endif

@if(\ekHelper::hasPermission($indexUrl.'/'.$item->id.'/edit', 'get'))
  <a href="{{$indexUrl}}/{{$item->id}}/edit" class="btn btn-primary btn-sm">{{trans('Edit')}}</a>
@endif

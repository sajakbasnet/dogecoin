@extends('system.layouts.listing')

{{--@section('header')
  @component('system.components.search-form', action = indexUrl)
    @slot('inputs')
      @!component('system.components.form.form-inline-group', input = {
      name: 'keyword',
      label: 'Search',
      default: request.input('keyword'),
      }, globalLocale=globalLocale)
    @endslot
  @endcomponent
@endsection--}}

@section('table-heading')
<tr>
    <th>{{trans('S.N')}}</th>
    <th>{{trans('Name')}}</th>
    <th>{{trans('Action')}}</th>
</tr>
@endsection

@section('table-data')
@foreach($items as $item)
<tr>
    <td>{{$loop->index+1}}</td>
    <td>{{$item->name}}</td>
    <td>
        @if($item->isEditable($item->id))
        @include('system.partials.editButton')
        @endif

        @if($item->isDeletable($item->id))
        @include('system.partials.deleteButton')
        @endif

        @if(\ekHelper::hasPermission('/users'))
        <a href="/{{PREFIX}}/users?role={{$item->id}}" class="nonelink"><span class="span-icon">
                <i class="fa fa-users" aria-hidden="true"></i>{{ $item->users->count()}}</span>
        </a>
        @endif
    </td>
</tr>
@endforeach
@endsection
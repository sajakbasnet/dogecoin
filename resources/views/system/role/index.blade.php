@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="$indexUrl">
  <x-slot name="inputs">
    <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]"/>
  </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
  <th>{{trans('S.N')}}</th>
  <th>{{trans('Name')}}</th>
  <th>{{trans('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $a=$items['items']->perPage() * ($items['items']->currentPage()-1); @endphp
@foreach($items['items'] as $item)
@php $a++ @endphp
<tr>
  <td>{{$a}}</td>
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
@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="$indexUrl">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
        <x-system.form.form-inline-group :input="['name' => 'group', 'label' => 'Group']">
            <x-slot name="inputs">
                <x-system.form.input-select :input="['name' => 'group', 'options' => $groups, 'default' => Request::get('group')]" />
            </x-slot>
        </x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{trans('S.N')}}</th>
    <th>{{trans('Language')}}</th>
    <th>{{trans('Group')}}</th>
    <th>{{trans('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $a=$items->perPage() * ($items->currentPage()-1); @endphp
@foreach($items as $item)
@php $a++ @endphp
<tr>
    <td>{{ $a }}</td>
    <td>{{ $item->name }} ({{$item->language_code}})</td>
    <td>
        <span class="badge {{$item->group === 'backend' ? 'badge-primary' : 'badge-info'}}">{{$item->group}}</span>
    </td>
    <td>
        @if(!$item->isDefault() && \ekHelper::hasPermission($indexUrl.'/'.$item->id, 'delete'))
        @include('system.partials.deleteButton')
        @endif
    </td>
</tr>
@endforeach
@endsection
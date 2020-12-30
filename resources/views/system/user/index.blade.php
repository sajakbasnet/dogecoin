@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
        <x-system.form.form-inline-group :input="['name' => 'role', 'label' => 'Role']">
            <x-slot name="inputs">
                <x-system.form.input-select :input="['name' => 'role', 'placeholder' => 'Select role', 'options' => $roles, 'default' => Request::get('role')]" />
            </x-slot>
        </x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{translate("S.N")}}</th>
    <th>{{translate('Name')}}</th>
    <th>{{translate('Role')}}</th>
    <th>{{translate('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $pageIndex = pageIndex($items); @endphp
@foreach($items as $key=>$item)
<tr>
    <td>{{SN($pageIndex, $key)}}</td>
    <td>{{ $item->name }}</td>
    <td>
        <a href="/{{PREFIX}}/roles?keyword={{$item->role->name}}" class="badge badge-secondary">
            {{ $item->role->name }}
        </a>
    </td>
    <td>
        @include('system.partials.editButton')
        @include('system.partials.deleteButton')
    </td>
</tr>
@endforeach
@endsection
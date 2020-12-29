@extends('system.layouts.listing')
@section('create')
@show
@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{translate('S.N')}}</th>
    <th>{{translate('Title')}}</th>
    <th>{{translate('Code')}}</th>
    <th>{{translate('Action')}}</th>
</tr>
@endsection

@section('table-data')
@foreach($items as $key=>$item)
<tr>
    <td>{{SN($items, $key)}}</td>
    <td>{{$item->title}}</td>
    <td>{{$item->code}}</td>
    <td>
        @include('system.partials.actionButtons')
    </td>
</tr>
@endforeach
@endsection
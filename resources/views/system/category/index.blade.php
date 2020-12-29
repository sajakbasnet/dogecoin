@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="$indexUrl">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'placeholder' => 'Keyword', 'default' => Request::get('keyword')]"></x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{translate('S.N')}}</th>
    <th>{{translate('Name')}}</th>
    <th>{{translate('Attributes')}}</th>
    <th>{{translate('Sub Categories')}}</th>
    <th>{{translate('Action')}}</th>
</tr>
@endsection

@section('table-data')
@foreach($items as $key=>$item)
<tr>
    <td>{{ SN($items, $key) }}</td>
    <td>{{ $item->name }}</td>
    <td>
        {{ $item->attributes }}
    </td>
    <td>
        <a href="{{url(PREFIX.'/categories/'.$item->id.'/sub-category')}}" class="btn btn-success">COUNT ({{$item->subCategoryCount($item->id)}})</a>
    </td>
    <td>
        @include('system.partials.editButton')
        @include('system.partials.deleteButton')
    </td>
</tr>
@endforeach
@endsection
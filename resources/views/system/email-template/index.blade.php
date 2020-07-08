@extends('system.layouts.listing')

@section('header')
<x-system.search-form :action="$indexUrl">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{trans('S.N')}}</th>
    <th>{{trans('Title')}}</th>
    <th>{{trans('Code')}}</th>
    <th>{{trans('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $a=$items->perPage() * ($items->currentPage()-1); @endphp
@foreach($items as $item)
@php $a++ @endphp
<tr>
    <td>{{$a}}</td>
    <td>{{$item->title}}</td>
    <td>{{$item->code}}</td>
    <td>
        @include('system.partials.actionButtons')
    </td>
</tr>
@endforeach
@endsection
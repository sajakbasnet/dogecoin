@extends('system.layouts.listing')

@section('create')
@endsection

@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name'=>'from', 'label'=>'From date','default'=> Request::get('from'), 'class'=>'datepicker', 'autoComplete'=>'off']" />
        <x-system.form.form-inline-group :input="['name'=>'to', 'label'=>'To date', 'default'=> Request::get('to'), 'class'=>'datepicker', 'autoComplete'=>'off']" />
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{translate("S.N")}}</th>
    <th>{{translate("User")}}</th>
    <th>{{translate('Log Module')}}</th>
    <th>{{translate('Log Message')}}</th>
    <th>{{translate('Changes')}}</th>
</tr>
@endsection

@section('table-data')
@php $a=$items->perPage() * ($items->currentPage()-1); @endphp
@foreach($items as $item)
@php $a++ @endphp
<tr>
    <td>{{ $a }}</td>
    <td>{{ $item->user->name ?? 'N/A'}}</td>
    <td>{{ $item->getModuleName($item->subject_type)}}</td>
    <td>{!! $item->description !!}</td>
    <td>
        @if($item->oldValues($item->properties) !== 'N/A')
        <strong>Old values:</strong> <br>
        {!! $item->oldValues($item->properties) !!}
        <br>
        @endif
        <strong>Current values:</strong> <br>
        {!! $item->newValues($item->properties) !!}
    </td>
</tr>
@endforeach
@endsection
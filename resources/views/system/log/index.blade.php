@extends('system.layouts.listing')

@section('create')
@endsection

@section('table-heading')
<tr>
    <th>{{translate("S.N")}}</th>
    <th>{{translate("User")}}</th>
    <th>{{translate('Log Module')}}</th>
    <th>{{translate('Log Message')}}</th>
    <!-- <th>{{translate('Values')}}</th> -->
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
    <td>{{ $item->description }}</td>
    <!-- <td>{{ json_encode($item->properties) }}</td> -->
</tr>
@endforeach
@endsection
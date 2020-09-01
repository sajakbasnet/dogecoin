@extends('system.layouts.listing')

@section('create')
@endsection

@section('table-heading')
<tr>
    <th>{{translate("S.N")}}</th>
    <th>{{translate("User")}}</th>
    <th>{{translate('Ip Address')}}</th>
    <th>{{translate('Time')}}</th>
    <th>{{translate('ISP')}}</th>
    <th>{{translate('Location')}}</th>
</tr>
@endsection

@section('table-data')
@php $a=$items->perPage() * ($items->currentPage()-1); @endphp
@foreach($items as $item)
@php $a++ @endphp
<tr>
    <td>{{ $a }}</td>
    <td>{{ $item->user->name ?? 'N/A'}}</td>
    <td>{{ $item->ip}}</td>
    <td>{{ localDateTime($item->created_at)}}</td>
    <td>
        Latitude : {{$item->lat}}<br>
        Longitude : {{$item->lon}}<br>
        City : {{$item->city}}<br>
        Country : {{$item->country}}<br>
    </td>
    <td>{{ $item->region_name }}</td>
</tr>
@endforeach
@endsection
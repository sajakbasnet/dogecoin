@extends('system.layouts.listing')

@section('header')
@endsection

@section('table-heading')
<tr>
    <th>{{trans('S.N')}}</th>
    <th>{{trans('Name')}}</th>
    <th>{{trans('Role')}}</th>
    <th>{{trans('Action')}}</th>
</tr>
@endsection

@section('table-data')
@foreach($items as $item)
<tr>
    <td>{{ $loop->index+1 }}</td>
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
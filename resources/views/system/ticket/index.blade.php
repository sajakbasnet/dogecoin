@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
        <x-system.form.form-inline-group :input="['name' => 'status', 'label' => 'status']">
            <x-slot name="inputs">
                <x-system.form.input-select :input="['name' => 'status', 'placeholder' => 'Select status', 'options' => $status, 'default' => Request::get('status')]" />
            </x-slot>
        </x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th scope="col">S.N</th>
    <th scope="col">Ticket No</th>
    <th scope="col">Subject</th>
    <th scope="col">Assigned</th>
    <th scope="col">Created Date</th>
    <th scope="col">Status</th>
    <th scope="col">Priority</th>
    <th scope="col">Action</th>
</tr>
@endsection

@section('table-data')
@php $pageIndex = pageIndex($items); @endphp
@foreach($items as $key=>$item)
<tr>
    <td>{{SN($pageIndex, $key)}}</td>
    <td>
        <a href="{{$indexUrl}}/{{$item->id}}/consult">{{$item->ticket_id ?? ''}}</a>
    </td>
    <td>{{ $item->subject }}</td>
    <td>{{$item->user->name ?? ''}}</td>
    <td>{{ \Carbon\Carbon::parse($item->createdDate)->format('Y-m-d') ?? '' }}</td>
    <td>
        <span class="badge @if($item->status == 'completed') badge-success @elseif($item->status == 'under-review') badge-primary @elseif($item->status == 'in-process-of-resolution') badge-danger @else badge-warning @endif">
            {{ strtoupper(str_replace('-',' ',$item->status)) }}
        </span>
    </td>
    <td>
       
        <span class="badge  @if($item->priority == 'low') badge-success @elseif($item->priority == 'medium') badge-warning @else badge-danger @endif">
            {{ strtoupper($item->priority) }}
        </span>
    </td>
    <td>
        @include('system.partials.editButton')
    </td>
</tr>
@endforeach
@endsection

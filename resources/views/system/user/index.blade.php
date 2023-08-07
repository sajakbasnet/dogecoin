@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />      
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th scope="col">{{translate("S.N")}}</th>
    <th scope="col">{{translate('Name')}}</th>
    <th scope="col">{{translate('Role')}}</th>
    <th scope="col">{{translate('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $pageIndex = pageIndex($items); @endphp
@foreach($items as $key=>$item)
<tr>
    <td>{{SN($pageIndex, $key)}}</td>
    <td>{{ $item->name }}</td>
    <td style="list-style-type: none;">
        @foreach($item->roles as $role)
        <li><a href="/{{PREFIX}}/roles?keyword={{$role->name ?? 'N/A'}}" class="badge badge-secondary">
                {{ $role->name ?? 'N/A' }}
            </a></li>
        @endforeach
    </td>
    <td>
        @include('system.partials.editButton')
        @include('system.partials.deleteButton')   
    </td>
</tr>
@endforeach
@endsection
@section('scripts')
<script>
    let error = `{{ $errors->first('password')}}`
    let oldId = `{{ old('id') }}`
    if (error !== "") {
        $('#passwordReset' + oldId).modal('show')
    }
</script>
@endsection
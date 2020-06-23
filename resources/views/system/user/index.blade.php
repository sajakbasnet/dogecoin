@extends('system.layouts.listing')

@section('header')
{{--@component('system.components.search-form', action = indexUrl)
    @slot('inputs')
      @!component('system.components.form.form-inline-group', input = {
      name: 'keyword',
      label: 'Search Keyword',
      default: request.input('keyword'),
      }, globalLocale=globalLocale)

      @component('system.components.form.form-inline-group', input = {
      name: 'role',
      label: 'Role',
      }, globalLocale=globalLocale)
        @slot('input')
          @!component('system.components.form.input-select', input = {
          name: 'role',
          placeholder: 'Select Role',
          options: roles,
          default: request.input('role'),
          }, globalLocale=globalLocale)
        @endslot
      @endcomponent
    @endslot
  @endcomponent--}}

<x-system.search-form :action="$indexUrl">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
        <x-system.form.form-inline-group :input="['name' => 'role', 'label' => 'Role']">
            <x-slot name="inputs">
                <x-system.form.input-select :input="['name' => 'role', 'placeholder' => 'Select role', 'options' => $items['roles'], 'default' => Request::get('role')]"/>
            </x-slot>
        </x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
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
@php $a=$items['items']->perPage() * ($items['items']->currentPage()-1); @endphp
@foreach($items['items'] as $item)
@php $a++ @endphp
<tr>
    <td>{{ $a }}</td>
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
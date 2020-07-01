@extends('system.layouts.form')
@section('inputs')
<x-system.form.form-group :input="['name'=> 'name', 'label'=>'Role name', 'required' => 'true', 'default'=> $items['item']->name ?? old('name'), 'error' => $errors->first('name')]" />
<x-system.form.form-group :input="['name'=> 'permissions', 'label'=>'Permissions', 'required' => 'true']">
    <x-slot name="inputs">
        @foreach(\ekHelper::modules() as $module)
        @include('system.role.create')
        @endforeach
    </x-slot>
</x-system.form.form-group>
@endsection
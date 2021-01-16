@extends('system.layouts.form')
@section('inputs')
<x-system.form.form-group :input="[ 'name' => 'name', 'label'=> 'Name', 'required' => true, 'default' => $item->name ?? old('name'), 'error' => $errors->first('name')]" />
<x-system.form.form-group :input="[ 'name' => 'username', 'label'=> 'Username', 'required' => true, 'default' => $item->username ?? old('username'), 'error' => $errors->first('username')]" />
<x-system.form.form-group :input="[ 'name' => 'email', 'label'=> 'Email', 'required' => true, 'default' => $item->email ?? old('email'), 'error' => $errors->first('email')]" />
<x-system.form.form-group :input="[ 'name' => 'role_id', 'label'=> 'Role', 'required' => true]">
  <x-slot name="inputs">
    <x-system.form.input-select :input="[ 'name' => 'role_id', 'label'=> 'Role', 'required' => true, 'default' => $item->role_id ?? old('role_id') , 'options' => $roles, 'placeholder' => 'Select role', 'error' => $errors->first('role_id')]" />
  </x-slot>
</x-system.form.form-group>

@if(!isset($item))
<x-system.form.form-group :input="[ 'name' => 'set_password_status', 'label'=> 'Set Password ?', 'required' => true]">
  <x-slot name="inputs">
    <x-system.form.input-radio :input="[ 'name' => 'set_password_status', 'label'=> 'Set Password', 'required' => true, 
    'default' => old('set_password_status') ?? 0, 'options' => [[ 'value' => '0', 'label' => 'Send Activation Link'], ['value' => '1', 'label'=>'Set Password']]]" />
  </x-slot>
</x-system.form.form-group>

<div class="d-none" id="password-inputs">
  <x-system.form.form-group :input="[ 'name' => 'password', 'label'=> 'Password','label-required'=>true, 'type' => 'password', 'default' => old('password'), 'error' => $errors->first('password')]" />
  <x-system.form.form-group :input="[ 'name' => 'password_confirmation', 'label'=> 'Confirm Password','label-required'=>true, 'type' => 'password', 'default' => old('password_confirmation'), 'error' => $errors->first('password_confirmation')]" />
</div>
@endif
@endsection
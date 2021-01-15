@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
        <x-system.form.form-inline-group :input="['name' => 'role', 'label' => 'Role']">
            <x-slot name="inputs">
                <x-system.form.input-select :input="['name' => 'role', 'placeholder' => 'Select role', 'options' => $roles, 'default' => Request::get('role')]" />
            </x-slot>
        </x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{translate("S.N")}}</th>
    <th>{{translate('Name')}}</th>
    <th>{{translate('Role')}}</th>
    <th>{{translate('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $pageIndex = pageIndex($items); @endphp
@foreach($items as $key=>$item)
<tr>
    <td>{{SN($pageIndex, $key)}}</td>
    <td>{{ $item->name }}</td>
    <td>
        <a href="/{{PREFIX}}/roles?keyword={{$item->role->name}}" class="badge badge-secondary">
            {{ $item->role->name }}
        </a>
    </td>
    <td>
        @include('system.partials.editButton')
        @include('system.partials.deleteButton')
        <x-system.general-modal :url="route('user.reset-password', $item->id)" :modalTitle="'Password Reset'" :modalId="'passwordReset'.$item->id" :modalTriggerButton="'Reset-Password'" :buttonClass="'btn-success'" :submitButtonTitle="'Reset Password'">
            <x-slot name="body">
                @include('system.partials.errors')
                <div class="form-group row">
                    <div class="col-sm-4 col-form-label">
                        <label for="name" class="control-label">{{translate('New Password')}}</label> <span style="color:red;">*</span>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" placeholder="Enter your new password " required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 col-form-label">
                        <label for="name" class="control-label">{{translate('Confirm Password')}}</label> <span style="color:red;">*</span>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Enter your confirm password " required>
                    </div>
                </div>
            </x-slot>
        </x-system.general-modal>
    </td>
</tr>
@endforeach
@endsection
@section('scripts')
<script>
    let error = `{{ $errors->first('password')}}`
    if (error !== "") {
        $('#uploadExcelModal').modal('show')
    }
</script>
@endsection
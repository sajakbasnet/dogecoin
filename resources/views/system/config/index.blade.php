@extends('system.layouts.master')
@section('content')
<div class="inner-content-fluid">
    <div class="custom-container-fluid">
        <div class="page-head clearfix">
            <div class="row">
                <div class="col-xs-3">
                    <div class="head-title">
                        <h4>{{ $title }}</h4>
                    </div><!-- ends head-title -->
                </div>
            </div>
        </div><!-- ends page-head -->

        <div class="content-display clearfix">
            <div class="panel panel-default">
                <div class="panel-heading no-bdr">
                    <x-system.search-form :action="$indexUrl">
                        <x-slot name="inputs">
                            <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
                        </x-slot>
                    </x-system.search-form>
                </div>
            </div><!-- panel -->
            <div class="panel">
                <div class="panel-box">
                    @include('system.partials.message')
                </div>
            </div>

            <div class="panel">
                <div class="panel-box">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5px;">{{trans('S.N')}}</th>
                                    <th>{{trans('Label')}}</th>
                                    <th>{{trans('Value')}}</th>
                                    <th style="width: 15px;">{{trans('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $a=$items->perPage() * ($items->currentPage()-1); @endphp
                                @forelse($items as $item)
                                @php $a++; @endphp
                                <tr>
                                    <td>{{$a}}</td>
                                    <td>{{$item->label}}</td>
                                    <td>
                                        @if(!\ekHelper::hasPermission($indexUrl.'/'.$item->id, 'put'))
                                        @if($item->isFile($item->type))
                                        <img src="{{ asset('uploads/config/'.$item->value) }}" class="img-thumbnail mr-2" alt="{{$item->value}}" style="max-width:100px;">
                                        @else
                                        {{item.value}}
                                        @endif
                                        @else
                                        <form method="post" action="{{$indexUrl}}/{{$item->id}}" id="form{{$item->id}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            @if($item->isTextArea($item->type))
                                            <textarea name='value' class='form-control' onchange="submit()">{{$item->value}}</textarea>
                                            @elseif($item->isFile($item->type))
                                            <div style="display:flex;">
                                                <img src="{{ asset('uploads/config/'.$item->value) }}" class="img-thumbnail mr-2" alt="{{$item->value}}" style="max-width:100px;">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="value" id="customFile{{$item->id}}" onchange="submit()" accept="image/*">
                                                    <label class="custom-file-label" for="customFile{{$item->id}}">
                                                        {{ trans('Choose file') }}
                                                    </label>
                                                </div>
                                            </div>
                                            @else
                                            <input type='{{$item->type}}' placeholder='Value' name='value' value="{{$item->value}}" onchange="submit()" class='form-control {{ $item->isColorPicker($item->id) ? 'jscolor {hash:true}' : '' }}'>
                                            @endif
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if(\ekHelper::hasPermission($indexUrl.'/'.$item->id, 'delete') && ! $item->isDefault($item->id))
                                        @include('system.partials.deleteButton')
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100%" class="text-center">{{trans('No data available')}}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('system.partials.pagination')
                    </div>
                </div>
            </div><!-- panel -->

            @if(\ekHelper::hasPermission($indexUrl, 'post'))
            <div class="panel panel-default">
                <div class="panel-heading no-bdr">
                    <form method="post" class="form-inline" action="{{ $indexUrl }}" enctype="multipart/form-data">
                        @csrf
                        <x-system.form.form-inline-group :input="['name' => 'label', 'label' => 'Label', 'default' => old('label'), 'required' => true, 'error' => $errors->first('label')]" />
                        <x-system.form.form-inline-group :input="['name' => 'type', 'label' => 'Type']">
                            <x-slot name="inputs">
                                <x-system.form.input-select :input="['name'=>'type', 'label'=>'Type', 'placeholder' => 'Select Type', 'default' => old('type'), 'options' => $types, 'error'=>$errors->first('type')]" />
                            </x-slot>
                        </x-system.form.form-inline-group>

                        <div id="dynamic-field-wrapper" class="d-none">
                            <x-system.form.form-inline-group :input="['name'=>'value', 'id' => 'text-value', 'label' => 'Value', 'groupId' => 'text-type', 'required' => true, 'default' => old('value'), 'error' => $errors->first('value')]" />
                            <x-system.form.form-inline-group :input="['name'=>'value', 'id' => 'number-value', 'label' => 'Value', 'groupId' => 'number-type', 'type'=>'number', 'required' => true, 'default' => old('value'), 'error' => $errors->first('value')]" />
                            <x-system.form.form-inline-group :input="['name'=>'value', 'label' => 'Select file', 'groupId' => 'file-type']">
                                <x-slot name="inputs">
                                    <x-system.form.input-file :input="['name' => 'value', 'id' => 'file-value', 'label' => 'Select Image', 'accept' => 'image/*', 'required' => true, 'error' => $errors->first('value')]" />
                                </x-slot>
                            </x-system.form.form-inline-group>
                            <x-system.form.form-inline-group :input="['name'=>'value', 'label' => 'Value', 'groupId' => 'textarea-type']">
                                <x-slot name="inputs">
                                    <x-system.form.text-area :input="['name' => 'value', 'id' => 'textarea-value', 'label' => 'Value', 'rows' => 2, 'required' => true, 'default' => old('value'), 'error' => $errors->first('value')]" />
                                </x-slot>
                            </x-system.form.form-inline-group>
                        </div>
                        <button class="btn btn-primary" type="submit">{{trans('Save')}}</button>
                    </form>
                </div>
            </div>
            @endif
        </div><!-- ends custom-container-fluid -->
    </div><!-- ends inner-content-fluid -->
</div>
@endsection
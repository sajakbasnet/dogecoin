@extends('system.layouts.master')
@section('content')
<div class="inner-content-fluid">
    <div class="custom-container-fluid">
        <div class="page-head clearfix">
            <div class="row">
                <div class="col-sm-3">
                    <div class="head-title">
                        <h4>{{ translate($title) }}</h4>
                    </div><!-- ends head-title -->
                </div>
            </div>
        </div>
        <div class="content-display clearfix">
            <div class="panel panel-default">
                <div class="panel-heading no-bdr">
                    <x-system.search-form :action="$indexUrl">
                        <x-slot name="inputs">
                            <x-system.form.form-inline-group :input="['name' => 'keyword','label' => 'Keyword', 'default' => Request::get('keyword')]" />
                            <x-system.form.form-inline-group :input="['name' => 'locale', 'label' => 'Locale']">
                                <x-slot name="inputs">
                                    <x-system.form.input-select :input="['name' => 'locale', 'label' => 'Locale', 'options' => $locales, 'default' => Request::get('locale') ]" />
                                </x-slot>
                            </x-system.form.form-inline-group>
                            <x-system.form.form-inline-group :input="['name' => 'group', 'label' => 'Group']">
                                <x-slot name="inputs">
                                    <x-system.form.input-select :input="['name' => 'group', 'label' => 'Group', 'options' => $groups, 'default' => Request::get('group')]" />
                                </x-slot>
                            </x-system.form.form-inline-group>
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
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 5px;">{{trans('S.N')}}</th>
                                    <th>{{translate('Item')}}</th>
                                    <th>{{translate('Text')}}</th>
                                    <th style="width: 15px;">{{translate('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $a=$items->perPage() * ($items->currentPage()-1); @endphp
                                @forelse($items as $item)
                                @php $a++ ;@endphp
                                <tr>
                                    <td>{{$a}}</td>
                                    <td>{{$item->key}}</td>
                                    <td>
                                        @if(\ekhelper::hasPermission($indexUrl.'/'.$item->id, 'put'))
                                        <form action="">
                                            <textarea name="text" class="form-control translation-content" rows="1">{{$item->text[Request::get('locale')] ?? $item->text['en']}}</textarea>
                                        </form>
                                        @else
                                        {{$item->text[Request::get('locale')] ?? $item->text['en']}}
                                        @endif

                                    </td>
                                    <td>
                                        @if(\ekHelper::hasPermission($indexUrl.'/'.$item->id, 'delete'))
                                        @include('system.partials.deleteButton')
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{translate('No Data Available.')}}</td>
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
                    <form method="post" action="{{$indexUrl}}">
                        <div class="form-row align-items-center">
                            @csrf
                            <input type="hidden" name="group" value="{{ Request::get('group') ?? 'backend' }}" />
                            <x-system.form.form-inline-group :input="['name' => 'key','label' => 'Item', 'required' => true]" />
                            <button class="btn btn-primary" type="submit">{{trans('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div><!-- panel -->
            @endif
        </div><!-- ends custom-container-fluid -->
    </div>
</div>
@endsection
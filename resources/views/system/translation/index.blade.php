@extends('system.layouts.master')
@section('content')
<div class="inner-content-fluid">
    <div class="custom-container-fluid">
        <div class="page-head clearfix">
            <div class="row">
                <div class="col-sm-3">
                    <div class="head-title">
                        <h4>{{translate($title)}}</h4>
                    </div><!-- ends head-title -->
                </div>
                <div class="col-sm-9">
                    @if(hasPermission($indexUrl.'/download-sample'))
                    <a class="btn @if(Request::get('group') !== null && strtolower(Request::get('group')) == 'frontend' ) btn-info @else btn-primary @endif pull-right btn-sm" href="{{url($indexUrl.'/download-sample')}}" style="margin-right:3px">{{translate('Download Sample')}}</a>
                    @endif
                    @if(hasPermission($indexUrl.'/download/'.(Request::get('group') == null ? 'backend' : Request::get('group'))))
                    <a class="btn @if(Request::get('group') !== null && strtolower(Request::get('group')) == 'frontend' ) btn-info @else btn-primary @endif pull-right btn-sm" href="{{url($indexUrl.'/download/'.(Request::get('group') == null ? 'backend' : Request::get('group')))}}" style="margin-right:3px; margin-left:3px">{{translate('Download excel for '.(Request::get('group') == null ? 'backend' : Request::get('group')))}}</a>
                    @endif

                    @if(hasPermission($indexUrl.'/upload/'.(Request::get('group') == null ? 'backend' : Request::get('group')), 'post'))
                    <x-system.general-modal 
                    :url="url($indexUrl.'/upload/'.(Request::get('group') == null ? 'backend' : Request::get('group')))"
                    :modalTitle="'Upload excel for '.(Request::get('group') == null ? 'backend' : Request::get('group'))" 
                    :modalId="'uploadExcelModal'"
                    :modalTriggerButton="'Upload excel for '.(Request::get('group') == null ? 'backend' : Request::get('group'))" 
                    :buttonClass="(Request::get('group') !== null && strtolower(Request::get('group')) == 'frontend') ? 'btn-info' : 'btn-primary'"
                    :submitButtonTitle="'Upload'">
                    <x-slot name="body">
                    @include('system.partials.errors')
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">{{translate('Excel File')}}</label>
                        <div class="col-sm-6">
                        <input type="file" name="excel_file" class="form-control" accept=".xls">
                        </div>
                    </div>
                    </x-slot>
                    </x-system.general-modal>
                    @endif
                </div>
            </div>
        </div>
        <div class="content-display clearfix">
            <div class="panel panel-default">
                <div class="panel-heading no-bdr">
                    <x-system.search-form :action="url($indexUrl)">
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
                    <div class="table-responsive mt-3">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5px;">{{translate('S.N')}}</th>
                                    <th>{{translate('Item')}}</th>
                                    <th>{{translate('Text')}}</th>
                                    <th style="width: 10%;">{{translate('Action')}}</th>
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
                                        @if(hasPermission($indexUrl.'/'.$item->id, 'put'))
                                        <textarea name="text" class="form-control translation-content" rows="1" data-href="{{url('/'.PREFIX.'/translations/'.$item->id)}}" data-group="{{Request::get('group') ?? 'backend'}}" data-locale="{{Request::get('locale') ?? 'en'}}">{{$item->text[Request::get('locale')] ?? $item->text['en']}}</textarea>
                                        @else
                                        {{$item->text[Request::get('locale')] ?? $item->text['en']}}
                                        @endif

                                    </td>
                                    <td>
                                        @if(hasPermission($indexUrl.'/'.$item->id, 'delete'))
                                        @include('system.partials.deleteButton')
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{translate('No Data Available')}}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('system.partials.pagination')
                    </div>
                </div>
            </div><!-- panel -->
            @if(hasPermission($indexUrl, 'post'))
            <div class="panel panel-default">
                <div class="panel-heading no-bdr">
                    <form method="post" action="{{$indexUrl}}">
                        <div class="form-row align-items-center">
                            @csrf
                            <input type="hidden" name="group" value="{{ Request::get('group') ?? 'backend' }}" />
                            <x-system.form.form-inline-group :input="['name' => 'key','label' => 'Item', 'required' => true]" />
                            <button class="btn btn-primary" type="submit">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div><!-- panel -->
            @endif
        </div><!-- ends custom-container-fluid -->
    </div>
</div>
@endsection
@section('scripts')
<script>
    let error = `{{ $errors->first('excel_file')}}`
    if(error !== ""){
        $('#uploadExcelModal').modal('show')
    }
</script>
@endsection
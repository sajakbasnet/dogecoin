@extends('system.layouts.master')

@section('content')
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to(PREFIX.'/home')}}">{{translate('Home')}}</a></li>
    <li class="breadcrumb-item active">{{translate($title)}}</li>
</ol>
</nav>

<div id="page-title">
    <h2 style="display:inline-block">{{translate($title)}}</h2>
    <div class="right" style="float:right">
        <a class="btn btn-success" href="{{URL::to(PREFIX.'/categories2/create')}}"><i class="glyph-icon icon-plus" style="margin-right:10px;"></i>{{translate('Add New')}}</a>
    </div>
</div>
<div class="panel">
    <div class="panel-box">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" data-toggle="dataTable">
                <thead class="cf">
                    <tr>
                        <th>{{translate('S.N.')}}</th>
                        <th>{{translate('Name') }}</th>
                        <th>{{translate('Attributes')}} </th>
                        <th>{{translate('Action')}} </th>
                    </tr>
                </thead>
                <tbody>
                    @if($categories->isEmpty())
                    <tr>
                        <td class="no-data" colspan="6">
                            <b>{{translate('No data available')}}</b>
                        </td>
                    </tr>
                    @else
                    @php $a=$categories->perPage() * ($categories->currentPage()-1); @endphp
                    @foreach($categories as $datum)
                    @php $a++;@endphp
                    <tr>
                        <td>{{ $a }}</td>
                        <td>{{$datum->title}}</td>
                        <td>
                            @if($permissions['editPermission'])
                            @if($datum->status == 1)
                            <a href="{{url('system/categories').'/'.$datum->id.'/toggle-status'}}" class="btn-success btn-sm" style="text-decoration: none;">Active</a>
                            @else
                            <a href="{{url('system/categories').'/'.$datum->id.'/toggle-status'}}" class="btn-danger btn-sm" style="text-decoration: none;">In-active</a>
                            @endif
                            @else
                            @if($datum->status == 1)
                            <button class="btn-success btn-sm" style="text-decoration: none;">Active</button>
                            @else
                            <button class="btn-danger btn-sm" style="text-decoration: none;">In-active</button>
                            @endif
                            @endif
                        </td>
                        <td>{{$datum->position}}</td>
                        @if($permissions['destroyPermission']|| $permissions['editPermission'])
                        <td>
                            @if($permissions['editPermission'])
                            <a class="btn btn-sm btn-info btn_glyph" href="{{URL::to(PREFIX.'/categories/'.$datum->id.'/edit')}}"><i class="glyphicon glyphicon-edit"></i> {{translate('Edit')}}</a> @endif
                            @if($permissions['destroyPermission'])
                            {!! Form::model($datum, ['method' => 'DELETE', 'route' => ['categories.destroy',$datum->id] , 'class' =>'form-inline form-delete']) !!}
                            {!! Form::hidden('id', $datum->id) !!}
                            <button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="{{$datum->id}}" class="btn btn-sm btn-danger confirm-delete"><i class="glyphicon glyphicon-trash"></i> {{translate('Delete')}} </button>
                            {!! Form::close() !!}
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endSection
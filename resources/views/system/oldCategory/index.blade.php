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
        <a class="btn btn-primary btn-sm" href="{{URL::to(PREFIX.'/categories2/create')}}"> <i class="fa fa-plus"></i> {{translate('Add New')}}</a>
    </div>
</div>
@include('system.partials.message')
<div class="content-display clearfix">
    <div class="panel panel-default">
        <div class="panel-heading no-bdr">
            <div class="row">
                <div class="col-sm-6">
                    {!!Form::open(['method'=>'GET','url'=>PREFIX.'/categories2', 'class'=>'form-inline'])!!}
                    <div class="form-group">
                        <input type="text" class="form-control" name="keyword" value="{{Request::get('keyword')}}" autocomplete="off">
                        <button style="margin-left: 5px;" type="submit" class="btn btn-primary">{{translate('Search')}}</button>
                    </div>
                </div>
                {!!Form::close() !!}

            </div>
        </div>
    </div>
</div><br>
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
                        <td>{{$datum->name}}</td>
                        <td>{{$datum->attributes}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary btn_glyph" href="{{URL::to(PREFIX.'/categories2/'.$datum->id.'/edit')}}"><i class="glyphicon glyphicon-edit"></i> {{translate('Edit')}}</a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#confirmDeleteModal" data-href="{{url('/'.PREFIX.'/categories2/'.$datum->id)}}">
                                {{ translate('Delete') }}
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endSection
@extends('system.layouts.master')

@section('title', translate('Add New Category'))

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to(PREFIX.'/home')}}">{{translate('Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to(PREFIX.'/categories')}}">{{translate('Categories')}}</a></li>
    <li class="breadcrumb-item active">{{translate('Add Category')}}</li>
</ol>

<div id="page-title">
    <h2 style="display:inline-block">{{translate('Add Category')}}</h2>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        {!!Form::open(['method'=>'POST','url'=>PREFIX.'/categories2', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
        <div class="form-group row" id="">
            <label for="" class="col-sm-2 col-form-label require">
                Category Name:
            </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" placeholder="Category Name">
            </div>
            @error('name')
            <div class="col-sm-6 invalid-text text-danger">{{translate($message)}}</div>
            @enderror
        </div>
        <div class="form-group row" id="">
            <label for="" class="col-sm-2 col-form-label require">
                Category Attibute:
            </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="attributes" placeholder="Category Attribute">
            </div>
            @error('attributes')
            <div class="col-sm-6 invalid-text text-danger">{{translate($message)}}</div>
            @enderror
        </div>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">
                    {{translate('Create')}}
                </button>
                <a href="{{url('/'.PREFIX.'/categories2')}}" class="btn btn-secondary">
                    {{ translate('Cancel') }}
                </a>
            </div>
        </div>

        {!!Form::close() !!}
        <div class="clearfix"></div>

    </div>
</div>

@stop

@section('scripts')
@stop
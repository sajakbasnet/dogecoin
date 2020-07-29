@extends('system.layouts.form')

@section('inputs')
<x-system.form.form-group :input="['name' => 'name', 'label' => 'Category Name','default'=> $item->name ?? old('name'), 'error' => $errors->first('name')]" />
<x-system.form.form-group :input="['name' => 'attributes', 'label' => 'Category Attribute','default'=> $item->attributes ?? old('attributes'), 'error' => $errors->first('attributes')]" />
@endsection
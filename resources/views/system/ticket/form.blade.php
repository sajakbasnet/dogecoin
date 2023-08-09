@extends('system.layouts.form')
@section('inputs')

<div class="col-md-6 col-sm-12">
    <div class="form-group mg-b-0">
        <label class="form-label">Subject: <span class="tx-danger">*</span></label>
        <input class="form-control" name="subject" id="subject" value="{{$item->subject ?? old('subject')}}" placeholder="Enter Subject" required="" type="text" data-parsley-id="5" aria-describedby="parsley-id-5">

        @if($errors->first('subject') != null)
        <ul class="parsley-errors-list filled" id="valid-subject">
            <li class="parsley-required"> {{ $errors->first('subject') }}</li>
        </ul>
        @endif
    </div>
</div>

<div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label class="form-label">
            Class <span class="tx-danger">*</span>
        </label>
        <select class="form-control" name="class" id="Assigne" required>
            <option value="">Select class</option>
            @foreach($class as $key=>$cl)
            <option value="{{$key}}" @if(isset($item) && $item->class == $key) selected @endif {{ old('class') == $key ? 'selected': ''}}>{{$cl}}</option>
            @endforeach
        </select>
        @if($errors->first('class') != null)
        <ul class="parsley-errors-list filled" id="valid-assigne">
            <li class="parsley-required">{{ $errors->first('class') }}</li>
        </ul>
        @endif
    </div>
</div>

<!-- <div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label class="form-label" for="status">Status: <span class="tx-danger">*</span></label>
        <select class="form-control" name="status" id="status" required>
            <option value="">Select Status</option>
            @foreach($status as $key=>$stat)
            <option value="{{$key}}" @if(isset($item) && $item->status == $key) selected @endif {{ old('status') == $key ? 'selected': ''}}>{{$stat}}</option>
            @endforeach
        </select>
        @if($errors->first('status') != null)
        <ul class="parsley-errors-list filled" id="valid-status">
            <li class="parsley-required">{{ $errors->first('status') }}</li>
        </ul>
        @endif
    </div>
</div> -->

@if(authUser()->roles->first()->name != 'user')
<div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label class="form-label" for="priority">Priority: <span class="tx-danger">*</span></label>
        <select class="form-control" name="priority" id="priority" required>
            <option value="">Select Priority</option>
            @foreach($priority as $key=>$prior)
            <option value="{{$key}}" @if(isset($item) && $item->priority == $key) selected @endif {{ old('priority') == $key ? 'selected': ''}}>{{$prior}}</option>
            @endforeach
        </select>
        @if($errors->first('priority') != null)
        <ul class="parsley-errors-list filled" id="valid-priority">
            <li class="parsley-required">{{ $errors->first('priority') }}</li>
        </ul>
        @endif
    </div>
</div>
@endif
<div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label class="form-label">Description:</label>
        <textarea class="form-control" name="description" id="description" placeholder="Write description of the ticket" required="">
        {{$item->description ?? old('description')}}
        </textarea>
        @if($errors->first('description') != null)
        <ul class="parsley-errors-list filled" id="valid-description">
            <li class="parsley-required">{{ $errors->first('description') }}</li>
        </ul>
        @endif
    </div>
</div>



<div id="actions-submit" class="row col-12 d-flex justify-content-end align-content-start p-0 m-0 mt-2">
</div>


@endsection
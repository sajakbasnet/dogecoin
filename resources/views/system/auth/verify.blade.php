@extends('system.layouts.masterGuest')
@section('title')
{{trans('Verify')}}
@endsection
@section('content')
<div class="login-wrapper">
  <div class="login-inner-wrapper">
    <div class="login-sec">
      <h1 style="color:{{getCmsConfig('cms theme color')}}">{{trans('Enter Verification Code.')}}</h1>
      <p>{{'We have sent you a verification code in your email.'}} <br> {{trans('Copy a 4-digit verification code and enter it below.')}}</p>
      @include('system.partials.message')
      <div class="login-form">
        <form method="post" action="{{route('post.login.verify')}}">
          @csrf
          <div class="form-group login-group">
            <div class="input-group  @error('code')
            has-error
            @enderror">
              <input type="text" name="code" class="form-control" placeholder="{{trans('Please Enter Verification Code.')}}" value="{{old('code')}}">
              <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
            </div>
            @error('code')
            <p class="invalid-text text-danger">{{trans($message)}}</p>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" class="btn login-btn btn-block" style="background-color:{{getCmsConfig('cms theme color')}}">{{trans('Verify')}}</button>
          </div>
          <div class="form-group">
            <h4>Didn't get email?</h4>
            <a href="{{route('login.send.again')}}">{{trans('Send Again')}}</a>
          </div>
        </form>
      </div><!-- ends login-form -->
    </div><!-- ends login-sec -->
  </div>
</div><!-- login-wrapper -->

@endsection
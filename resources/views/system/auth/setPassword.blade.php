@extends('system.layouts.masterGuest')
@section('content')
<div class="login-wrapper">
    <div class="login-inner-wrapper">
        <div class="login-sec">
            <h1 style="color:{{getCmsConfig('cms theme color')}}">{{trans($title)}}</h1>
            <div class="login-form">
                <form method="post" action="{{url(PREFIX.'/set-password')}}">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="form-group login-group @error('email') has-error @enderror">
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" placeholder="Username" value="{{$email}}" readonly>
                            <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                        </div>
                        @error('email')
                        <p class="invalid-text text-danger">{{trans($message)}}</p>
                        @enderror
                    </div>
                    <div class="form-group login-group @error('password') has-error @enderror">
                        <div class="input-group">
                            <input type="Password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        </div>
                        @error('password')
                        <p class="invalid-text text-danger">{{trans($message)}}</p>
                        @enderror
                    </div>
                    <div class="form-group login-group @error('password_confirmation') has-error @enderror">
                        <div class="input-group">
                            <input type="Password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                            <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        </div>
                        @error('password_confirmation')
                        <p class="invalid-text text-danger">{{trans($message)}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn login-btn btn-block" style="background-color: {{getCmsConfig('cms theme color')}}">{{trans($title)}}</button>
                    </div>
                </form>
            </div><!-- ends login-form -->
        </div><!-- ends login-sec -->
    </div>
</div><!-- login-wrapper -->
@endsection
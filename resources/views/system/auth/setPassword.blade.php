@extends('system.layouts.masterGuest')
@section('content')
@php $routename = Route::current()->getName();@endphp
<!-- main-signin-wrapper -->
<div class="my-auto page page-h">
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex wd-100p">
            <div class="p-5 wd-100p">
                <div class="main-signin-header">
                    <form class="theme-form login-form" method="post" action="{{ url(getSystemPrefix() . '/set-password') }}">
                        @csrf
                        @include('system.partials.message')
                        <h4 class="mb-3">{{ translate($title) }}</h4>
                        <input type="hidden" name="token" value="{{$token}}">
                        @if ($routename == 'change.password')
                        <input type="hidden" name="email" value="{{$email}}">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="email" value="{{ $email }}">
                        </div>
                        @else
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="email" name="email" value="{{ $email }}" readonly>
                            </div>
                            @error('email')
                            <p class="invalid-text text-danger">{{ translate($message) }}</p>
                            @enderror
                        </div>
                        @endif
                        <div class="form-group">
                            <label>New Password</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" placeholder="{{ translate('Password') }}">
                            </div>
                            @error('password')
                            <p class="invalid-text text-danger">{{ translate($message) }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Retype Password</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="{{ translate('Confirm Password') }}">
                            </div>
                            @error('password_confirmation')
                            <p class="invalid-text text-danger">{{ translate($message) }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">{{ isset($buttonText) ? translate($buttonText) : translate($title) }}
                            </button>
                        </div>
                        @if ($routename == 'change.password')
                        <div class="form-group">
                            <a href="{{ route('logout') }}" class="btn login-btn btn-danger btn-block" style="padding-top: 13px;">{{ translate('Cancel') }}</a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
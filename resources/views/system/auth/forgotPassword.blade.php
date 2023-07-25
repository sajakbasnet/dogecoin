@extends('system.layouts.masterGuest')
@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div class="login-main">
                        @include('system.partials.message')
                        <form class="theme-form login-form" method="post" action="" id="forgot-password-form">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="fa fa-envelope"></i></span>
                                    <input type="text" name="email" class="form-control" placeholder="Email"
                                           value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <div class="d-block invalid-feedback">{{$errors->first('email')}}</div>
                                @enderror
                            </div>
                            <div class="form-group" id="">
                                <label for="set_password_status" class="input-group">
                                    Reset Password Status ?
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" id="set_password_status-0"
                                                   value="0" checked="" name="reset_password_status">
                                            <label class="form-check-label" for="set_password_status-0">Send Reset
                                                Link</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" id="set_password_status-1"
                                                   value="1" name="reset_password_status">
                                            <label class="form-check-label" for="set_password_status-1">Set Through
                                                OTP</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="forgot-password-btn">{{ translate('Submit') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

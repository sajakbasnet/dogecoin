@extends('system.layouts.masterGuest')
@section('content')
<div id="global-loader" class="light-loader" style="display: none;">
    <img src="https://laravel.spruko.com/xino/ltr/assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->



<!-- main-signin-wrapper -->
<div class="my-auto page page-h">
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex wd-100p">
            <div class="p-5 wd-100p">
                <div class="main-signin-header">
                    <h2>Seja Bem Vindo!</h2>
                    <h4>Por favor, insira seus dados.</h4>
                    <form id="" method="post" action="{{ route('register') }}">
                        @if(!$errors->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first()}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input id="login-user-dog" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter your name" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input id="login-user-dog" name="username" value="{{old('username')}}" class="form-control" placeholder="Enter your Username" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input id="login-user-dog" name="email"  value="{{old('email')}}"class="form-control" placeholder="Enter your email" type="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input  autocomplete="current-password" id="senha-user-dog"  name="password" class="form-control" placeholder="Enter your password" type="password" required>
                        </div>
                        <div class="form-group">
                            <label>Re-Password</label>
                            <input autocomplete="current-password" name="password_confirmation" id="senha-user-dog" class="form-control" placeholder="Re-Enter your password" type="password" required>
                        </div>
                        <!-- @if(auth()->user() && auth()->user()->google2fa_enabled)
                        <p>Two-factor authentication is enabled for your account.</p>
                        <p>Please enter your 2FA token to continue:</p>
                        <input type="text" class="form-control" name="token" required>
                        @endif -->
                        <div class="actions__container">
                            <button class="btn btn-primary btn-block" type="submit">Register</button>
                            <div id="buttonDiv"></div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

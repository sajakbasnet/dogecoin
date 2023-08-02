@extends('system.layouts.masterGuest')
@section('content')
<div id="global-loader" class="light-loader" style="display: none;">
    <img src="https://laravel.spruko.com/xino/ltr/assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="p-5 wd-100p">
                <div class="card card-default">
                    <h4 class="card-heading text-center mt-4">Set up Google Authenticator</h4>
                    <div class="card-body" style="text-align: center;">
                        <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                            @csrf
                            <div class="form-group">
                                <p>Please enter the <strong>OTP</strong> generated on your Authenticator App. <br> Ensure you submit the current one because it refreshes every 30 seconds.</p>
                                <label for="one_time_password" class="col-md-4 control-label">One Time Password</label>
                                <div class="col-md-12" style="text-align: center;">
                                    <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
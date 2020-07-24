<?php

namespace App\Http\Controllers\system\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\system\verifyLoginRequest;
use App\Mail\system\TwoFAEmail;
use App\Traits\CustomThrottleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    use CustomThrottleRequest;
    public function showVerifyPage()
    {
        return view('system.auth.verify');
    }

    public function sendAgain(Request $request)
    {
        if (
            method_exists($this, 'hasTooManyAttempts') &&
            $this->hasTooManyAttempts($request, $attempts = 3) // maximum attempts can be set by passing parameter $attempts=
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->incrementAttempts($request, $minutes = 1); // maximum decay minute can be set by passing parameter $minutes=

        $verification_code = \Str::random(4);
        session()->forget('verification_code');
        session()->put('verification_code', $verification_code);
        Mail::to(authUser()->email)->send(new TwoFAEmail(authUser()));
        return back()->withErrors(['alert-success' => 'Verification code sent to your email.']);
    }

    public function verify(verifyLoginRequest $request)
    {
        if (
            method_exists($this, 'hasTooManyAttempts') &&
            $this->hasTooManyAttempts($request, $attempts = 3) // maximum attempts can be set by passing parameter $attempts=
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->incrementAttempts($request, $minutes = 1); // maximum decay minute can be set by passing parameter $minutes=

        $code = $request->code;
        if (session()->get('verification_code') == $code) {
            session()->put('request_verification_code', $code);
            return redirect('/' . PREFIX . '/home');
        } else {
            return back()->withErrors(['alert-danger' => 'Incorrect Verification Code.']);
        }
    }
}

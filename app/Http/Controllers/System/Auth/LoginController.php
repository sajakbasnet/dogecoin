<?php

namespace App\Http\Controllers\system\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\system\verifyLoginRequest;
use App\Mail\system\TwoFAEmail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Config;
use Illuminate\Support\Facades\Mail;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showLoginForm()
    {
        if (Auth::check()) return redirect('/' . PREFIX . '/home');
        else return view('system.auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            session()->put('role', authUser()->role);
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        if (Config::get('constants.TWOFA') == 1) {
            session()->forget('verification_code');
            $verification_code = \Str::random(4);
            session()->put('verification_code', $verification_code);
            Mail::to(authUser()->email)->send(new TwoFAEmail(authUser()));
        }
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->intended($this->redirectPath());
    }


    public function showVerifyPage()
    {
        return view('system.auth.verify');
    }

    public function sendAgain()
    {
        $verification_code = \Str::random(4);
        session()->forget('verification_code');
        session()->put('verification_code', $verification_code);
        Mail::to(authUser()->email)->send(new TwoFAEmail(authUser()));
        return back()->withErrors(['alert-success' => 'Verification code sent to your email.']);
    }

    public function verify(verifyLoginRequest $request)
    {
        $code = $request->code;
        if (session()->get('verification_code') == $code) {
            session()->put('request_verification_code', $code);
            return redirect('/' . PREFIX . '/home');
        } else {
            return back()->withErrors(['alert-danger' => 'Incorrect Verification Code.']);
        }
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        session()->forget('role');
        $request->session()->invalidate();
        return redirect(PREFIX . '/login')->withErrors(['alert-success' => 'Successfully logged out!']);
    }
}

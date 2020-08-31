<?php

namespace App\Http\Controllers\system\Auth;

use App\Http\Controllers\Controller;
use App\Mail\system\TwoFAEmail;
use App\Model\Config as conf;
use App\Traits\CustomThrottleRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Mail;
use Auth;
use Illuminate\Support\Facades\Cookie;

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

    use AuthenticatesUsers, CustomThrottleRequest;

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
            method_exists($this, 'hasTooManyAttempts') &&
            $this->hasTooManyAttempts($request, $attempt = 3) // maximum attempts
        ) {
            $this->customFireLockoutEvent($request);

            return $this->customLockoutResponse($request);
        }
        $user = $this->loginType($request);

        if (Auth::attempt($user)) {

            session()->put('role', authUser()->role);
            setConfigCookie();
            activity()->log('User logged in.');
            return $this->sendLoginResponse($request);
        }

        $this->incrementAttempts($request, $decay = 1); // decay minutes

        return $this->sendFailedLoginResponse($request);
    }
    public function loginType(Request $request)
    {
        $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $request->merge([
            $login_type => $request->input('email')
        ]);
        $user = array(
            $login_type => $request->get($login_type),
            'password' => $request->get('password'),
        );
        return $user;
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

        $this->clearAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        if (Config::get('constants.TWOFA') == 1) {
            session()->forget('verification_code');
            $verification_code = mt_rand(100000, 999999);
            session()->put('verification_code', $verification_code);
            Mail::to(authUser()->email)->send(new TwoFAEmail(authUser()));
        }
        return redirect('/' . PREFIX . '/home');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        session()->forget('role');
        $request->session()->invalidate();
        return redirect(PREFIX . '/login')->withErrors(['alert-success' => 'Successfully logged out!']);
    }
}

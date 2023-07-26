<?php


namespace App\Http\Controllers\System\Auth;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Mail\system\TwoFAEmail;
use App\Model\Loginlogs;
use App\Traits\CustomThrottleRequest;
use Auth;
use GuzzleHttp;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Config;

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/' . getSystemPrefix() . '/home');
        } else {
            return view('system.auth.login');
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        try {
            if (
                method_exists($this, 'hasTooManyAttempts') &&
                $this->hasTooManyAttempts($request, 4) // maximum attempts
            ) {
                $this->customFireLockoutEvent($request);

                return $this->customLockoutResponse($request);
            }
            $user = $this->loginType($request);

            if (Auth::attempt($user)) {
                setRoleCache(authUser());
                setConfigCookie();
                $this->createLoginLog($request);

                return $this->sendLoginResponse($request);
            }

            $this->incrementAttempts($request, 2); // decay minutes

            return $this->sendFailedLoginResponse($request);
        } catch (\Exception $e) {
            if (authUser() != null) {
                clearRoleCache(authUser());
                $this->guard()->logout();
            }
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function loginType(Request $request)
    {
        $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $request->merge([
            $login_type => $request->input('email'),
        ]);

        return [
            $login_type => $request->get($login_type),
            'password' => $request->get('password'),
        ];
    }

    public function createLoginLog($request)
    {
        $client = new GuzzleHttp\Client(['base_uri' => Config::get('constants.API_URL')]);
        $res = $client->request('GET', '/json/' . $request->ip());
        $ipResponse = json_decode($res->getBody());

        if ($ipResponse->status == 'fail') {
            $ipResponse = '';
        }

        return Loginlogs::create([
            'user_id' => authUser()->id,
            'ip' => !empty($ipResponse) ? $ipResponse->query : Config::get('constants.IP_ADDRESS'),
            'city' => !empty($ipResponse) ? $ipResponse->city : 'Kathmandu',
            'country' => !empty($ipResponse) ? $ipResponse->country : 'Nepal',
            'isp' => !empty($ipResponse) ? $ipResponse->isp : 'Vianet Communications Pvt.',
            'lat' => !empty($ipResponse) ? $ipResponse->lat : '27.7167',
            'lon' => !empty($ipResponse) ? $ipResponse->lon : '85.3167',
            'timezone' => !empty($ipResponse) ? $ipResponse->timezone : 'Asia/Kathmandu',
            'region_name' => !empty($ipResponse) ? $ipResponse->regionName : 'Central Region',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        if (authUser()->is_2fa_enabled) {
            session()->forget('verification_code');
            $verification_code = random_int(100000, 999999);
            session()->put('verification_code', $verification_code);
            try {
                Mail::to(authUser()->email)->send(new TwoFAEmail(authUser()));
            } catch (\Exception $e) {
                throw new CustomGenericException($e->getMessage());
            }
            return redirect('/' . getSystemPrefix() . '/login/verify');
        }

        return redirect('/' . getSystemPrefix() . '/home');
    }

    public function logout(Request $request)
    {
        if (authUser() != null) {
            clearRoleCache(authUser());
        }
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect(getSystemPrefix() . '/login')->withErrors(['alert-success' => 'Successfully logged out!']);
    }
}

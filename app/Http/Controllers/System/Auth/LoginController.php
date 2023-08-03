<?php


namespace App\Http\Controllers\System\Auth;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Model\Loginlogs;
use App\Traits\CustomThrottleRequest;
use Auth;
use GuzzleHttp;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use ParagonIE\ConstantTime\Base32;
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
                $this->hasTooManyAttempts($request, Config::get('constants.DEFAULT_LOGIN_ATTEMPT_LIMIT')) // maximum attempts
            ) {
                $this->customFireLockoutEvent($request);

                return $this->customLockoutResponse($request);
            }
            $user = $this->loginType($request);
          
            if (Auth::attempt($user)) {   
                         
                setRoleCache(authUser()->load('roles'));             

                // $this->createLoginLog($request);
               
                return $this->sendLoginResponse($request);
            }

            $this->incrementAttempts($request, Config::get('constants.DEFAULT_LOGIN_ATTEMPT_EXPIRATION')); // decay minutes

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

        if (authUser()->google2fa_enabled) {
            $data = $this->twoFa(authUser());
            return view('system.auth.2fa-setup', $data);
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

    public function twoFa($user)
    {
        $data['secret'] = $this->generateSecret();

        //encrypt and then save secret.
        $google2fa = app('pragmarx.google2fa');
       
        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }
        //generate image for QR barcode
        if ($user->google2fa_secret) {
            $data['imageDataUri'] = $google2fa->getQRCodeInline(
                config('app.name'),
                $user->email,
                $user->google2fa_secret
            );
        }
        $data['user'] = $user;       

       return $data;
    }
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }
}

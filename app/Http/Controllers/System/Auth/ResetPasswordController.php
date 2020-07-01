<?php

namespace App\Http\Controllers\system\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\system\setResetRequest;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    public function __construct(UserService $user)
    {
        $this->service = $user;
    }

    public function showSetResetForm(Request $request)
    {
        $data['title'] = 'Set Password';
        if ($request->route()->getName() == "reset.password") $data['title'] = 'Reset Password';;
        $user = $this->service->findByEmailAndToken($request->email, $request->token);
        if (isset($user)) {
            $data['email'] = $request->email;
            $data['token'] = $request->token;
            return view('system.auth.setPassword', $data);
        } else {
            throw new NotFoundHttpException;
        }
    }

    public function handleSetResetPassword(setResetRequest $request)
    {
        $this->setResetPassword($request);
        return redirect(PREFIX . '/login')->withErrors(['alert-success' => 'Password has been successfully set.']);
    }

    public function setResetPassword($request){
        $user = $this->service->findByEmailAndToken($request->email, $request->token);
        return $user->update([
            'password' => Hash::make($request->password),
            'token' => $this->service->generateToken(24)
        ]);
    }
}

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
        if($this->setResetPassword($request)) {$redirect = redirect(PREFIX.'/login'); $msg = ['alert-success' => 'Password has been successfully set.'];}
        else {$redirect = back();$msg = ['alert-danger' => 'Please provide the new password.'];}
        return $redirect->withErrors($msg);
    }

    public function setResetPassword($request)
    {
        $user = $this->service->findByEmailAndToken($request->email, $request->token);

        $check = $this->checkOldPasswords($user, $request);
        if($check){
            $password = Hash::make($request->password);
            if($user->userPasswords->count() < 10) $user->userPasswords()->create(['password' => $password]);
            $user->update([
                'password' => $password,
                'token' => $this->service->generateToken(24)
            ]);

            return true;
        }
        else return false;
    }

    public function checkOldPasswords($user, $request)
    {
        $oldPasswords = $user->userPasswords()->get();
        $check = true;
        foreach ($oldPasswords as $oldPassword) {
            if(Hash::check($request->password, $oldPassword->password)){
                $check = false;
                break;
            }
        }
        return $check;
    }
}

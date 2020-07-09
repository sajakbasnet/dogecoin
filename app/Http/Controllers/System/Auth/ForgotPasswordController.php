<?php

namespace App\Http\Controllers\system\Auth;

use App\Http\Controllers\Controller;
use App\Mail\system\PasswordResetEmail;
use App\Services\UserService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct(UserService $user){
        $this->user = $user;

    }
    public function showRequestForm()
    {
        $title = trans('Forgot-password');
        return view('system.auth.forgotPassword', compact('title'));
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $this->sendPasswordResetLink($request->email);
        return back()->withErrors(['alert-success' => "Password reset link has been sent to your email."]);
    }

    public function sendPasswordResetLink($email){
        $user = $this->user->findByEmail($email);
        $token = $this->user->generateToken(24);
        $encryptedToken = encrypt($token);
        $user->update([
            'token' => $token
        ]);
        Mail::to($user->email)->send(new PasswordResetEmail($user, $encryptedToken));
    }
}

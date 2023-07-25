<?php

namespace App\Http\Controllers\System\Auth;

use App\Exceptions\ResourceNotFoundException;
use App\Mail\system\ResendOtpEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\System\UserService;
use Illuminate\Support\Facades\Mail;
use App\Traits\CustomThrottleRequest;
use App\Mail\system\PasswordResetEmail;
use App\Exceptions\CustomGenericException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Config;

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

    use SendsPasswordResetEmails, CustomThrottleRequest;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function showRequestForm()
    {
        $title = 'Forgot-password';
        return view('system.auth.forgotPassword', compact('title'));
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        try {
            if (
                method_exists($this, 'hasTooManyAttempts') &&
                $this->hasTooManyAttempts($request, 4) // maximum attempts can be set by passing parameter $attempts=
            ) {
                $this->customFireLockoutEvent($request);

                return $this->customLockoutResponse($request);
            }

            $this->incrementAttempts($request, 5); // maximum decay minute can be set by passing parameter $minutes=

            $this->sendPasswordResetLink($request->email);

            return back()->withErrors(['alert-success' => 'Password reset link has been sent to your email.']);

        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function sendPasswordResetLink($email)
    {
        $user = $this->user->findByEmail($email);
        $token = $this->user->generateToken(24);
        $otpCode = $this->user->generateOtp();
        $encryptedToken = encrypt($token);
        $defaultLinkExpiration = Config::get('constants.DEFAULT_LINK_EXPIRATION');

//        if ($user->expiry_datetime >= now()->format('Y-m-d H:i:s')) {
//            throw new ResourceNotFoundException("The OTP code has been sent to your email and it is still valid.");
//        }

        $user->update([
            'token' => $token,
            'otp_code' => $otpCode,
            'expiry_datetime' => now()->addMinutes($defaultLinkExpiration)->format('Y-m-d H:i:s')
        ]);

        Mail::to($user->email)->send(new PasswordResetEmail($user, $encryptedToken, $otpCode));
    }

    public function resendOtpCode($email)
    {
        $otpCode = $this->user->generateOtp();
        $user = $this->user->findByEmail($email);
        $user->update([
            'otp_code' => $otpCode,
        ]);

        Mail::to($user->email)->send(new ResendOtpEmail($user, $otpCode));

        return redirect()->route('forgot.password.otp')->withErrors(['alert-success' => 'OTP code has been sent to your email.']);
    }
}

<?php

namespace App\Http\Controllers\System\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\System\UserService;
use Illuminate\Support\Facades\Mail;
use App\Traits\CustomThrottleRequest;
use App\Mail\system\PasswordResetEmail;
use App\Exceptions\CustomGenericException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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

            $this->incrementAttempts($request, 2); // maximum decay minute can be set by passing parameter $minutes=

            $this->sendPasswordResetLink($request->email, $request->reset_password_status);

            $selectedOption = $request->input('reset_password_status');

            // Perform the appropriate redirection based on the selected option
            if ($selectedOption == 1) {
                $email = $request->email;
                return redirect()->route('forgot.password.otp', ['email' => $email])->withErrors(['alert-success' => 'OTP code has been sent to your email.']);

            } elseif ($selectedOption == 0) {
                return back()->withErrors(['alert-success' => 'Password reset link has been sent to your email.']);
            }

        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function sendPasswordResetLink($email, $resetPasswordStatus)
    {
        $user = $this->user->findByEmail($email);
        $token = $this->user->generateToken(24);
        $otpCode = $resetPasswordStatus ? $this->user->generateOtp() : null;
        $encryptedToken = encrypt($token);
        $user->update([
            'token' => $token,
            'otp_code' => $otpCode,
            'expiry_datetime' => now()->addMinutes(30)->format('Y-m-d H:i:s')
        ]);

        Mail::to($user->email)->send(new PasswordResetEmail($user, $encryptedToken, $otpCode, $resetPasswordStatus));
    }
}

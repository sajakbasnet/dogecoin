<?php

namespace App\Mail\system;

use App\Traits\Mail;
use Cookie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels, Mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $encryptedToken, $otpCode, $resetPasswordStatus = 0)
    {
        $this->user = $data;
        $this->token = $encryptedToken;
        $this->resetPasswordStatus = $resetPasswordStatus;
        $this->otpCode = $otpCode;
        $this->locale = Cookie::get('lang');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->resetPasswordStatus == 1) { // when user select opt as reset password
            $emailCode = 'OTPEmail';
        } else {
            $emailCode = 'PasswordResetLinkEmail';
        }

        $content = $this->parseEmailTemplate([
            '%user_name%' => $this->user->name,
            '%otp_code%' => $this->otpCode ?? null,
            '%password_reset_link%' => $this->user->getPasswordSetResetLink(false, $this->token),
        ], $emailCode, $this->locale);

        return $this->view('system.mail.index', compact('content'));
    }
}

<?php

namespace App\Mail\system;

use App\Traits\Mail;
use Cookie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResendOtpEmail extends Mailable
{
    use Queueable, SerializesModels, Mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $otpCode)
    {
        $this->user = $data;
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
        $content = $this->parseEmailTemplate([
            '%user_name%' => $this->user->name,
            '%otp_code%' => $this->otpCode,
        ], 'ResendOtpCodeEmail', $this->locale);

        return $this->view('system.mail.index', compact('content'));
    }
}

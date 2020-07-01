<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\system\AccountCreatedEmail;
use App\Mail\system\PasswordSetEmail;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisteredEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
          if (!isset($user->password)) {
            $user->update(['token' => $this->service->generateToken(24)]);
            Mail::to($user->email)->send(new PasswordSetEmail($user));
        } else {
            Mail::to($user->email)->send(new AccountCreatedEmail($user));
        }
    }
}

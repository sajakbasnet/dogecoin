<?php

namespace App\Http\Middleware\Frontend;

use App\Traits\Api\ResponseTrait;
use Closure;
use Auth;

class frontendAuth
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('frontendUsers')->check()) {
            return $this->setStatusCode(401)->unauthenticated();
        }
        $request = $this->addUserToRequest($request);
        return $next($request);
    }

    private function addUserToRequest($request)
    {
        $user = Auth::guard('frontendUsers')->user();
        $request->merge(['user' => $user]);
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        Auth::setUser($user);
        return $request;
    }
}

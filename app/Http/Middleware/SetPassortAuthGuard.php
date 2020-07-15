<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class SetPassortAuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'api')
    {
        Config::set('auth.passport.guard', $guard);
        return $next($request);
    }
}

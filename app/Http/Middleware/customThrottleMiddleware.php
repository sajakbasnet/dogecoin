<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests;

class customThrottleMiddleware extends ThrottleRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $maxAttempts = 2, $decayMinutes = 1, $prefix="")
    {
        dd('here');
        $key = $prefix.$this->resolveRequestSignature($request);

        // $original = parent::handle($request, $next, $maxAttempts, $decayMinutes);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts, $decayMinutes)) {
            dd('here');
        }

        return $next($request);
    }
}

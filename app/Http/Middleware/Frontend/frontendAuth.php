<?php

namespace App\Http\Middleware\Frontend;

use Closure;
use Auth;

class frontendAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('frontendUsers')->check()){
            return response()->json([
                "message" => "Unauthenticated"
            ]);
        }
        return $next($request);
    }
}

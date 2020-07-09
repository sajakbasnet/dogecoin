<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionDeniedException;
use Closure;

class Permission
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
        if (session()->get('role') == null ) {
            session()->put('role', authUser()->role);
        }
        if (\ekHelper::hasPermission($request->url(), $request->method())) return $next($request);
        else throw new PermissionDeniedException();
    }
}

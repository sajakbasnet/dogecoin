<?php

namespace App\Http\Middleware;

use App\Services\LanguageService;
use Closure;
use Illuminate\Support\Facades\View;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct(LanguageService $languageService){
        $this->languageService = $languageService;
    }
    public function handle($request, Closure $next)
    {
        $languages = $this->languageService->getBackendLanguages();
        View::share('globalLanguages', $languages);
        
        return $next($request);
    }
}

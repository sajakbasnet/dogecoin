<?php

namespace App\Http\Controllers\system\language;

use App\Http\Controllers\Controller;
use App\Http\Controllers\system\ResourceController;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends ResourceController
{
    public function __construct(LanguageService $languageService)
    {
        parent::__construct($languageService);
    }
    
    public function validationRequest()
    {
        return 'App\Http\Requests\system\languageRequest';
    }
    
    public function moduleName()
    {
        return 'languages';
    }

    public function viewFolder()
    {
        return 'system.language';
    }

    public function setLanguage($lang)
    {
        Cookie::queue('lang', $lang, 20000);
        session()->put('lang', $lang);
        return back();
    }
}

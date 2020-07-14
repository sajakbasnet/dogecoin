<?php

namespace App\Http\Controllers\system\language;

use App\Http\Controllers\Controller;
use App\Http\Controllers\system\ResourceController;
use App\Services\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends ResourceController
{
    public function __construct(LanguageService $languageService){
        parent::__construct($languageService, 'App\Http\Requests\system\languageRequest');
    }
    public function moduleName(){
        return 'languages';
    }

    public function viewFolder()
    {
        return 'system.language';
    }

    public function setLanguage(Request $request){
        session()->put('lang', $request->lang);
        return back(); 
     }
}


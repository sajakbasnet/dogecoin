<?php

namespace App\Http\Controllers\system\language;

use App\Http\Controllers\Controller;
use App\Http\Controllers\system\ResourceController;
use App\Http\Requests\system\translationRequest;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends ResourceController
{
    public function __construct(TranslationService $translationService)
    {
        parent::__construct($translationService, 'App\Http\Requests\system\translationRequest');
    }

    public function moduleName()
    {
        return 'translations';
    }

    public function viewFolder()
    {
        return 'system.translation';
    }
}

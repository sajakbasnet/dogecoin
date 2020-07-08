<?php

namespace App\Http\Controllers\system\systemConfig;

use App\Http\Controllers\Controller;
use App\Http\Controllers\system\ResourceController;
use App\Services\EmailTemplateService;
use Illuminate\Http\Request;

class emailTemplateController extends ResourceController
{
    public function __construct(EmailTemplateService $service){
        $this->service = $service;
    }
    public function moduleName(){
        return 'email-templates';
    }

    public function viewFolder()
    {
        return 'system.email-template';
    }
}

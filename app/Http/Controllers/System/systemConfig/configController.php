<?php

namespace App\Http\Controllers\system\systemConfig;
use App\Http\Controllers\system\ResourceController;
use App\Services\ConfigService;

class configController extends ResourceController
{
    public function __construct(ConfigService $configService){
        parent::__construct($configService);
    }
    
    public function validationRequest()
    {
        return 'App\Http\Requests\system\ConfigRequest';
    }

    public function moduleName(){
        return 'configs';
    }

    public function viewFolder()
    {
        return 'system.config';
    }
}

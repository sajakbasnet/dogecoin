<?php

namespace App\Http\Controllers\system\logs;

use App\Http\Controllers\system\ResourceController;
use App\Services\LogService;

class LogsController extends ResourceController
{
    public function __construct(LogService $logService)
    {
        parent::__construct($logService);
    }

    public function moduleName()
    {
        return 'logs';
    }

    public function viewFolder()
    {
        return 'system.log';
    }
}

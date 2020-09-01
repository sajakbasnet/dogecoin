<?php

namespace App\Http\Controllers\system\logs;

use App\Http\Controllers\system\ResourceController;
use App\Services\LoginLogService;

class LoginLogsController extends ResourceController
{
    public function __construct(LoginLogService $loginService){
        parent::__construct($loginService);
    }

    public function moduleName()
    {
        return 'login-logs';
    }

    public function viewFolder()
    {
        return 'system.loginLogs';
    }
}

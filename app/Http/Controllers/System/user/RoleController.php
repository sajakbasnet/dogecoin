<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\System\ResourceController;
use App\Services\RoleService;

class RoleController extends ResourceController
{
    public function __construct(RoleService $roleService)
    {
        parent::__construct($roleService, 'App\Http\Requests\system\roleRequest');
    }

    public function moduleName()
    {
        return 'roles';
    }

    public function viewFolder()
    {
        return 'system.role';
    }
}

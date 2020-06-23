<?php

namespace App\Http\Controllers\System\user;

use App\Http\Controllers\System\ResourceController;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends ResourceController
{
    public function __construct(RoleService $roleService){
        $this->service = $roleService;
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

<?php

namespace App\Http\Controllers\System\user;

use App\Http\Controllers\System\ResourceController;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends ResourceController
{
    public function __construct(UserService $userService){
        $this->service = $userService;
    }

    public function moduleName(){
        return 'users';
    }

    public function viewFolder()
    {
        return 'system.user';
    }
}

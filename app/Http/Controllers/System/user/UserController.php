<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\System\ResourceController;
use App\Http\Requests\system\userRequest as customRequest;
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

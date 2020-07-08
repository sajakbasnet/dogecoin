<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\System\ResourceController;
use App\Http\Requests\system\userRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Parent_;

class UserController extends ResourceController
{
    public function __construct(UserService $userService){
        parent::__construct($userService, 'App\Http\Requests\system\userRequest');
    }

    public function moduleName(){
        return 'users';
    }

    public function viewFolder()
    {
        return 'system.user';
    }
}

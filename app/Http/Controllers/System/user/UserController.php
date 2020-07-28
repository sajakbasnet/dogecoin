<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\System\ResourceController;
use App\Http\Requests\system\userRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Parent_;

class UserController extends ResourceController
{
    public function __construct(UserService $userService)
    {
        parent::__construct($userService);
    }

    public function validationRequest()
    {
        return 'App\Http\Requests\system\userRequest';
    }

    public function moduleName()
    {
        return 'users';
    }

    public function viewFolder()
    {
        return 'system.user';
    }

    public function changePassword()
    {
        if (authUser()->password_resetted == 0) {
            $data['title'] = 'Please change your password for security reasons.';
            $data['email'] = authUser()->email;
            $data['token'] = encrypt(authUser()->token);
            $data['buttonText'] = "Change Password";
            return view('system.auth.setPassword', $data);
        } else return redirect(PREFIX . '/home');
    }
}

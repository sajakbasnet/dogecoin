<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\System\ResourceController;
use App\Http\Requests\system\userRequest as customRequest;
use App\Http\Requests\system\userRequest;
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

    public function store(userRequest $request)
    {
        $store = $this->service->store($request);
        $this->setModuleId($store->id);
        return redirect($this->getUrl())->withErrors(['success' => 'Successfully created.']);
    }

    public function update(userRequest $request, $id)
    {
        $this->service->update($id, $request);
        $this->setModuleId($id);
        return redirect($this->getUrl())->withErrors(['success' => 'Successfully updated.']);
    }
}

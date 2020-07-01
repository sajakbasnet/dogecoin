<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\System\ResourceController;
use App\Http\Requests\system\roleRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends ResourceController
{
    public function __construct(RoleService $roleService)
    {
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

    public function store(roleRequest $request)
    {
        $store = $this->service->store($request);
        $this->setModuleId($store->id);
        return redirect($this->getUrl())->withErrors(['success' => 'Successfully created.']);
    }

    public function update(roleRequest $request, $id)
    {
        $this->service->update($id, $request);
        $this->setModuleId($id);
        return redirect($this->getUrl())->withErrors(['success' => 'Successfully updated.']);
    }
}

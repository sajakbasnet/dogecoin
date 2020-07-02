<?php

namespace App\Http\Controllers\system\systemConfig;

use App\Http\Controllers\Controller;
use App\Http\Controllers\system\ResourceController;
use App\Http\Requests\system\ConfigRequest;
use App\Services\ConfigService;

class configController extends ResourceController
{
    public function __construct(ConfigService $configService){
        $this->service = $configService;
    }
    public function moduleName(){
        return 'configs';
    }

    public function viewFolder()
    {
        return 'system.config';
    }

    public function store(ConfigRequest $request)
    {
        $store = $this->service->store($request);
        $this->setModuleId($store->id);
        return redirect($this->getUrl())->withErrors(['success' => 'Successfully created.']);
    }

    public function update(ConfigRequest $request, $id)
    {
        $this->service->update($id, $request);
        $this->setModuleId($id);
        return redirect($this->getUrl())->withErrors(['success' => 'Successfully updated.']);
    }
}

<?php

namespace App\Http\Controllers\system\profile;

use App\Http\Controllers\system\ResourceController;
use App\Services\ProfileService;

class ProfileController extends ResourceController
{
    public function __construct(ProfileService $profileService)
    {
        parent::__construct($profileService, 'App\Http\Requests\system\profileRequest');
    }

    public function moduleName()
    {
        return 'profile';
    }
    public function viewFolder()
    {
        return 'system.profile';
    }
}

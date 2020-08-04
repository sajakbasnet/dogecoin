<?php

namespace App\Http\Controllers\system\category;

use App\Http\Controllers\system\ResourceController;
use App\Services\CategoryService;

class categoryController extends ResourceController
{
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct($categoryService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\categoryRequest';
    }

    public function updateValidationRequest()
    {
        return 'App\Http\Requests\system\categoryRequest';
    }

    public function moduleName()
    {
        return 'categories';
    }

    public function viewFolder()
    {
        return 'system.category';
    }
}

<?php

namespace App\Http\Controllers\system\category;

use App\Http\Controllers\system\ResourceController;
use App\Services\SubCategoryService;

class SubCategoryController extends ResourceController
{
    public function __construct(SubCategoryService $subCategoryService){
        parent::__construct($subCategoryService);
    }

    public function isSubModule()
    {
        return true;
    }

    public function moduleName()
    {
        return 'categories';
    }

    public function subModuleName()
    {
        return 'sub-category';
    }

    public function viewFolder()
    {
        return 'system.category';
    }
}

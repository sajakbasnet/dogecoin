<?php

namespace App\Services\System;

use App\Model\Category;
use App\Services\Service;

class CategoryService extends Service
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}

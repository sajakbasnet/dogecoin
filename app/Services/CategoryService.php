<?php
namespace App\Services;

use App\Model\Category;

class CategoryService extends Service
{
    public function __construct(Category $category){
        parent::__construct($category);
    }
}
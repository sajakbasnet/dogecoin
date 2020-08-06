<?php
namespace App\Services;

use App\Model\Category;

class CategoryService extends Service
{
    public function __construct(Category $category){
        parent::__construct($category);
    }

    public function apiIndexData(){
        return $this->model->paginate(20);
    }
    public function singleData($id){
        return $this->find($id);
    }
}
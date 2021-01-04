<?php

namespace App\Services;

use App\Model\Category;

class CategoryService extends Service
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    public function indexPageData($request)
    {
        return [
            'items' => $this->model->where('parent_id', null)->paginate(20)
        ];
    }

    public function singleData($id)
    {
        return $this->model->find($id);
    }
}

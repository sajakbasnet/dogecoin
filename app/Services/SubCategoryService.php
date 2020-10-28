<?php

namespace App\Services;

use App\Model\Category;

class SubCategoryService extends Service
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->model->where('parent_id', $request->id)->paginate(20)
        ];
    }

    public function editPageData($request, $id)
    {
        return [
            'item' => $this->itemByIdentifier($request->sub_category)
        ];
    }


    public function store($request)
    {
        $data = $request->except('_token');
        $data['parent_id'] = $request->id;
        return $this->model->create($data);
    }

    public function update($request, $id)
    {
        $subCategory = $this->itemByIdentifier($request->sub_category);
        return $subCategory->update($request->only('name', 'attributes'));
    }

    public function delete($request, $id)
    {
        $subCategory = $this->itemByIdentifier($request->sub_category);
        return $subCategory->delete();
    }
}

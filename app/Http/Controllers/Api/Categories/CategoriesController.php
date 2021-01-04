<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Transformers\CategoriesTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use Auth;
class CategoriesController extends ApiController
{
    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
        parent::__construct(new Manager);
    }

    public function index(Request $request)
    {
        $categories = $this->service->indexPageData($request);
        return $this->respondWithCollection($categories['items'], new CategoriesTransformer, 'Categories');
    }


    public function detail($id)
    {
        $category = $this->service->singleData($id);
        if ($category == null) return $this->errorNotFound();
        return $this->respondWithItem($category, new CategoriesTransformer, 'Categories');
    }
}

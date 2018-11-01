<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

/**
 * Class CategoryApiController
 * @package App\Http\Controllers
 */
class CategoryApiController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    public function __construct(Category $category)
    {
        $this->categoryService = new CategoryService($category);
    }

    /**
     * Full list of categories
     *
     * @return \App\Http\Resources\CategoriesResource
     */
    public function categoryTree()
    {
        return $this->categoryService->getTree();
    }

    /**
     * Full list of categories (not tree)
     *
     * @return \App\Http\Resources\CategoriesResource
     */
    public function categoryList()
    {
        return $this->categoryService->getList();
    }

    /**
     * Items list for category
     *
     * @param Request $request
     * @return \App\Http\Resources\ItemsResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function itemsList(Request $request)
    {
        $this->validate($request, [
            'id' => [
                'required',
                'integer'
            ]
        ]);

        $result = $this->categoryService->items($request);

        return $result;
    }


    /**
     * Crate new category
     *
     * @param Request $request
     * @return \App\Http\Resources\CategoryResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            'parent_id' => [
                'integer'
            ]
        ]);

        $result = $this->categoryService->create($request);

        return $result;
    }
}

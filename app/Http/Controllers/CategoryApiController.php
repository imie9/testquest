<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use \Illuminate\Validation\ValidationException;
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
     * @param Request $request
     * @return \App\Http\Resources\ItemsResource|array
     */
    public function itemsList(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => [
                    'required',
                    'integer'
                ]
            ]);
        } catch(ValidationException $e) {
            return [
                'data' => [],
                'error' => $e->getMessage()
            ];
        }

        $result = $this->categoryService->items($request);

        return $result;
    }


    /**
     * @param Request $request
     * @return \App\Http\Resources\CategoryResource|array
     */
    public function create(Request $request)
    {
        try {
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
        } catch(ValidationException $e) {
            return [
                'data' => [],
                'error' => $e->getMessage()
            ];
        }

        $result = $this->categoryService->create($request);

        return $result;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: imie
 * Date: 31.10.18
 * Time: 20:57
 */

namespace App\Services;

use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemsResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryService constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->categoryRepository = new CategoryRepository($category);
    }


    /**
     * @return CategoriesResource
     */
    public function getTree(): CategoriesResource
    {
        $list = $this->categoryRepository->allWithHierarchy();

        return new CategoriesResource($list);
    }


    /**
     * @return CategoriesResource
     */
    public function getList(): CategoriesResource
    {
        $list = $this->categoryRepository->all();

        return new CategoriesResource($list);
    }

    /**
     * @param Request $request
     * @return ItemsResource
     */
    public function items(Request $request): ItemsResource
    {
        $category_id = $request->post()['id'];

        $items = $this->categoryRepository->items($category_id);

        return new ItemsResource($items);
    }

    /**
     * @param Request $request
     * @return CategoryResource
     */
    public function create(Request $request): CategoryResource
    {
        $data = $request->post();

        $category = $this->categoryRepository->create($data);

        if (!empty($data['parent_id'])) {
            $parent = $this->categoryRepository->getById($data);
            $category->makeChildOf($parent);
        }

        return new CategoryResource($category);
    }
}
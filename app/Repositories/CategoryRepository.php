<?php
/**
 * Created by PhpStorm.
 * User: imie
 * Date: 31.10.18
 * Time: 16:45
 */

namespace App\Repositories;

use App\Models\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository implements CategoryRepositoryInterface
{

    protected $category;

    /**
     * CategoryRepository constructor.
     * @param Category $categoryModel
     */
    public function __construct(Category $categoryModel)
    {
        $this->category = $categoryModel;
    }

    /**
     * @return object
     */
    public function all(): object
    {
        $result = $this->category::all();

        return $result;
    }

    /**
     * @return object
     */
    public function allWithHierarchy(): object
    {
        $result = $this->category::all()->toHierarchy();

        return $result;
    }

    /**
     * @param int $id
     * @return object
     */
    public function items(int $id): object
    {
        $category = $this->category::find(['id' => $id])->first();

        $result = $category->items;

        return $result;
    }

    /**
     * @param array $data
     * @return object
     */
    public function getById(array $data): object
    {
        $category = $this->category::find(['id' => $data['parent_id']])->first();

        return $category;
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        $this->category->name = $data['name'];

        $this->category->save();

        return $this->category;
    }
}
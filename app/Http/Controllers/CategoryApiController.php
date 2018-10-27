<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryApiController
 * @package App\Http\Controllers
 */
class CategoryApiController extends Controller
{
    /**
     * Full list of categories
     *
     * @return array
     */
    public function categoryList()
    {
        $category = new Category();

        $list = $category->getList();

        if (empty($list)) {
            return $this->formatResponse(true, [], 'There are no categories');
        }

        return $this->formatResponse(true, $list);
    }

    /**
     * Full list of categories (not tree)
     *
     * @return array
     */
    public function categoryListNoTree() {
        $category = new Category();

        $list = $category->getNoTreeList();

        if (empty($list)) {
            return $this->formatResponse(true, [], 'There are no categories');
        }

        return $this->formatResponse(true, $list);
    }

    /**
     * Items list for category
     *
     * @param Request $request
     *
     * {
     *  "id": integer
     * }
     * @return array
     */
    public function itemsList(Request $request)
    {
        if (empty($request->post()['id'])) {
            return $this->formatResponse(false, [], 'Please provide the category id: {"id": integer} ');
        }

        $category_id = $request->post()['id'];

        $items = Category::getOwnItems($category_id);

        if (empty($items)) {
            return $this->formatResponse(true, [], 'There are no items for this category');
        }

        return $this->formatResponse(true, $items);
    }

    /**
     * @param Request $request
     *
     * {
     *   "name": string,
     *   "parent_id": integer (optional)
     * }
     *
     * @return array
     */
    public function create(Request $request) {
        $category = new Category();
        if (empty($request->post()['name'])) {
            return $this->formatResponse(false, [], 'Please provide the category id: {"name": string} ');
        }
        $result = $category->createNew($request->post());

        if (!empty($result['msg'])) {
            return $this->formatResponse(false, [], $result['msg']);
        }

        return $this->formatResponse(true, $result, 'Created!');
    }

    /**
     * Make base response
     *
     * {
     *   "success" => boolean,
     *   "data" => array,
     *   "msg" => string (optional)
     * }
     *
     * @param $success boolean
     * @param $data mixed
     * @param $message string | null
     *
     * @return array
     */
    private function formatResponse($success, $data, $message = null)
    {
        $result = [
            'success' => $success,
            'data' => $data
        ];

        if (!empty($message)) {
            $result['msg'] = $message;
        }

        return $result;
    }
}

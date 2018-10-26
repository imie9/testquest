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
    public function categoryList() {
        $category = new Category();

        $list = $category->getList();

        if (empty($list)) {
            return $this->formatResponse(true, [], 'There are no categories');
        }

        return $this->formatResponse(true, $list);
    }

    /**
     * Items list for category
     *
     * @param Request $request
     * {
     *  "id": integer
     * }
     * @return mixed
     */
    public function itemsList(Request $request) {
        $category_id = $request->post()['id'];

        if (empty($category_id)) {
            return $this->formatResponse(false, [], 'Please provide the category id: {"id": integer} ');
        }

        $items = Category::getOwnItems($category_id);

        if (empty($items)) {
            return $this->formatResponse(true, [], 'There are no items for this category');
        }

        return $this->formatResponse(true, $items);
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
     * @return mixed
     */
    private function formatResponse($success, $data, $message = null) {
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

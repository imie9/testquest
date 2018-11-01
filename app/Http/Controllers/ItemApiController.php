<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Services\ItemService;

/**
 * Class ItemApiController
 * @package App\Http\Controllers
 */
class ItemApiController extends Controller
{
    /**
     * @var ItemService
     */
    protected $itemService;

    /**
     * ItemApiController constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->itemService = new ItemService($item);
    }

    /**
     * @param Request $request
     * @return mixed
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
            'category_id' => [
                'integer',
                'required'
            ],
            'description' => [
                'required',
                'string',
                'min:5',
                'max:300'
            ],
            'image' => [
                'required',
                'mimes:jpeg,jpg,png',
                'max:2000'
            ]
        ]);

        $result = $this->itemService->create($request);

        return $result;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function image(Request $request) {
        $result = $this->itemService->image($request);

        return $result;
    }
}

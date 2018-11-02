<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Services\ItemService;
use \Illuminate\Validation\ValidationException;

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
     * @return \App\Http\Resources\ItemResource|array
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
        } catch(ValidationException $e) {
            return [
                'data' => [],
                'error' => $e->getMessage()
            ];
        }

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

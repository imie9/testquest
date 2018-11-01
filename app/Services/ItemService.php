<?php
/**
 * Created by PhpStorm.
 * User: imie
 * Date: 01.11.18
 * Time: 3:11
 */

namespace App\Services;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;

/**
 * Class ItemService
 * @package App\Services
 */
class ItemService
{
    /**
     * @var ItemRepository
     */
    protected $itemRepository;

    /**
     * ItemService constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->itemRepository = new ItemRepository($item);
    }

    /**
     * @param Request $request
     * @return ItemResource
     */
    public function create(Request $request): ItemResource
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(storage_path('images'), $imageName);

        $data = $request->post();
        $data['image_url'] = $imageName;

        $result = $this->itemRepository->create($data);

        return new ItemResource($result);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function image(Request $request) {
        $image = explode('/', $request->url());
        $image = end($image);
        $path = storage_path('images/') . $image;

        if (file_exists($path)) {
            $result = response()->download(
                $path,
                $image,
                ['Content-Type' => 'image/png']
            );
        } else {
            $result = response(null,404);
        }

        return $result;
    }
}
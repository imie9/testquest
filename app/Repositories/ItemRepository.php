<?php
/**
 * Created by PhpStorm.
 * User: imie
 * Date: 01.11.18
 * Time: 3:13
 */

namespace App\Repositories;

use App\Models\Item;

/**
 * Class ItemRepository
 * @package App\Repositories
 */
class ItemRepository implements ItemRepositoryInterface
{

    /**
     * @var Item
     */
    protected $item;

    /**
     * ItemRepository constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @param array $data
     * @return Item
     */
    public function create(array $data): Item
    {
        $this->item->name = $data['name'];
        $this->item->description = $data['description'];
        $this->item->category_id = $data['category_id'];
        $this->item->image_url = $data['image_url'];

        $this->item->save();

        return $this->item;
    }

}
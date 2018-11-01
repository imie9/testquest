<?php
/**
 * Created by PhpStorm.
 * User: imie
 * Date: 01.11.18
 * Time: 3:14
 */

namespace App\Repositories;

use App\Models\Item;

/**
 * Interface ItemRepositoryInterface
 * @package App\Repositories
 */
interface ItemRepositoryInterface
{

    /**
     * @param array $data
     * @return Item
     */
    public function create(array $data): Item;
    
}
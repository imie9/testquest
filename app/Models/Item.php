<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * @package App
 */
class Item extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * Parent category id
     * @var string
     */
    protected $category_id = 'category_id';

    /**
     * Item name
     * @var string
     */
    protected $name = 'name';

    /**
     * Item description
     * @var string
     */
    protected $description = 'description';

    /**
     * Item Image url
     * @var string
     */
    protected $image_url = 'image_url';

    /**
     * With Baum, all NestedSet-related fields are guarded from mass-assignment
     * by default.
     *
     * @var array
     */
    protected $guarded = array('id', 'category_id', 'name', 'description', 'image_url');
}

<?php

namespace App\Models;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

/**
* Category
*/
class Category extends Node {

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'categories';

   /**
    * Column name which stores reference to parent's node.
    *
    * @var string
    */
   protected $parentColumn = 'parent_id';

    /**
     * Column name witch means category name
     *
     * @var string
     */
   protected $name = 'name';

   /**
    * Column name for the left index.
    *
    * @var string
    */
   protected $leftColumn = 'lft';

   /**
    * Column name for the right index.
    *
    * @var string
    */
   protected $rightColumn = 'rgt';

   /**
    * Column name for the depth field.
    *
    * @var string
    */
   protected $depthColumn = 'depth';

   /**
    * Column to perform the default sorting
    *
    * @var string
    */
   protected $orderColumn = null;

   /**
   * With Baum, all NestedSet-related fields are guarded from mass-assignment
   * by default.
   *
   * @var array
   */
   protected $guarded = array('id', 'parent_id', 'name', 'lft', 'rgt', 'depth');


    /**
     * Returns tree of categories
     *
     * @return mixed
     */
   public function getList()
   {
       $tree = self::all()->toHierarchy()->toArray();
       return $tree;
   }

    /**
     * Returns items list for Category by $id
     *
     * @param $id integer
     * @return null
     */
   public static function getOwnItems($id)
   {
       $category = self::find(['id' => $id])->first();

       if (!is_object($category)) {
           return null;
       }
       $items = $category->items->toArray();

       return $items;
   }

   public function create()
   {

   }

    /**
     * Eloquent Category->Items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

}

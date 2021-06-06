<?php

namespace Models;


use Database\DatabaseModel;
use Database\DatabaseTable;

class Menu extends DatabaseModel {

    protected $fillable = [
        'id',
        'category_id',
        'category_slug',
        'name',
        'price',
        'description',
        'visible',
    ];


    /**
     * Menu constructor.
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'menu');
    }

    public static function create($pdo)
    {
        $menu = new Menu($pdo);
        $menu->make($menu, []);

        return $menu;
    }

    public static function with($pdo, $record)
    {
        $menu = new Menu($pdo);
        $menu->make($menu, $record);


        /* Assign category_id if supplied.
         * Find category_id and assign if only category_slug is supplied.
         */
        if (isset($record['category_slug']) && !isset($record['category_id'])) {
            $category = Category::create(getPDO())->find($menu->categorySlug);
            $menu->categoryId = $category->id;
        }

        return $menu;
    }


    /** Database operations:  */

    public function findById($menuId)
    {
        return $this->findByKey('id', $menuId);
    }


    public function findFoodsWithCategorySlug($categorySlug)
    {
        return $this->findAllHaving('category_slug', $categorySlug);
    }
}
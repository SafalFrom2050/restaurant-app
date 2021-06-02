<?php

namespace Models;

class Menu {
    public $id;
    public $categoryId;
    public $categorySlug;
    public $name;
    public $price;
    public $description;

    public $pdo;
    public $table;
    /**
     * Menu constructor.
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->table = new DatabaseTable($pdo, 'menu');
    }
    public static function create($pdo)
    {
        return new Menu($pdo);
    }

    public static function with($pdo, $array)
    {
        $menu = new Menu($pdo);
        isset($array['id']) ? $menu->id = $array['id'] : 0;

        $menu->categoryId = $array['category_id'];
        $menu->categorySlug = $array['category_slug'];
        $menu->name = $array['name'];
        $menu->price = $array['price'];
        $menu->description = $array['description'];

        return $menu;
    }


    /** Database operations:  */

    public function save()
    {
        $stmp = $this->table->insert($this);
        return $stmp->fetch();
    }


    public function findAllFoods()
    {
        $stmt = $this->table->findAll();

        $records = [];
        foreach ($stmt as $record) {
            $record = Menu::with(getPDO(), $record);
            $records[] = $record;
        }
        return $records;
    }

    public function findFoodsWithCategoryId($categorySlug)
    {
        $stmt = $this->table->find('category_slug', $categorySlug);

        $menuList = [];
        foreach ($stmt as $record) {
            $menuList[] = self::with($this->pdo, $record);
        }

        return $menuList;
    }
}
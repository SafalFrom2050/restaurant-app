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
        $menu->id = $array['id'];
        $menu->categoryId = $array['category_id'];
        $menu->categorySlug = $array['category_slug'];
        $menu->name = $array['name'];
        $menu->price = $array['price'];
        $menu->description = $array['description'];

        return $menu;
    }

    public function findAllFoods()
    {
        $stmt = $this->table->findAll();
        return self::with($this->pdo, $stmt);
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
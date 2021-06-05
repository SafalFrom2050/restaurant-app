<?php

namespace Models;


class Menu {
    public $id;
    public $categoryId;
    public $categorySlug;
    public $name;
    public $price;
    public $description;
    public $visible;

    public $pdo;
    public $table;

    public function intoArray()
    {
        return [
            'id' => $this->id,
            'category_id' => $this->categoryId,
            'category_slug' => $this->categorySlug,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'visible' => $this->visible,
        ];
    }

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

    public static function with($pdo, $record)
    {
        $menu = new Menu($pdo);

        if (!is_array($record)) {
            return $menu;
        }

        foreach($record as $key => $value) {
            // convert keys to camelCase first
            $key = snakeToCamelCase($key);
            $menu->$key = $value;
        }


        /** Assign category_id if supplied.
         * Find category_id and assign if only category_slug is supplied.
         */
        if (isset($record['category_slug']) && !isset($record['category_id'])) {
            $category = Category::create(getPDO())->find($menu->categorySlug);
            $menu->categoryId = $category->id;
        }

        return $menu;
    }


    /** Database operations:  */

    public function save()
    {
        return $this->table->insert($this->intoArray());
    }

    public function update($newRecord)
    {
        foreach($newRecord as $key => $value) {
            // convert keys to camelCase first
            $key = snakeToCamelCase($key);
            $this->$key = $value;
        }

        return $this->table->update($this->intoArray(), 'id');
    }

    public function delete($menuId)
    {
        // Returns number of deleted rows;
        return $this->table->delete('id', $menuId);
    }

    public function findById($menuId)
    {
        $stmt = $this->table->find('id', $menuId);
        return self::with($this->pdo, $stmt->fetch());
    }

    public function findAllFoods()
    {
        $stmt = $this->table->findAll();

        $records = [];
        foreach ($stmt as $record) {
            $record = self::with(getPDO(), $record);
            $records[] = $record;
        }
        return $records;
    }

    public function findFoodsWithCategorySlug($categorySlug)
    {
        $stmt = $this->table->find('category_slug', $categorySlug);

        $menuList = [];
        foreach ($stmt as $record) {
            $menuList[] = self::with($this->pdo, $record);
        }

        return $menuList;
    }
}
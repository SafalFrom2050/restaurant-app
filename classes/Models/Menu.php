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

        $menu->id = isset($array['id']) ? $array['id'] : null;
        $menu->categorySlug = isset($array['category_slug']) ? $array['category_slug'] : null;
        $menu->name = $array['name'];
        $menu->price = $array['price'];
        $menu->description = $array['description'];
        $menu->visible = $array['visible'];


        /** Assign category_id if supplied.
         * Find category_id and assign if only category_slug is supplied.
         */
        if (isset($array['category_id'])) {
            $menu->categoryId = $array['category_id'];
        }else if (isset($array['category_slug'])) {
            $category = Category::create(getPDO())->find($menu->categorySlug);
            $menu->categoryId = $category->id;
        }

        return $menu;
    }

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


    /** Database operations:  */

    public function save()
    {
        return $this->table->insert($this->intoArray());
    }

    public function update($record)
    {
        $updated = array_merge($this->intoArray(), $record);
        $menu = self::with($this->pdo, $updated);
        return $this->table->update($menu->intoArray(), 'id');
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
            $record = Menu::with(getPDO(), $record);
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
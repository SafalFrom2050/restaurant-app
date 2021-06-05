<?php

namespace Models;

/**
 * Class Category
 * @package Models
 */
class Category {

    public $id;
    public $name;
    public $slug;

    public $pdo;
    public $table;

    public function intoArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }

    /**
     * Category constructor.
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->table = new DatabaseTable($pdo, 'category');
    }

    public static function create($pdo)
    {
        return new Category($pdo);
    }

    public static function with($pdo, $record)
    {
        $category = new Category($pdo);

        if (!is_array($record)) {
            return $category;
        }

        foreach($record as $key => $value) {
            // convert keys to camelCase first
            $key = snakeToCamelCase($key);
            $category->$key = $value;
        }

        return $category;
    }

    /** Database operations:  */

    public function save()
    {
        return $this->table->insert($this->intoArray());
    }

    public function delete($categoryId)
    {
        // Returns number of deleted rows;
        return $this->table->delete('id', $categoryId);
    }

    public function update()
    {
        return $this->table->update($this->intoArray(), 'id');
    }

    public function findAll()
    {
        $stmt = $this->table->findAll();

        $categories = [];
        foreach ($stmt as $record) {
            $categories[] = self::with($this->pdo, $record);
        }

        return $categories;
    }

    public function find($categorySlug)
    {
        $stmt = $this->table->find('slug', $categorySlug);
        return self::with($this->pdo, $stmt->fetch());
    }

    public function findById($categoryId)
    {
        $stmt = $this->table->find('id', $categoryId);
        return self::with($this->pdo, $stmt->fetch());
    }


}
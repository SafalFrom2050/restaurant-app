<?php

namespace Models;

use Database\DatabaseModel;
use Database\DatabaseTable;

/**
 * Class Category
 * @package Models
 */
class Category extends DatabaseModel {

    protected $fillable = [
        'id',
        'name',
        'slug',
    ];


    /**
     * Category constructor.
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'category');
    }

    public static function create($pdo)
    {
        $category = new Category($pdo);
        $category->make($category, []);

        return $category;
    }

    public static function with($pdo, $record)
    {
        $category = new Category($pdo);
        $category->make($category, $record);

        return $category;
    }

    /** Database operations:  */

    public function find($categorySlug)
    {
        return $this->findByKey('slug', $categorySlug);
    }

    public function findById($id)
    {
        return $this->findByKey('id', $id);
    }


}
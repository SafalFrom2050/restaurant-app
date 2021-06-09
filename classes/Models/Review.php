<?php

namespace Models;


use Database\DatabaseModel;
use Database\DatabaseTable;

class Review extends DatabaseModel {

    protected $fillable = [
        'id',
        'menu_id',
        'rating',
        'reviewer',
        'review',
        'moderated',
    ];

    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'reviews');
    }

    public static function create($pdo)
    {
        $review = new Review($pdo);
        $review->make($review, []);

        return $review;
    }

    public static function with($pdo, $record)
    {
        $review = new Review($pdo);
        $review->make($review, $record);

        return $review;
    }

    public function findAllWithMenuId($menuId)
    {
        /** Always sort the reviews by highest rating first */
        return $this->findByOrderDESC('menu_id', $menuId, 'rating');
    }
}
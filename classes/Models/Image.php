<?php

namespace Models;


use Database\DatabaseModel;
use Database\DatabaseTable;

class Image extends DatabaseModel {

    protected $fillable = [
        'id',
        'file_name',
        'created_on',
    ];

    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'images');
    }

    public static function create($pdo)
    {
        $image = new Image($pdo);
        $image->make($image, []);

        return $image;
    }

    public static function with($pdo, $record)
    {
        $image = new Image($pdo);
        $image->make($image, $record);

        return $image;
    }

}
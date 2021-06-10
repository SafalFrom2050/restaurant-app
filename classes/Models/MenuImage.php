<?php

namespace Models;


use Database\DatabaseModel;
use Database\DatabaseTable;

class MenuImage extends DatabaseModel {


    protected $fillable = [
        'id',
        'menu_id',
        'image_id',
    ];


    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'menu_images');
    }

    public static function create($pdo)
    {
        $menuImage = new MenuImage($pdo);
        $menuImage->make($menuImage, []);

        return $menuImage;
    }

    public static function with($pdo, $record)
    {
        $menuImage = new MenuImage($pdo);
        $menuImage->make($menuImage, $record);

        return $menuImage;
    }
    
    
}
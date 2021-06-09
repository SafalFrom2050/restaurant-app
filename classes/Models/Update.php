<?php

namespace Models;


use Database\DatabaseModel;
use Database\DatabaseTable;

class Update extends DatabaseModel {

    protected $fillable = [
        'id',
        'date',
        'title',
        'description',
        'image_id',
    ];

    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'updates');
    }

    public static function create($pdo)
    {
        $update = new Update($pdo);
        $update->make($update, []);

        return $update;
    }

    public static function with($pdo, $record)
    {
        $update = new Update($pdo);
        $update->make($update, $record);

        return $update;
    }
}

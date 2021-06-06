<?php

namespace Database;


class DatabaseModel {

    public $pdo;
    public $table;

    protected $fillable;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function make($model, $record)
    {
        if (!is_array($record)) {
            return $model;
        }

        foreach($record as $key => $value) {
            if (in_array($key, $this->fillable, true)) {
                // convert keys to camelCase first
                $key = snakeToCamelCase($key);
                $model->$key = $value;
            }
        }

        return $model;
    }

    public function intoArray()
    {
        $array = [];
        foreach(get_object_vars($this) as $key => $value) {
            // convert keys to snake_case first
            $key = camelToSnakeCase($key);
            if (in_array($key, $this->fillable, true)) {
                $array[$key] = $value;
            }
        }
        return $array;
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
        $models = [];
        foreach ($stmt as $record) {
            $model = $this->make(new DatabaseModel($this->pdo), $record);
            $model->table = $this->table;
            $models[] = $model;
        }

        return $models;
    }

    public function findAllHaving($key, $value)
    {
        $stmt = $this->table->find($key, $value);

        $models = [];
        foreach ($stmt as $record) {
            $model = $this->make(new DatabaseModel($this->pdo), $record);
            $model->table = $this->table;
            $models[] = $model;
        }

        return $models;
    }

    public function find($id)
    {
        $stmt = $this->table->find('id', $id);
        return $this->make($this, $stmt->fetch());
    }

    public function findByKey($key, $value)
    {
        $stmt = $this->table->find($key, $value);
        return $this->make($this, $stmt->fetch());
    }

}
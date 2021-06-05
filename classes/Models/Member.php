<?php

namespace Models;


class Member{

    public $id;
    public $username;
    public $password;
    public $fullName;
    public $isAdmin;

    public $pdo;
    public $table;

    public function intoArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,

            /* Only used for registration or modification */
            'password' => password_hash($this->password, PASSWORD_DEFAULT),

            'full_name' => $this->fullName,
            'is_admin' => $this->isAdmin,
        ];
    }

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->table = new DatabaseTable($pdo, 'members');
    }

    public static function create($pdo)
    {
        return new Member($pdo);
    }

    public static function with($pdo, $record)
    {
        $member = new Member($pdo);

        if (!is_array($record)) {
            return $member;
        }

        foreach($record as $key => $value) {
            // convert keys to camelCase first
            $key = snakeToCamelCase($key);
            $member->$key = $value;
        }

        return $member;
    }


    /** Database operations:  */

    public function save()
    {
        return $this->table->insert($this->intoArray());
    }

    public function delete($id)
    {
        // Returns number of deleted rows;
        return $this->table->delete('id', $id);
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

    public function findById($id)
    {
        $stmt = $this->table->find('id', $id);
        return self::with($this->pdo, $stmt->fetch());
    }

    public function findByUsername($username)
    {
        $stmt = $this->table->find('username', $username);
        return self::with($this->pdo, $stmt->fetch());
    }

    public function findAll()
    {
        $stmt = $this->table->findAll();

        $records = [];
        foreach ($stmt as $record) {
            $record = self::with(getPDO(), $record);
            $records[] = $record;
        }
        return $records;
    }

}
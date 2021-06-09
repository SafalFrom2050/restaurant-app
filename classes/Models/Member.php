<?php

namespace Models;


use Database\DatabaseModel;
use Database\DatabaseTable;

class Member extends DatabaseModel {

    protected $fillable = [
        'id',
        'username',
        'password',
        'full_name',
        'is_admin',
        ];


    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'members');
    }

    public static function create($pdo)
    {
        $member = new Member($pdo);
        $member->make($member, []);

        return $member;
    }

    public static function with($pdo, $record)
    {
        $member = new Member($pdo);
        $member->make($member, $record);

        return $member;
    }

    // @Override
    public function intoArray()
    {
        if(isset($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
        return parent::intoArray();
    }

    /** Database operations:  */

    public function findById($id)
    {
        return $this->findByKey('id', $id);
    }

    public function findByUsername($username)
    {
       return $this->findByKey('username', $username);
    }
}
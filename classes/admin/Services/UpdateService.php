<?php

namespace admin\Services;


use Models\Update;

class UpdateService {
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new UpdateService($pdo);
    }

    public function performAction($request)
    {
        if (!isset($request['_method'])) {
            return;
        }

        $method = strtolower($request['_method']);

        // Check for valid csrf token
        try_session_start();
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create */

        if ($method === 'post') {
            $update = Update::with(getPDO(), $request);
            $update->save();
            echo 'Update has been added successfully!';
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $update = Update::create($this->pdo);
            $update->delete($request['id']);
        }else if ($method === 'put') {
            $update = Update::with(getPDO(), $request);
            $update->update();
        }
    }
}
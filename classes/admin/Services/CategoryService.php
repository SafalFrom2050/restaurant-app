<?php

namespace admin\Services;


use Models\Category;

class CategoryService {

    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new CategoryService($pdo);
    }

    public function performAction($request)
    {

        // Workaround for unsupported HTTP methods
        if (!isset($request['_method'])) {
            return;
        }
        $method = strtolower($request['_method']);

        // Check for valid csrf token
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create category */

        if ($method === 'post') {
            $category = Category::with(getPDO(), $request);
            $category->save();
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $category = Category::create($this->pdo);
            $category->delete($request['id']);
        }else if ($method === 'put') {
            $category = Category::with(getPDO(), $request);
            $category->update();
        }else if ($method === 'patch') {
            // TODO: patch logic
        }
    }
}
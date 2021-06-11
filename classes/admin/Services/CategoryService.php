<?php

namespace admin\Services;


use Models\Category;
use Validators\Validator;

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
            $this->createCategory($request);
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $this->deleteCategory($request);
        }else if ($method === 'put') {
            $this->updateCategory($request);
        }
    }

    public function createCategory($request)
    {

        if (! Validator::isNotNull($request['name'])) {
            echo 'Name is required!';
            return -1;
        }
        if (! Validator::isNotNull($request['slug'])) {
            echo 'Slug is required!';
            return -1;
        }

        $request['slug'] = str_replace(' ', '-', $request['slug']);
        $request['slug'] = strtolower($request['slug']);

        $category = Category::with(getPDO(), $request);
        $id = $category->save();

        echo 'Category has been created!';
        return $id;
    }

    public function updateCategory($request)
    {
        $category = Category::with(getPDO(), $request);
        $category->update();

        echo 'Category has been updated!';
    }

    public function deleteCategory($request)
    {
        $category = Category::create($this->pdo);
        $category->delete($request['id']);

        echo 'Category has been deleted!';
    }
}
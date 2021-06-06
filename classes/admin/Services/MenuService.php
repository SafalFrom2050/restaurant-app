<?php

namespace admin\Services;


use Models\Menu;

class MenuService {

    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new MenuService($pdo);
    }

    public function performAction($request)
    {
        if (!isset($request['_method'])) {
            return;
        }

        $method = strtolower($request['_method']);

        // Check for valid csrf token
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create menu */

        if ($method === 'post') {
            $menu = Menu::with(getPDO(), $request);
            $menu->save();
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $menu = Menu::create($this->pdo);
            $menu->delete($request['id']);
        }else if ($method === 'put') {
            $menu = Menu::with(getPDO(), $request);
            $menu->update();
        }
    }
}
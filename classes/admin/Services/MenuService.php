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
            $menu = Menu::create(getPDO())->findById($request['id']);
            $menu->update($request);
        }
    }
}
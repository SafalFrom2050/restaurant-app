<?php

namespace admin\Controllers;


use Models\Menu;

class MenuController {
    public $request;
    public $view;

    private $props = [
        'sideBarOptions' => [
            '0' => [
                'title' => 'Menu',
                'link' => 'admin?navigate=menu',
            ],
            '1' => [
                'title' => 'Categories',
                'link' => 'admin?navigate=categories',
            ],
        ],
    ];

    public function __construct($request)
    {
        $this->request = $request;
        $this->handleRequest();
    }

    public function index()
    {
        return loadTemplate($this->view, $this->props);
    }

    private function handleRequest()
    {
        if (isset($_REQUEST['record'])) {
            $menu = Menu::with(getPDO(), $_REQUEST);

            $menu->save();  // TODO: Error handling (method returns boolean as operation status)
        }

        $menuList = Menu::create(getPDO())->findAllFoods();

        $this->props['menuList'] = $menuList;
        $this->view = TEMPLATES_PATH_ADMIN.'menu-template.php';
    }
}
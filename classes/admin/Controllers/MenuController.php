<?php

namespace admin\Controllers;


use admin\Services\MenuService;
use Models\Menu;

class MenuController {
    public $request;
    public $view;

    private $props;

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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            MenuService::create(getPDO())->performAction($this->request);
        }

        $menuList = Menu::create(getPDO())->findAll();

        $this->props['menuList'] = $menuList;
        $this->view = TEMPLATES_PATH_ADMIN.'menu-template.php';
    }
}
<?php

namespace Controllers;


use Models\Category;

class AppController {
    public $request;
    public $view;

    public function __construct($request)
    {
        $this->request =$request;
        $this->handleRequest();
    }

    public function index()
    {
        return $this->view;
    }

    private function handleRequest()
    {

        if (isset($this->request['page'])) {
            // Removes extra '/' from requested page if any
            $requestPage = trim($this->request['page'], '/');
            $view = ROUTES_PATH.$requestPage.'.php';
        }else {
            $view = ROUTES_PATH.'home.php';
        }

        if (file_exists($view)) {
            require $view;
        }else {
            // Check for the page in category routes
            require ROUTES_PATH.'category.php';
        }

        $props['categoryList'] = Category::create(getPDO())->findAll();

        $this->view = loadTemplate(LAYOUTS_PATH.'layout.php', isset($props) ? $props : []);
    }
}
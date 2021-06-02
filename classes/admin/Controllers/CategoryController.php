<?php

namespace admin\Controllers;


use Models\Category;

class CategoryController {

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
        $categories = Category::create(getPDO())->findAll();

        $this->props['categories'] = $categories;
        $this->view = TEMPLATES_PATH_ADMIN.'categories-template.php';
    }
}
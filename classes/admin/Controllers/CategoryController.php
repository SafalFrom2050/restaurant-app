<?php

namespace admin\Controllers;


use admin\Services\CategoryService;
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            CategoryService::create(getPDO())->performAction($this->request);
        }

        $this->props['categories'] = Category::create(getPDO())->findAll();
        $this->view = TEMPLATES_PATH_ADMIN.'categories-template.php';
    }
}
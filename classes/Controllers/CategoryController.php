<?php

namespace Controllers;


use Models\Category;
use Models\Menu;

class CategoryController {

    public $request;
    public $category;
    public $view;

    public function __construct($request)
    {
        $this->request = $request;
        $this->handleRequest();
    }

    public function index()
    {
        return $this->view;
    }

    public function getPageTitle()
    {
        return "Kate's Kitchen - ".$this->category->name;
    }


    private function handleRequest()
    {
        $page = $this->request['page'];

        $menu = new Menu(getPDO());
        $menuList = $menu->findFoodsWithCategorySlug($page);

        $this->category = Category::create(getPDO())->find($page);

        $props = [
            'menuList' => $menuList,
            'category' => $this->category,
            'categoryList' => $this->category->findAll(),
        ];

        if ($this->category->id !== null){
            $this->view = loadTemplate(TEMPLATES_PATH.'category-template.php', $props);
        }else {
            $this->view = loadTemplate(TEMPLATES_PATH.'404-error-template.php', $props);
        }
    }

}
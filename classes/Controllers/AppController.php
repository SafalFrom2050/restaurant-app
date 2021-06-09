<?php

namespace Controllers;


use Models\Category;

class AppController {
    public $requestUri;
    public $view;

    public function __construct($requestUri)
    {
        $this->requestUri = $requestUri;
        $this->handleRequest();
    }

    public function index()
    {
        return $this->view;
    }

    private function handleRequest()
    {

        // Removes extra '/' from requested page if any
        $requestUri = getSanitizedRequestUri();

        /** Don't allow users visit nested paths directly.
         *
         * For: v.je/admin/categories @param $requestPage = 'admin'
         * instead of 'admin/categories'.
         */
        $requestPage = $requestUri[0];

        if($requestPage !== ""){
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

        $pageProps['categoryList'] = Category::create(getPDO())->findAll();

        $this->view = loadTemplate(LAYOUTS_PATH.'layout.php', isset($pageProps) ? $pageProps : []);
    }
}
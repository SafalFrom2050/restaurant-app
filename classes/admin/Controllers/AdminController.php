<?php

namespace admin\Controllers;


class AdminController {

    public $request;
    public $view;
    public $layoutStyle;

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
        return $this->view;
    }

    private function handleRequest()
    {
        session_start();

        if (isset($this->request['submit'])) {
            if ($_POST['password'] == 'letmein') {
                $_SESSION['loggedin'] = true;
            }
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $this->layoutStyle = 'sidebar';
            $this->view = $this->getPage();
        }else {
            $this->layoutStyle = 'home';
            $this->view = loadTemplate(TEMPLATES_PATH_ADMIN.'login-template.php', []);
        }
    }

    private function getPage()
    {
        return loadTemplate(TEMPLATES_PATH_ADMIN.'index-template.php', $this->props);
    }
}
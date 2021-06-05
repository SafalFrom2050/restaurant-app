<?php

namespace admin\Controllers;


use http\Client\Curl\User;
use Models\Member;

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
        'adminOptions' => [
            '0' => [
                'title' => 'Members',
                'link' => 'admin?navigate=members'
            ]
        ],
        'isAdmin' => false,
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

        if (isset($this->request['submit'], $this->request['login'])) {
            $user = Member::create(getPDO())->findByUsername($this->request['username']);

            if (isset($user->id)) {
                if (password_verify($this->request['password'], $user->password)) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $user->id;

                    // Used for csrf protection
                    $_SESSION['token'] = bin2hex(randomString(25));
                }else {
                    echo 'Password is invalid';
                }
            }else {
                echo 'Username is invalid!';
            }
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            $this->props['isAdmin'] = Member::create(getPDO())->findById($_SESSION['user_id'])->isAdmin;
            $this->layoutStyle = 'sidebar';

            $sideMenu = loadTemplate(COMPONENTS_PATH_ADMIN . 'sidebar-li.php', $this->props);

            if (isset($_GET['navigate'])) {
                $props = $this->props;
                require_once ROUTES_PATH_ADMIN.$_GET['navigate'].'.php';
                $this->view = $content;
            }else {
                $this->view = loadTemplate(TEMPLATES_PATH_ADMIN.'index-template.php', $this->props);
            }
            $this->view = $sideMenu . $this->view;
        }else {
            $this->layoutStyle = 'home';
            $this->view = loadTemplate(TEMPLATES_PATH_ADMIN.'login-template.php', []);
        }
    }
}
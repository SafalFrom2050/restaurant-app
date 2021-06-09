<?php

namespace admin\Controllers;


use admin\Services\AuthService;
use Models\Member;

class AdminController {

    public $request;
    public $view;
    public $layoutStyle;

    private $props = [
        'sideBarOptions' => [
            '0' => [
                'title' => 'Menu',
                'link' => '/admin/menu',
            ],
            '1' => [
                'title' => 'Categories',
                'link' => '/admin/categories',
            ],
            '2' => [
                'title' => 'Reviews',
                'link' => '/admin/reviews',
            ],
            '3' => [
                'title' => 'Bookings',
                'link' => '/admin/bookings',
            ],
            '4' => [
                'title' => 'Updates',
                'link' => '/admin/updates',
            ],
        ],
        'adminOptions' => [
            '0' => [
                'title' => 'Members',
                'link' => '/admin/members'
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

        $authService = AuthService::create(getPDO());
        $authService->performAction($this->request);


        if (!$authService->isLoggedIn()) {
            $this->layoutStyle = 'home';
            $this->view = loadTemplate(TEMPLATES_PATH_ADMIN.'login-template.php', []);
            return;
        }
        $this->layoutStyle = 'sidebar';

        $this->props['isAdmin'] = $authService->getCurrentMember()->isAdmin;


        // Get the request url after "admin/" (2nd level)
        if(isset(getSanitizedRequestUri()[1])) {
            $requestPage = getSanitizedRequestUri()[1];
        }else {
            $requestPage = '';
        }



        if ($requestPage !== '') {
            $props = $this->props;
            require_once ROUTES_PATH_ADMIN . $requestPage . '.php';
            $this->view = $content;
        }else {
            $this->view = loadTemplate(TEMPLATES_PATH_ADMIN.'index-template.php', $this->props);
        }


        $sideMenu = loadTemplate(COMPONENTS_PATH_ADMIN . 'sidebar-li.php', $this->props);
        $this->view = $sideMenu . $this->view;

    }
}
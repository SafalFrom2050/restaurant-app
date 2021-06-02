<?php

use admin\Controllers\AdminController;

$props = [
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

if (isset($_GET['navigate'])) {
    require_once ROUTES_PATH_ADMIN.$_GET['navigate'].'.php';
}else{
    $controller = new AdminController($_REQUEST);

    $content = $controller->index();

// Set props for layout
    $props = [
        'title' => "Kate's Kitchen - Admin",
        'content' => $content,
        'layoutStyle' => $controller->layoutStyle,
    ];
}
<?php

use admin\Controllers\AdminController;

if (isset($_GET['navigate'])) {
    require ROUTES_PATH_ADMIN.$_GET['navigate'].'.php';
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
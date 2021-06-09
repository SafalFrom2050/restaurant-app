<?php

use admin\Controllers\AdminController;


$controller = new AdminController($_REQUEST);

$content = $controller->index();

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Admin",
    'content' => $content,
    'layoutStyle' => $controller->layoutStyle,
];
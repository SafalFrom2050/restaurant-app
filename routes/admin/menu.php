<?php

use admin\Controllers\MenuController;


$controller = new MenuController($_REQUEST);

$content = $controller->index();


// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Menu",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];

<?php

use admin\Controllers\CategoryController;


$controller = new CategoryController($_REQUEST);
$content = $controller->index();

// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Menu",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
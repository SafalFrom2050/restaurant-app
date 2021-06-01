<?php

use Controllers\CategoryController;

$controller = new CategoryController($_GET);

$content = $controller->index();

// Set props for layout
$props = [
    'title' => $controller->getPageTitle(),
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
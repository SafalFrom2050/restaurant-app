<?php

use Controllers\CategoryController;

$controller = new CategoryController($_GET);

$content = $controller->index();

// Set props for layout
$pageProps = [
    'title' => $controller->getPageTitle(),
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
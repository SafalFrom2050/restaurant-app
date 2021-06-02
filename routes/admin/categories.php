<?php

use admin\Controllers\CategoryController;


$controller = new CategoryController($_REQUEST);

$sideMenu = loadTemplate(COMPONENTS_PATH_ADMIN . 'sidebar-li.php', $props);
$content = $sideMenu . $controller->index();

// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Menu",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
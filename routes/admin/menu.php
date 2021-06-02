<?php

use admin\Controllers\MenuController;


$controller = new MenuController($_REQUEST);

$sideMenu = loadTemplate(COMPONENTS_PATH_ADMIN . 'sidebar-li.php', $props);
$content = $sideMenu . $controller->index();


// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Menu",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];


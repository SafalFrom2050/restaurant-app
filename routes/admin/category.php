<?php

use Models\Category;

$sideMenu = loadTemplate(COMPONENTS_PATH_ADMIN . 'sidebar-li.php', $props);

$props = [];
if (isset($_GET['id'])) {
    $category = Category::create(getPDO());
    $props = $category->findById($_GET['id'])->intoArray();
}

$content = loadTemplate(TEMPLATES_PATH_ADMIN . 'category-template.php', $props);

$content = $sideMenu . $content;

// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Category",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
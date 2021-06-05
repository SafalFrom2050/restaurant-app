<?php

use Models\Category;
use Models\Menu;

$props = [];
if (isset($_GET['id'])) {
    $menu = Menu::create(getPDO());
    $props = $menu->findById($_GET['id'])->intoArray();
}

$props['categories'] = Category::create(getPDO())->findAll();

$content = loadTemplate(TEMPLATES_PATH_ADMIN . 'dish-template.php', $props);

// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Menu",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
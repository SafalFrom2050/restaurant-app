<?php

use Models\Category;


$props = [];
if (isset($_GET['id'])) {
    $category = Category::create(getPDO());
    $props = $category->findById($_GET['id'])->intoArray();
}

$content = loadTemplate(TEMPLATES_PATH_ADMIN . 'category-template.php', $props);

// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Category",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
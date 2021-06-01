<?php

use Models\Category;

$props = [
    'categoryList' => Category::create(getPDO())->findAll(),
];

$content = loadTemplate(TEMPLATES_PATH.'about-template.php', $props);


// Set props for parent layout
$props = [
    'title' => "Kate's Kitchen - About",
    'content' => $content,
    'layoutStyle' => 'home',
];
<?php

use Models\Category;

$props = [
    'categoryList' => Category::create(getPDO())->findAll(),
];

$content = loadTemplate(TEMPLATES_PATH.'home-template.php', $props);


// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Home",
    'content' => $content,
    'layoutStyle' => 'home',
];
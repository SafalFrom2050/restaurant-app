<?php

use Models\Category;
use Models\Update;


$updates = Update::create(getPDO())->findAll();

$props = [
    'categoryList' => Category::create(getPDO())->findAll(),
    'updates' => $updates,
];

$content = loadTemplate(TEMPLATES_PATH.'home-template.php', $props);

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Home",
    'content' => $content,
    'layoutStyle' => 'home',
];
<?php

$content = loadTemplate(ROOT_PATH.'views/templates/404-error-template.php', []);

$props = [
    'title' => "Page Not Found!",
    'content' => $content,
    'layoutStyle' => 'home',
];
<?php

$content = loadTemplate(ROOT_PATH.'views/templates/faqs-template.php', []);

$props = [
    'title' => "Kate's Kitchen - FAQS",
    'content' => $content,
    'layoutStyle' => 'home',
];
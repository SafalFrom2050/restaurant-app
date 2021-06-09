<?php

use admin\Controllers\ReviewController;

$controller = new ReviewController($_REQUEST);

$content = $controller->index();

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Manage Reviews",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];

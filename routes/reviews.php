<?php

use Controllers\ReviewController;

$controller = new ReviewController($_GET);

$content = $controller->index();

$pageProps = [
    'title' => "Kate's Kitchen - Reviews",
    'content' => $content,
    'layoutStyle' => 'home',
];
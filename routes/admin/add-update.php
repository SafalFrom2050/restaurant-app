<?php

use admin\Controllers\UpdateController;

$controller = new UpdateController($_REQUEST);

$content = $controller->index();

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Add Updates",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
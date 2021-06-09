<?php

use admin\Controllers\UpdateController;

$controller = new UpdateController($_REQUEST);

$content = $controller->manageUpdates();

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Manage Updates",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
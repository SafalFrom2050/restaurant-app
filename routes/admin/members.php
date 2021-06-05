<?php

use admin\Controllers\MemberController;

/** Only admin can access this route */

if (!isset($props) || !$props['isAdmin']) {
    $content = loadTemplate(TEMPLATES_PATH_ADMIN . '404-error-template.php', []);
}else {

    $controller = new MemberController($_REQUEST);
    $content = $controller->index();

// Set props for layout
    $props = [
        'title' => "Kate's Kitchen - Manage Members",
        'content' => $content,
        'layoutStyle' => 'sidebar',
    ];
}
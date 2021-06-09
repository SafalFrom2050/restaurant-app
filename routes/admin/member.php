<?php

use Models\Member;

if (!isset($props) || !$props['isAdmin']) {
    $content = loadTemplate(TEMPLATES_PATH_ADMIN . '404-error-template.php', []);
}else {

    $props = [];
    if (isset($_GET['id'])) {
        $member = Member::create(getPDO());
        $props = $member->findById($_GET['id'])->intoArray();
    }

    $content = loadTemplate(TEMPLATES_PATH_ADMIN . 'member-template.php', $props);

    // Set props for layout
    $pageProps = [
        'title' => "Kate's Kitchen - Manage Users",
        'content' => $content,
        'layoutStyle' => 'sidebar',
    ];
}

<?php

use Models\Member;


$props = [];
if (isset($_GET['id'])) {
    $member = Member::create(getPDO());
    $props = $member->findById($_GET['id'])->intoArray();
}

$content = loadTemplate(TEMPLATES_PATH_ADMIN . 'member-template.php', $props);

// Set props for layout
$props = [
    'title' => "Kate's Kitchen - Manage Users",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
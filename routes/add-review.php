<?php

use Controllers\ReviewController;


// Must start session for csrf protection
session_start();

$controller = new ReviewController($_REQUEST);
$content = $controller->getAddReviewIndex();

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Add a Review",
    'content' => $content,
    'layoutStyle' => 'home',
];
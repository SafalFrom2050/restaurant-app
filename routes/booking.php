<?php

use Controllers\BookingController;

$controller = new BookingController($_REQUEST);

$content = $controller->index();

// Set props for layout
$pageProps = [
    'title' => 'Kate\'s Kitchen - Booking ',
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
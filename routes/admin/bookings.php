<?php

use Controllers\BookingController;

$controller = new BookingController($_REQUEST);

$content = $controller->viewBookings(false);

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Manage Bookings",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
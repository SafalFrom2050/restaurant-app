<?php

use Controllers\BookingController;

$controller = new BookingController($_REQUEST);

$content = $controller->viewBookings(true);

// Set props for layout
$pageProps = [
    'title' => "Kate's Kitchen - Manage Bookings",
    'content' => $content,
    'layoutStyle' => 'sidebar',
];
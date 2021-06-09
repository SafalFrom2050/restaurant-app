<?php

namespace Controllers;


use Models\Booking;
use Services\BookingService;

class BookingController {

    public $request;
    public $bookings;
    public $view;


    public function __construct($request)
    {
        $this->request = $request;
        $this->handleRequest();
    }

    public function index()
    {
        return loadTemplate($this->view, []);
    }

    public function viewBookings($processed)
    {
        $props = [
            'bookings' => Booking::create(getPDO())->findAllHaving('processed', $processed),
            'processed' => $processed,
        ];

        $this->view = TEMPLATES_PATH_ADMIN . 'bookings-template.php';

        return loadTemplate($this->view, $props);
    }

    private function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            BookingService::create(getPDO())->performAction($this->request);
        }

        $this->view = TEMPLATES_PATH . 'add-booking-template.php';

    }
}


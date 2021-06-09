<?php

namespace Services;


use Models\Booking;

class BookingService {
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new BookingService($pdo);
    }

    public function performAction($request)
    {
        if (!isset($request['_method'])) {
            return;
        }

        $method = strtolower($request['_method']);

        // Check for valid csrf token
        try_session_start();
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create */

        if ($method === 'post') {
            $booking = Booking::with(getPDO(), $request);
            $booking->save();
            echo 'Your booking request has been placed successfully!';
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $booking = Booking::create($this->pdo);
            $booking->delete($request['id']);
        }else if ($method === 'put') {
            $booking = Booking::with(getPDO(), $request);
            $booking->update();
        }
    }
}
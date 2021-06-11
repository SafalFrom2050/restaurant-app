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
            $this->createBooking($request);
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $this->deleteBooking($request);
        }else if ($method === 'put') {
            $this->updateBooking($request);
        }
    }

    public function createBooking($request)
    {
        $booking = Booking::with(getPDO(), $request);
        $id = $booking->save();
        echo 'Your booking request has been placed successfully!';

        return $id;
    }

    public function updateBooking($request)
    {
        $booking = Booking::with(getPDO(), $request);
        $booking->update();
        echo 'Booking request has been updated!';
    }

    public function deleteBooking($request)
    {
        $booking = Booking::create($this->pdo);
        $booking->delete($request['id']);
        echo 'Booking request has been deleted!';
    }


}
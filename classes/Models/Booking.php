<?php

namespace Models;


use Database\DatabaseModel;
use Database\DatabaseTable;

class Booking extends DatabaseModel {
    
    protected $fillable = [
        'id',
        'email',
        'phone',
        'total_guests',
        'date_time',
        'processed',
    ];

    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->table = new DatabaseTable($pdo, 'bookings');
    }

    public static function create($pdo)
    {
        $booking = new Booking($pdo);
        $booking->make($booking, []);

        return $booking;
    }

    public static function with($pdo, $record)
    {
        $booking = new Booking($pdo);
        $booking->make($booking, $record);

        return $booking;
    }
}

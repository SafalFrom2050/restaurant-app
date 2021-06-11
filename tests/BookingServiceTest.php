<?php

require_once 'classes/Database/DatabaseModel.php';
require_once 'classes/Database/DatabaseTable.php';
require_once 'classes/Models/Booking.php';
require_once 'classes/Services/BookingService.php';
require_once 'functions/helper.php';

use Models\Booking;
use PHPUnit\Framework\TestCase;
use Services\BookingService;

class BookingServiceTest extends TestCase
{
    private $testRequest = [
        'email' => 'test@test.com',
        'phone' => '+977 98989898',
        'total_guests' => 20,
        'date_time' => '2021-08-01 01:09:01',
        'processed' => 1,
    ];

    private $id;

    public function testCreateBooking()
    {
        $bookingService = new BookingService(getPDO());
        $this->id = $bookingService->createBooking($this->testRequest);

        self::assertNotNull( Booking::create(getPDO())->find($this->id)->id, "Booking not created!");

        Booking::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $bookingService->deleteBooking($this->testRequest);
    }

    public function testUpdateBooking()
    {
        $bookingService = new BookingService(getPDO());
        $this->id = $bookingService->createBooking($this->testRequest);

        $this->testRequest['processed'] = 0;
        $this->testRequest['id'] = $this->id;

        $bookingService->updateBooking($this->testRequest);
        self::assertEquals(0, Booking::create(getPDO())->find($this->id)->processed, "Booking not created!");

        Booking::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $bookingService->deleteBooking($this->testRequest);
    }

    public function testDeleteBooking()
    {

        $bookingService = new BookingService(getPDO());
        $this->id = $bookingService->createBooking($this->testRequest);

        Booking::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $bookingService->deleteBooking($this->testRequest);

        self::assertFalse( isset(Booking::create(getPDO())->find($this->id)->id), "Booking not created!");
    }
}

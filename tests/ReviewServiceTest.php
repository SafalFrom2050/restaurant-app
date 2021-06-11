<?php

require_once 'classes/Database/DatabaseModel.php';
require_once 'classes/Database/DatabaseTable.php';
require_once 'classes/Models/Review.php';
require_once 'classes/Services/ReviewService.php';


require_once 'functions/helper.php';

use Models\Review;
use PHPUnit\Framework\TestCase;
use Services\ReviewService;

class ReviewServiceTest extends TestCase
{
    private $testRequest = [
        'rating' => 5,
        'reviewer' => 'Test Reviewer',
        'review' => 'Test Review',
        'moderated' => 1,
        'menu_id' => 1,
    ];

    private $id;

    public function testCreateReview()
    {
        $reviewService = new ReviewService(getPDO());
        $this->id = $reviewService->createReview($this->testRequest);

        self::assertNotNull( Review::create(getPDO())->find($this->id)->id, "Review not created!");

        Review::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $reviewService->deleteReview($this->testRequest);
    }

    public function testUpdateReview()
    {
        $reviewService = new ReviewService(getPDO());
        $this->id = $reviewService->createReview($this->testRequest);

        $this->testRequest['review'] = 'New';
        $this->testRequest['id'] = $this->id;

        $reviewService->updateReview($this->testRequest);
        self::assertEquals('New', Review::create(getPDO())->find($this->id)->review, "Review not created!");

        Review::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $reviewService->deleteReview($this->testRequest);
    }

    public function testDeleteReview()
    {

        $reviewService = new ReviewService(getPDO());
        $this->id = $reviewService->createReview($this->testRequest);

        Review::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $reviewService->deleteReview($this->testRequest);

        self::assertFalse( isset(Review::create(getPDO())->find($this->id)->id), "Review not created!");
    }
}

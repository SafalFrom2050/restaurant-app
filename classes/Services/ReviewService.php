<?php

namespace Services;


use Models\Review;

class ReviewService {
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new ReviewService($pdo);
    }

    public function performAction($request)
    {
        if (!isset($request['_method'])) {
            return;
        }

        $method = strtolower($request['_method']);

        // Check for valid csrf token
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create */

        if ($method === 'post') {
            $this->createReview($request);
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $this->deleteReview($request);
        }else if ($method === 'put') {
            $this->updateReview($request);
        }
    }

    public function createReview($request)
    {
        $review = Review::with(getPDO(), $request);
        return $review->save();
    }

    public function deleteReview($request)
    {
        $review = Review::create($this->pdo);
        $review->delete($request['id']);
    }

    public function updateReview($request)
    {
        $review = Review::with(getPDO(), $request);
        $review->update();
    }
}
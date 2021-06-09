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
            $review = Review::with(getPDO(), $request);
            $review->save();
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $review = Review::create($this->pdo);
            $review->delete($request['id']);
        }else if ($method === 'put') {
            $review = Review::with(getPDO(), $request);
            $review->update();
        }
    }
}
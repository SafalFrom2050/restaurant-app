<?php

namespace admin\Controllers;

use Services\ReviewService;
use Models\Review;

class ReviewController {
    public $request;
    public $view;

    private $props;

    public function __construct($request)
    {
        $this->request = $request;
        $this->handleRequest();
    }

    public function index()
    {
        return loadTemplate($this->view, $this->props);
    }

    private function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ReviewService::create(getPDO())->performAction($this->request);
        }

        $reviewList = Review::create(getPDO())->findAllHaving('moderated', 0);
        $this->props['reviewList'] = $reviewList;
        $this->view = TEMPLATES_PATH_ADMIN.'reviews-template.php';
    }
}
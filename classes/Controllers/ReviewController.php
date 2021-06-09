<?php

namespace Controllers;


use Models\Menu;
use Models\Review;
use Services\ReviewService;

class ReviewController {
    public $request;
    public $reviews;
    public $view;

    public function __construct($request)
    {
        $this->request = $request;
        $this->handleRequest();
    }

    public function index()
    {
        return $this->view;
    }

    public function getAddReviewIndex() {
        if (isset($this->request['menu_id'])) {
            Review::with(getPDO(), $_POST)->save();
            return '<h3 style="color: green">
                        Thank You!
                        Your review has been submitted and will show up once it is approved!
                    </h3>
                    <a href="/reviews?menu='.$_POST['menu_id'].'">View All Reviews</a>';
        }

        if (isset($this->request['menu'])) {
            $menu = Menu::create(getPDO())->find($_GET['menu']);
            if (isset($menu->id)) {
                $props['menu'] = $menu;
                return loadTemplate(TEMPLATES_PATH . 'add-review-template.php', $props);
            }else {
                return '<h2>Menu item doesn\'t exist!</h2>';
            }
        }else {
            return loadTemplate(TEMPLATES_PATH . '404-error-template.php', []);
        }
    }

    private function handleRequest()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ReviewService::create(getPDO())->performAction($this->request);
        }


        if (!isset($this->request['menu'])) {
            $this->viewError();
            return;
        }

        $menuId = $this->request['menu'];


        $menu = Menu::create(getPDO())->find($menuId);
        if (!isset($menu->name)) {
            $this->viewError();
            return;
        }

        $review = new Review(getPDO());
        $this->reviews = $review->findAllWithMenuId($menuId);

        $props = [
            'reviewList' => $this->reviews,
            'menu' => $menu
        ];

        $this->view = loadTemplate(TEMPLATES_PATH.'reviews-template.php', $props);
    }

    private function viewError()
    {
        $this->view = loadTemplate(TEMPLATES_PATH.'404-error-template.php', []);
    }

}
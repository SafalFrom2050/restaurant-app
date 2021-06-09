<?php

use Models\Review;

$reviewList = Review::create(getPDO())->findAllWithMenuId($menu->id);

if (count($reviewList) > 0) {
    echo '<div class="info" style="width: 50%; margin-top: 2rem;">';
    echo '<h3 style="float: left;">
            <a href="reviews?menu=' . $menu->id . '">Reviews</a>
          </h3><br><br>';

    $count = 0;
    foreach ($reviewList as $review) {
        if ($review->moderated) {
            require COMPONENTS_PATH . 'review-item.php';
        }
        $count++;
        if ($count >= 3) {
            break;
        }
    }
    echo '<a href="reviews?menu='. $menu->id .'">See More</a>';
    echo '</div>';
}





<?php

use Models\Image;
use Models\MenuImage;

$menuImages = MenuImage::create(getPDO())->findAllHaving('menu_id', $menu->id);

echo '<li style="margin-top:3rem; margin-bottom:3rem;">';

    echo '<div class="details" style="margin-top:3rem; margin-bottom:3rem;">';

        if (count($menuImages) > 0) {
        echo '<img src="/images/menu/' . Image::create(getPDO())->find($menuImages[0]->imageId)->fileName . '">';
        }

        echo '<h3>£' . $menu->price . '</h3>';
        echo '<h2>' . $menu->name . '</h2>';

        echo '<p>' . nl2br($menu->description) . '</p>';
        echo '<a href="add-review?menu=' . $menu->id . '">Add a review</a>';
        echo '</div><br><br><br>';

    require_once COMPONENTS_PATH . 'top-reviews.php';

    echo '<div style="margin-top: 4rem">';
        echo '<h3 style="float: unset; text-align: center;">More Photos</h3><br>';

        // Skip 1st image
        $count = 1;
        foreach ($menuImages as $menuImage) {
        if ($count !== 1) {
        echo '<img src="/images/menu/' . Image::create(getPDO())->find($menuImage->imageId)->fileName . '">';
        }
        $count++;
        }

    echo '</div>';

echo '</li>';
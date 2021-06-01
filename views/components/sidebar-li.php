<?php

if (!isset($categoryList)) {
    $categoryList = [];
    echo '<h4 style="color:#ff5f5f">:< Here should be a list of categories.</h4>';
}

foreach ($categoryList as $cat) {
    $liClass = '';
    if (isset($category)) {
        $liClass = ($cat->id == $category->id) ? 'class="current"' : '';
    }

    echo '<li><a '.$liClass.' href="/'.$cat->slug.'">'.$cat->name.'</a></li>';
}
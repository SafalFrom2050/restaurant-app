<?php
$menu = isset($menu) ? $menu : null;
$reviewList = isset($reviewList) ? $reviewList : null;
?>

<h2><?php echo $menu->name ?></h2>


<div class="info" style="width: 80%; margin-top: 2rem;">
    <h3 style="float: left;">Reviews</h3><br><br>

    <ul>
        <?php
        foreach ($reviewList as $review) {
            if ($review->moderated) {
                require COMPONENTS_PATH . 'review-item.php';
            }
        }

        ?>
    </ul>

</div>
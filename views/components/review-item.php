<?php
$review = isset($review) ? $review : null;
?>

    <div style="margin-bottom: 3rem">
        <h4><?php echo $review->reviewer ?></h4>
        <h5 style="font-weight: normal;">Rating: <?php echo $review->rating ?></h5>
        <br>

        <p><?php echo $review->review ?></p>
    </div>
<section class="right">

    <h2>Reviews</h2>

    <table>
        <thead>
        <tr>
            <th style="width: 10%">Name</th>
            <th style="width: 10%; text-align: center">Rating</th>
            <th style="width: 40%">Review</th>
            <th style="width: 30%; text-align: center"">Dish</th>

            <th style="width: 5%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
        </tr>

        <?php
        if (!isset($reviewList)) {
            echo '<h3 style="color: #ff5050">Review list is empty!</h3>';
            $members = [];
        }

        foreach ($reviewList as $review) {
            require COMPONENTS_PATH_ADMIN . 'review-item.php';
        }
        ?>
        </thead>
    </table>

</section>

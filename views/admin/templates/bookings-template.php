<section class="right">

    <h2>Member</h2>
    <?php
        if ($processed) {
            $linkText = 'View Unprocessed';
            $link = '/admin/bookings';
        }else {
            $linkText = 'View Processed';
            $link = '/admin/processed-bookings';
        }
    ?>
    <a class="new" href="<?php echo $link ?>">
        <?php echo $linkText ?>
    </a>

    <table>
        <thead>
        <tr>
            <th style="width: 30%">Email</th>
            <th style="width: 25%">Phone</th>
            <th style="width: 10%">Total Guests</th>
            <th style="width: 10%">Date and Time</th>

            <th style="width: 40%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
        </tr>

        <?php
        if (!isset($bookings)) {
            echo '<h3 style="color: #ff5050">Booking list is empty!</h3>';
            $bookings = [];
        }

        foreach ($bookings as $booking) {
            require COMPONENTS_PATH_ADMIN . 'booking-item.php';
        }
        ?>
        </thead>
    </table>

</section>


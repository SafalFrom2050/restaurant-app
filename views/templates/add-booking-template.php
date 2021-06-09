
<section class="right">
    <h2>Booking</h2>

    <form action="" method="POST">

        <label for="email">Email</label>
        <input type="text" autocomplete="email" name="email" id="email" />

        <label for="phone">Phone Number</label>
        <input type="text" autocomplete="phone" name="phone" id="phone" />

        <label for="total_guests">Total Guests</label>
        <input type="number" name="total_guests" id="total_guests" />

        <label for="date_time">Date and Time</label>
        <input type="datetime-local" name="date_time" id="date_time" />


        <?php
        setSessionToken();
        csrf();
        input_method('POST');
        input_submit('Add Booking');
        ?>

    </form>
</section>
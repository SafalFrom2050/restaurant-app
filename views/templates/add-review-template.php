

<section class="right">
    <h2><?php echo $menu->name ?></h2>

    <form action="" method="POST">

        <label for="reviewer">Your Name</label>
        <input type="text" autocomplete="name" name="reviewer" id="reviewer" />

        <label for="review">Review</label>
        <textarea autocomplete="" name="review" id="review"></textarea>

        <label for="rating">Rating</label>
        <select id="rating" name="rating">
            <option value="5">5</option>
            <option value="4">4</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
        </select>

        <?php
        csrf();
        input_hidden('menu_id', $menu->id);
        input_method('POST');
        input_submit('Add Review');
        ?>

    </form>
</section>
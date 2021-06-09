
<section class="right">
    <h2>Add Update</h2>

    <form action="" method="POST">

        <label for="date">Date</label>
        <input type="datetime-local" autocomplete="date" name="date" id="date" required
               value="<?php echo isset($update) ? $update->date : '' ?>"/>

        <label for="title">Title</label>
        <input type="text" autocomplete="title" name="title" id="title" required
               value="<?php echo isset($update) ? $update->title : '' ?>"/>

        <label for="description">Description</label>
        <textarea name="description" id="description" required><?php echo isset($update) ? $update->description : '' ?></textarea>

        <label for="photo">Add Photos</label>
        <input type="file" name="photo" id="photo"
               value="<?php echo isset($update) ? $update->photo : '' ?>"/>


        <?php
        setSessionToken();
        csrf();
        input_method('POST');
        input_submit('Add Update');
        ?>

    </form>
</section>
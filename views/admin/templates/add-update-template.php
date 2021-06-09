
<section class="right">
    <h2>Add Update</h2>

    <form action="" method="POST" enctype="multipart/form-data">

        <label for="date">Date</label>
        <input type="datetime-local" autocomplete="date" name="date" id="date" required
               value="<?php echo isset($update) ? date('Y-m-d\TH:i', strtotime($update->date))  : '' ?>"/>

        <label for="title">Title</label>
        <input type="text" autocomplete="title" name="title" id="title" required
               value="<?php echo isset($update) ? $update->title : '' ?>"/>

        <label for="description">Description</label>
        <textarea name="description" id="description" required><?php echo isset($update) ? $update->description : '' ?></textarea>

        <label for="photos"><?php echo isset($update, $update->imageId) ? 'Replace Photo' : 'Add Photo' ?></label>

        <input type="file" name="photos[]" id="photos"/>


        <?php
        setSessionToken();
        csrf();

        input_method(isset($update) ? 'PUT' : 'POST');
        input_id(isset($update) ? $update->id : '');
        input_submit(isset($update) ? 'Edit Update' : 'Add Update');
        ?>

    </form>
</section>
<section class="right">
    <h2>Add Category</h2>

    <form action="/admin/categories" method="POST">

        <label>Name</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>"/>

        <label>Slug</label>
        <input type="text" name="slug" value="<?php echo isset($slug) ? $slug : '' ?>"/>

        <?php
        csrf();
        input_method(isset($id) ? 'PUT' : 'POST');
        input_id(isset($id) ? $id : '');
        input_submit(isset($id) ? 'Edit Category' : 'Add Category');
        ?>

    </form>
</section>
<section class="right">
    <h2>Add Category</h2>

    <form action="admin?navigate=categories" method="POST">
        <input type="hidden" name="_method" value="<?php echo isset($id) ? 'PUT' : 'POST' ?>" />
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>" />

        <label>Name</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>"/>

        <label>Slug</label>
        <input type="text" name="slug" value="<?php echo isset($slug) ? $slug : '' ?>"/>

        <input type="submit" name="submit" value="<?php echo isset($id) ? 'Edit Category' : 'Add Category' ?>" />

    </form>
</section>
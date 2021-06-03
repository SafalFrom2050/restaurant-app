<section class="right">
    <h2>Add Dish</h2>

    <form action="admin?navigate=menu" method="POST">
        <input type="hidden" name="_method" value="<?php echo isset($id) ? 'PUT' : 'POST' ?>" />
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>" />

        <label>Name</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>"/>

        <label>Description</label>
        <textarea name="description"><?php echo isset($description) ? $description : '' ?></textarea>

        <label>Price</label>
        <input type="text" name="price" value="<?php echo isset($price) ? $price : '' ?>"/>


        <label>Category</label>

        <select name="category_slug">
            <?php
            foreach ($categories as $category) {
                $selected = (isset($category_slug) && $category_slug === $category->slug) ? 'selected' : '';
                echo '<option ' . $selected . ' value="' . $category->slug . '">' . $category->name . '</option>';
            }
            ?>

        </select>

        <input type="submit" name="submit" value="<?php echo isset($id) ? 'Edit' : 'Add' ?>" />

    </form>
</section>
<section class="right">
    <h2>Add Dish</h2>

    <form action="/admin/menu" method="POST">

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

        <?php
        csrf();
        input_method(isset($id) ? 'PUT' : 'POST');
        input_id(isset($id) ? $id : '');
        input_submit(isset($id) ? 'Edit' : 'Add');
        ?>

    </form>
</section>
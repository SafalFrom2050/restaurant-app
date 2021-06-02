<section class="right">

        <h2>Categories</h2>

        <a class="new" href="addcategory.php">Add new category</a>

        <?php
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '</tr>';

        if (!isset($categories)) {
            echo '<h3 style="color: #ff5050">Category list is empty!</h3>';
            $categories = [];
        }

        foreach ($categories as $category) {
            echo '<tr>';
            echo '<td>' . $category->name . '</td>';
            echo '<td><a style="float: right" href="editcategory.php?id=' . $category->id . '">Edit</a></td>';
            echo '<td><form method="post" action="deletecategory.php">
            <input type="hidden" name="id" value="' . $category->id . '" />
            <input type="submit" name="submit" value="Delete" />
            </form></td>';
            echo '</tr>';
        }

        echo '</thead>';
        echo '</table>';
    ?>
</section>


<section class="right">

        <h2>Categories</h2>

        <a class="new" href="admin?navigate=category">Add new category</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th style="width: 5%">&nbsp;</th>
                <th style="width: 5%">&nbsp;</th>
            </tr>

            <?php
            if (!isset($categories)) {
                echo '<h3 style="color: #ff5050">Category list is empty!</h3>';
                $categories = [];
            }

            foreach ($categories as $category) {
                require COMPONENTS_PATH_ADMIN . 'category-item.php';
            }
            ?>

        </thead>
    </table>

</section>


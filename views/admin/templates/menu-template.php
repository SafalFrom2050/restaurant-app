<section class="right">
        <h2>Menu</h2>

        <a class="new" href="/admin?navigate=dish">Add new dish</a>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th style="width: 15%">Price</th>
                    <th style="width: 5%">&nbsp;</th>
                    <th style="width: 15%">&nbsp;</th>
                    <th style="width: 5%">&nbsp;</th>
                    <th style="width: 5%">&nbsp;</th>
                </tr>

        <?php
        if (!isset($menuList)) {
            echo '<h3 style="color: #ff5050">Category list is empty!</h3>';
            $menuList = [];
        }

        foreach ($menuList as $record) {
            if ($record->visible === false) {
                continue;
            }
            require COMPONENTS_PATH_ADMIN . 'menu-item.php';
        }
        ?>

            </thead>
        </table>

</section>




<section class="right">
        <h2>Menu</h2>

        <a class="new" href="adddish.php">Add new dish</a>

        <?php
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Title</th>';
        echo '<th style="width: 15%">Price</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '<th style="width: 15%">&nbsp;</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '</tr>';

        if (!isset($menuList)) {
            echo '<h3 style="color: #ff5050">Category list is empty!</h3>';
            $menuList = [];
        }

        foreach ($menuList as $record) {
            echo '<tr>';
            echo '<td>' . $record->name . '</td>';
            echo '<td>' . $record->price . '</td>';
            echo '<td><a style="float: right" href="?navigate=menu&id=' . $record->id . '">Edit</a></td>';

            echo '<td><form method="post" action="deletedish.php">
            <input type="hidden" name="id" value="' . $record->id . '" />
            <input type="submit" name="submit" value="Delete" />
            </form></td>';
            echo '</tr>';
        }

        echo '</thead>';
        echo '</table>';


        ?>

</section>




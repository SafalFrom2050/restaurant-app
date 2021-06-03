<section class="right">
        <h2>Menu</h2>

        <a class="new" href="/admin?navigate=dish">Add new dish</a>

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
            if ($record->visible === false) {
                continue;
            }
            echo '<tr>';
            echo '<td>' . $record->name . '</td>';
            echo '<td>' . $record->price . '</td>';
            echo '<td><a style="float: right" href="/admin/?navigate=dish&id=' . $record->id . '">Edit</a></td>';

            $visibilityBtn = ($record->visible == 1) ? "Hide" : "Show";
            $visibilityValue = ($record->visible == 1) ? 0 : 1;

            echo
            '<td><form method="post" action="/admin/?navigate=menu">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="' . $record->id . '" />
                <input type="hidden" name="visible" value="' . $visibilityValue . '" />
                <input type="submit" name="submit" value="' . $visibilityBtn . '" />
            </form></td>
            ';

            echo '<td><form method="post" action="/admin/?navigate=menu">
            <input type="hidden" name="_method" value="delete" />
            <input type="hidden" name="id" value="' . $record->id . '" />
            <input type="submit" name="submit" value="Delete" />
            </form></td>';
            echo '</tr>';
        }

        echo '</thead>';
        echo '</table>';


        ?>

</section>




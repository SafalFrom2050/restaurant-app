<section class="left">
    <ul>
        <?php require COMPONENTS_PATH.'sidebar-li.php'?>
    </ul>
</section>

<section class="right">

    <h1><?php echo isset($category) ? $category->name : 'Category Name' ?></h1>

    <ul class="listing">


        <?php

        // Show empty message if no items
        if (! (isset($menuList) && count($menuList) > 0)){
            $menuList = [];

            echo '<div class="details">';
            echo '<h2> List Empty! </h2>';
            echo '</div>';
        }

        foreach ($menuList as $record) {
            echo '<li>';

            echo '<div class="details">';
            echo '<h3>£' . $record->price . '</h3>';
            echo '<h2>' . $record->name . '</h2>';

            echo '<p>' . nl2br($record->description) . '</p>';


            echo '</div>';
            echo '</li>';
        }

        ?>

    </ul>

</section>
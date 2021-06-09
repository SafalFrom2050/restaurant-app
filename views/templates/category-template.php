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

        foreach ($menuList as $menu) {
            if ($menu->visible == 0) {
                continue;
            }
            echo '<li style="margin-top:3rem; margin-bottom:3rem;">';

            echo '<div class="details" style="margin-top:3rem; margin-bottom:3rem;">';
            echo '<img src="https://picsum.photos/1000/1000">';

            echo '<h3>£' . $menu->price . '</h3>';
            echo '<h2>' . $menu->name . '</h2>';

            echo '<p>' . nl2br($menu->description) . '</p>';
            echo '<a href="add-review?menu=' . $menu->id . '">Add a review</a>';
            echo '</div><br><br><br>';

            require_once COMPONENTS_PATH . 'top-reviews.php';

            echo '<div style="margin-top: 4rem">';
            echo '<h3 style="float: unset; text-align: center;">More Photos</h3><br>';
            echo '<img src="https://picsum.photos/1200/1200"">';
            echo '<img src="https://picsum.photos/1200/1200"">';

            echo '</div>';

            echo '</li>';
        }

        ?>

    </ul>

</section>
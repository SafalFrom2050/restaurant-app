<section class="left">
    <ul>
        <?php use Models\Image;
        use Models\MenuImage;

        require COMPONENTS_PATH.'sidebar-li.php'?>
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

            require COMPONENTS_PATH . 'menu-item.php';
        }

        ?>

    </ul>

</section>
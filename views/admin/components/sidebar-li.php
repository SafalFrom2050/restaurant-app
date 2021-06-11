<section class="left">
    <ul>
        <li style="margin-top:2rem; padding-bottom: 0.5rem; border-bottom: solid yellow 4px; color: white">
            Manage
        </li>
        <?php
        if (!isset($sideBarOptions)) {
            echo '<h3 style="color: #ff5050">Oops! Here should be list of options.</h3>';
            $sideBarOptions = [];
        }
        foreach ($sideBarOptions as $option) {
            // <li><a href="menu.php">Menu</a></li>


            echo '<li><a href="'.$option['link'].'">'.$option['title'].'</a></li>';
        }



        if (isset($isAdmin, $adminOptions) && $isAdmin) {
            echo '<li style="margin-top:2rem; padding-bottom: 0.5rem; border-bottom: solid yellow 4px; color: white">
                    Admin
               </li>';

            foreach ($adminOptions as $option) {
                // <li><a href="menu.php">Menu</a></li>


                echo '<li><a href="'.$option['link'].'">'.$option['title'].'</a></li>';
            }
        }

        echo '<li style="margin-top:2rem; padding-bottom: 0.5rem; border-bottom: solid yellow 4px; color: white">
                    Account
               </li>';
        echo '<li><a href="/admin/logout">Logout</a></li>';

        ?>

    </ul>
</section>
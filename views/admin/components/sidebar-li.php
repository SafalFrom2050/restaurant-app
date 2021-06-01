<?php

foreach ($sideBarOptions as $option) {
    // <li><a href="menu.php">Menu</a></li>


    echo '<li><a href="/'.$option['link'].'">'.$option['title'].'</a></li>';
}
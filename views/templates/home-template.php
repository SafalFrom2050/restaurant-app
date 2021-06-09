<p>
    Welcome to Kate's Kitchen, we're a family run restaurant in northampton. Take a look around our site to see our menu!
</p>

<h2>Take a look at our menu:</h2>
<ul>
    <?php require COMPONENTS_PATH.'sidebar-li.php'?>
</ul>

<br> <br> <br>
<h2>Updates</h2>
<p>    Notices about special offers and our bank holiday opening times are listed here.</p>

<div class="listing">
    <ul>
    <?php
    foreach ($updates as $update) {
        echo '<li>';
        echo '<h3 style="float: unset">' . $update->title . '</h3>';

        echo '<h5 style="font-weight: lighter">' . $update->date . '</h5><br><br>';
        echo '<p>' . $update->description . '</p>';

        echo $update->photo;

        echo '</li>';
    }
    ?>
    </ul>
</div>

<section class="right">

    <h2>Member</h2>

    <a class="new" href="/admin/add-update">Add new update</a>

    <table>
        <thead>
        <tr>
            <th style="width: 30%">Date</th>
            <th style="width: 25%">Title</th>
            <th style="width: 10%">Description</th>
            <th style="width: 10%">Photo</th>

            <th style="width: 40%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
        </tr>

        <?php
        if (!isset($updates)) {
            echo '<h3 style="color: #ff5050">Updates list is empty!</h3>';
            $members = [];
        }

        foreach ($updates as $update) {
            require COMPONENTS_PATH_ADMIN . 'update-item.php';
        }
        ?>
        </thead>
    </table>

</section>


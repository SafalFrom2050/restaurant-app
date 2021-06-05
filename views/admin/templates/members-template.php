<section class="right">

    <h2>Member</h2>

    <a class="new" href="admin?navigate=member">Add new member</a>

    <table>
        <thead>
            <tr>
                <th style="width: 30%">Full Name</th>
                <th style="width: 25%">Username</th>
                <th style="width: 10%">Admin</th>

                <th style="width: 40%">&nbsp;</th>
                <th style="width: 5%">&nbsp;</th>
            </tr>

            <?php
            if (!isset($members)) {
                echo '<h3 style="color: #ff5050">Members list is empty!</h3>';
                $members = [];
            }

            foreach ($members as $member) {
                require COMPONENTS_PATH_ADMIN . 'member-item.php';
            }
            ?>
        </thead>
    </table>

</section>


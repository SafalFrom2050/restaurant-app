<section class="right">
    <h2>Add Member</h2>

    <form action="admin?navigate=members" method="POST">

        <label for="full_name">Full Name</label>
        <input type="text" autocomplete="name" name="full_name" id="full_name" value="<?php echo isset($full_name) ? $full_name : '' ?>"/>

        <label for="username">Username</label>
        <input type="text" autocomplete="username" name="username" id="username" value="<?php echo isset($username) ? $username : '' ?>"/>

        <label for="password">Password</label>
        <input type="password" autocomplete="password" name="password" id="password"/>

        <label for="is_admin">Is Admin</label>
        <select id="is_admin" name="is_admin">
            <option value="0" <?php echo (isset($is_admin) && $is_admin) ? '' : 'selected' ?> >No</option>
            <option value="1" <?php echo (isset($is_admin) && $is_admin) ? 'selected' : '' ?>>Yes</option>
        </select>

        <?php
        csrf();
        input_method(isset($id) ? 'PUT' : 'POST');
        input_id(isset($id) ? $id : '');
        input_submit(isset($id) ? 'Edit Member' : 'Add Member');
        ?>

    </form>
</section>
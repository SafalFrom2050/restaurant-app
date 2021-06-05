<h2>Log in</h2>

<form action="" method="post" style="padding: 40px">

    <label>Enter Username</label>
    <input type="text" name="username" />

    <label>Enter Password</label>
    <input type="password" name="password" />

    <?php
    input_hidden('login', 'login');
    input_submit('Log In');
    ?>
</form>
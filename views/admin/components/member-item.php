<?php !isset($member) ? $member = null : 0 ?>
<tr>
    <td><?php echo $member->fullName ?></td>
    <td><?php echo $member->username ?></td>

    <td><?php echo $t = $member->isAdmin ? "Yes" : "No" ?></td>
    <td><a style="float: right" href="admin?navigate=member&id=<?php echo $member->id ?>">Edit</a></td>
    <td>
        <form method="post" action="">
            <?php
            csrf();
            input_id($member->id);
            input_method('DELETE');
            input_submit('Delete');
            ?>
        </form>
    </td>
</tr>
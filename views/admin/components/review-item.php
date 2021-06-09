<?php

use Models\Menu;

!isset($review) ? $review = null : 0;
$menu = Menu::create(getPDO())->find($review->menuId);
?>
<tr>
    <td><?php echo $review->reviewer ?></td>
    <td style="text-align: center"><?php echo $review->rating ?></td>

    <td><p><?php echo $t = $review->review ?></p></td>

    <td style="text-align: center"><?php echo $menu->name ?></td>

    <td>
        <form method="post" action="">
            <?php
            csrf();
            input_id($review->id);
            input_hidden('moderated', 1);
            input_method('PUT');
            input_submit('Approve');
            ?>
        </form>
    </td>
    <td>
        <form method="post" action="">
            <?php
            csrf();
            input_id($review->id);
            input_method('DELETE');
            input_submit('Delete');
            ?>
        </form>
    </td>
</tr>
<?php !isset($member) ? $member = null : 0 ?>
<tr>
    <td><?php echo $booking->email ?></td>
    <td><?php echo $booking->phone ?></td>
    <td><?php echo $t = $booking->totalGuests ?></td>
    <td><?php echo $t = $booking->dateTime ?></td>

    <td>
        <form method="post" action="">
            <?php
            csrf();
            input_id($booking->id);
            input_method('PUT');

            $processedBtn = ($booking->processed == 0) ? "Set Processed" : "Undo Processed";
            $processedValue = ($booking->processed == 1) ? 0 : 1;

            input_submit($processedBtn);
            input_hidden('processed', $processedValue);
            ?>
        </form>
    </td>

    <td>
        <form method="post" action="">
            <?php
            csrf();
            input_id($booking->id);
            input_method('DELETE');
            input_submit('Delete');
            ?>
        </form>
    </td>
</tr>
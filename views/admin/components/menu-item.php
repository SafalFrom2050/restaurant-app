<?php !isset($record) ? $record = null : 0?>
<tr>
    <td> <?php echo $record->name ?> </td>
    <td><?php echo $record->price ?></td>
    <td><a style="float: right" href="/admin/?navigate=dish&id=<?php echo $record->id ?>">Edit</a></td>
    <td>
        <form method="post" action="/admin/?navigate=menu">
            <?php
            csrf();
            input_id($record->id);
            input_method('PUT');

            $visibilityBtn = ($record->visible == 1) ? "Hide" : "Show";
            $visibilityValue = ($record->visible == 1) ? 0 : 1;

            input_submit($visibilityBtn);
            input_hidden('visible', $visibilityValue);
            ?>
        </form>
    </td>

    <td>
        <form method="post" action="/admin/?navigate=menu">
            <?php
            csrf();
            input_id($record->id);
            input_method('DELETE');
            input_submit('Delete');
            ?>
        </form>
    </td>
</tr>
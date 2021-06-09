<?php use Models\Image;

!isset($update) ? $update = null : 0 ?>
<tr>
    <td><?php echo $update->date ?></td>
    <td><?php echo $update->title ?></td>
    <td><?php echo $update->description ?></td>

    <td><?php echo $t = $update->imageId ? Image::create(getPDO())->find($update->imageId)->fileName : "" ?></td>
    <td><a style="float: right" href="/admin/add-update?id=<?php echo $update->id ?>">Edit</a></td>
    <td>
        <form method="post" action="">
            <?php
            csrf();
            input_id($update->id);
            input_method('DELETE');
            input_submit('Delete');
            ?>
        </form>
    </td>
</tr>
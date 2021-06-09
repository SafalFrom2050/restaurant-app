<?php !isset($category) ? $category = null : 0?>
<tr>
    <td><?php echo $category->name ?></td>
    <td><a style="float: right" href="/admin/category?id=<?php echo $category->id ?>">Edit</a></td>
    <td>
        <form method="post" action="/admin/categories">
            <?php
            csrf();
            input_id($category->id);
            input_method('DELETE');
            input_submit('Delete');
            ?>
        </form>
    </td>
</tr>
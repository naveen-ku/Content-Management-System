<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
                $sql = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_publish_query = mysqli_query($connection, $sql);
                confirmQuery($update_publish_query);
                header("Location:posts.php");
                break;
            case 'draft':
                $sql = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_draft_query = mysqli_query($connection, $sql);
                confirmQuery($update_draft_query);
                header("Location:posts.php");

                break;
            case 'delete':
                $sql = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $delete_post_query = mysqli_query($connection, $sql);
                confirmQuery($delete_post_query);
                header("Location:posts.php");

                break;
        }
    }
}

?>

<form action="" method="POST">
    <div class="row">
        <div id="bulkOptionContainer" class="col-xs-4">
            <select name="bulk_options" id="" class="form-control">
                <option value="" disabled selected>Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>

            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
    </div><br />

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category ID</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Delete</th>
                <th>Edit</th>

            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $sql);
            confirmQuery($select_posts);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];

                echo "<tr>";
            ?>
                <td><input class="custom_checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></input></td>
            <?php
                echo " <td>{$post_id}</td>";
                echo " <td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                echo " <td>{$post_author}</td>";

                $sql = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_catagory_title = mysqli_query($connection, $sql);
                confirmQuery($select_catagory_title);

                while ($row = mysqli_fetch_assoc($select_catagory_title)) {
                    $post_category_title = $row['cat_title'];
                    echo " <td>{$post_category_title}</td>";
                }

                echo " <td>{$post_status}</td>";
                echo " <td><img src='../images/{$post_image}' class='img-responsive' width='100px' alt='post_img'> </td>";
                echo " <td>{$post_tags}</td>";
                echo " <td>{$post_comment_count}</td>";
                echo " <td>{$post_date}</td>";
                echo " <td><a onclick=\"javascript: return confirm('Are you sure you want to delete it ?') \" href='posts.php?delete={$post_id}'>
                                    <span class='glyphicon glyphicon-remove' style='color:red' > Delete</span>
                                    </a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>
                                    <span class='glyphicon glyphicon-pencil' style='color:orange'> Edit</span>
                                    </a></td>";

                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</form>

<?php
if (isset($_GET['delete'])) {
    $delete_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id} ";
    $delete_query = mysqli_query($connection, $query);

    confirmQuery($delete_query);

    header("Location: posts.php");
}

?>
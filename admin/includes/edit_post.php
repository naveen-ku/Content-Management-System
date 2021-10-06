<?php

if (isset($_GET['p_id'])) {
    $edit_post_id = $_GET['p_id'];
}

$sql = "SELECT * FROM posts WHERE post_id = '{$edit_post_id}' ";
$edit_post_query = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_assoc($edit_post_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];

    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}


if (isset($_POST['update_post'])) {
    $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
    $post_category_id = mysqli_real_escape_string($connection, $_POST['post_category']);
    $post_author = mysqli_real_escape_string($connection, $_POST['post_author']);
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);

    $post_image = mysqli_real_escape_string($connection, $_FILES['post_image']['name']);
    $post_image_temp = mysqli_real_escape_string($connection, $_FILES['post_image']['tmp_name']);

    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id ={$edit_post_id} ";
        $select_image_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_image_query)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = {$post_category_id}, ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$edit_post_id}";

    $update_post_query = mysqli_query($connection, $query);
    confirmQuery($update_post_query);
    header("Location: posts.php");
}

?>


<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category </label><br />
        <select name="post_category" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $select_cat_id = $row['cat_id'];
                $select_cat_title = $row['cat_title'];
                echo "<option value='{$select_cat_id}'>{$select_cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control" id="">
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Published</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label><br />
        <img src="../images/<?php echo $post_image; ?>" alt="" width="100px"><br /><br />
        <input type="file" name="post_image">

    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="ckeditor_editor">
            <?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
    </div>
</form>
<?php
if (isset($_POST['create_post'])) {
    $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
    $post_category_id = mysqli_real_escape_string($connection, $_POST['post_category']);
    $post_author = mysqli_real_escape_string($connection, $_POST['post_author']);

    if ($_SESSION['user_role'] == 'admin') {
        $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    } else {
        $post_status = 'draft';
    }

    $post_image = mysqli_real_escape_string($connection, $_FILES['post_image']['name']);
    $post_image_temp = mysqli_real_escape_string($connection, $_FILES['post_image']['tmp_name']);

    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    $post_date = date('d-m-y');


    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query);
    header("Location: posts.php");
}

?>


<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" required>
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br />
        <select name="post_category" class="form-control" required>
            <option value="" disabled selected> Select Categories</option>
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
        <label for="post_author">Post Author</label><br />
        <select name="post_author" class="form-control" required>
            <option value=<?php echo $_SESSION['username'] ?> selected><?php echo $_SESSION['username'] ?></option>

            <?php
            if ($_SESSION['user_role'] == 'admin') {
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $query);

                confirmQuery($select_users);

                while ($row = mysqli_fetch_assoc($select_users)) {
                    $select_user_id = $row['user_id'];
                    $select_username = $row['username'];
                    echo "<option value='{$select_username}'>{$select_username}</option>";
                }
            }
            ?>
        </select>
    </div>



    <?php
    if ($_SESSION['user_role'] == 'admin') {
    ?>
        <div class="form-group">
            <label for="post_status">Post Status</label>
            <select name="post_status" id="" class="form-control" required>
                <option value="" disabled selected>Select post status</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>
    <?php
    }
    ?>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="ckeditor_editor">
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
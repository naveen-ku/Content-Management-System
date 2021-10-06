<form action="" method="POST">
    <div class="form-group <?php echo $error_class ?>">
        <label for="cat_title">Edit Category</label>
        <?php
        if (isset($_GET['edit'])) {
            $get_cat_id = mysqli_real_escape_string($connection, $_GET['edit']);
            $sql = "SELECT * FROM categories WHERE cat_id='{$get_cat_id}' ";
            $select_categories_query = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($select_categories_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
        ?>
                <input value="<?php if (isset($cat_title)) echo $cat_title; ?>" class="form-control" name="cat_title" type="text">

        <?php  }
        } ?>
        <?php
        // Update Category 
        if (isset($_POST['update_category'])) {
            $cat_title = mysqli_real_escape_string($connection, $_POST['cat_title']);
            $sql = "UPDATE categories SET cat_title='{$cat_title}' WHERE cat_id ='{$cat_id}' ";
            $update_query = mysqli_query($connection, $sql);
            if (!$update_query) {
                die("Query Failed" . mysqli_error($connection));
            }
            header("Location: categories.php");
        }

        ?>

    </div>
    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
</form>
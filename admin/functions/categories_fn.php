<?php


function insertCategoriesFn()
{
    global $connection;
    global $error_msg;
    global $error_class;
    $error_msg = "";
    $error_class = "";
    if (isset($_POST['submit'])) {
        $cat_title = mysqli_real_escape_string($connection, $_POST['cat_title']);

        if ($cat_title == "" || empty($cat_title)) {
            $error_class = " alert alert-danger";
            $error_msg = "This field cannot be empty.";
        } else {
            $sql = "INSERT INTO categories(cat_title) VALUES ('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $sql);

            if (!$create_category_query) {
                die("Query failed" . mysqli_error($connection));
            }
            header("Location: categories.php");
        }
    }
}


function findAllCategoriesFn()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        if (isset($_SESSION['user_role'])) {
            if ($_SESSION['user_role'] == 'admin') {
                echo "<td><a href='categories.php?delete={$cat_id}'>
                                    <span class='glyphicon glyphicon-remove' style='color:red' > Delete</span>
                                    </a></td>";
                echo "<td><a href='categories.php?edit={$cat_id}'>
                                    <span class='glyphicon glyphicon-pencil' style='color:orange'> Edit</span>
                                    </a></td>";
                echo "</td>";
            }
        }
    }
}


function deleteCategoryFn()
{
    global $connection;

    if (isset($_GET['delete'])) {
        if (isset($_SESSION['user_role'])) {
            if ($_SESSION['user_role'] == 'admin') {
                $get_cat_id = $_GET['delete'];
                $sql = "DELETE FROM categories WHERE cat_id = {$get_cat_id} ";
                $delete_categoriy_query = mysqli_query($connection, $sql);
                header("Location: categories.php");
            } else {
                header("Location: index.php");
            }
        }
    }
}

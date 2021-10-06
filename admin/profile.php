<?php include "includes/admin_header.php" ?>
<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
    }
}

if (isset($_POST['update_user_profile'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_image = '{$user_image}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$user_id}";

    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
    header("Location: index.php");
}


?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit Profile
                    </h1>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_role">User Role</label>
                            <select name="user_role" id="" class="form-control" required>

                                <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>


                            </select>
                        </div>


                        <div class="form-group">
                            <label for="user_firstname">User FirstName</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">User LastName</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_image">User Image</label>
                            <input type="file" name="user_image">
                        </div>

                        <div class="form-group">
                            <label for="user_email">User Email</label>
                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_password">User Password</label>
                            <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
                        </div>



                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_user_profile" value="Update Profile">
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php" ?>
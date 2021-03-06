<?php
if ($_SESSION['user_role'] != 'admin') {
    header("Location:index.php");
}
?>

<?php

if (isset($_GET['user_id'])) {
    $edit_user_id = $_GET['user_id'];
}

$sql = "SELECT * FROM users WHERE user_id = '{$edit_user_id}' ";
$edit_user_query = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_assoc($edit_user_query)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
}


if (isset($_POST['update_user'])) {
    if ($_SESSION['user_role'] == 'admin') {
        $edit_user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
        $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
        $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
        $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);

        if (!empty($user_password)) {
            $sql = "SELECT user_password FROM users WHERE user_id=$edit_user_id";
            $get_user_password_query = mysqli_query($connection, $query);
            confirmQuery($get_user_password_query);

            $row = mysqli_fetch_array($get_user_password_query);
            $db_user_password = $row['user_password'];

            if ($db_user_password != $user_password) {
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10));
            }
            $query = "UPDATE users SET ";
            $query .= "username = '{$username}', ";
            $query .= "user_role = '{$user_role}', ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$hashed_password}' ";
            $query .= "WHERE user_id = {$edit_user_id}";

            $update_user_query = mysqli_query($connection, $query);
            confirmQuery($update_user_query);
            header("Location: users.php");
        } else {
            $query = "UPDATE users SET ";
            $query .= "username = '{$username}', ";
            $query .= "user_role = '{$user_role}', ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_email = '{$user_email}' ";
            $query .= "WHERE user_id = {$edit_user_id}";

            $update_user_query = mysqli_query($connection, $query);
            confirmQuery($update_user_query);
            header("Location: users.php");
        }
    }
}

?>


<form action="" method="POST">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="" class="form-control" required>

            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php
            if ($user_role == 'admin') {
                echo "<option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>Admin</option>";
            }
            ?>

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
        <label for="user_email">User Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="form-group">
        <label for="user_password">User Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>



    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>
</form>
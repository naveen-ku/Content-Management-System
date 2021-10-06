<?php
if (isset($_POST['create_user'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);

    $user_image = 'some random path';

    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10));



    $sql = "INSERT INTO users(username, user_firstname,user_lastname,user_email,user_image,user_password,user_role) ";
    $sql .= "VALUES('{$username}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_password}','{$user_role}')";

    $create_user_query = mysqli_query($connection, $sql);
    confirmQuery($create_user_query);
    header("Location: users.php");
}

?>


<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="" class="form-control" required>
            <option value="" disabled selected>Select Role</option>
            <option value="Subscriber">Subscriber</option>
            <option value="Admin">Admin</option>

        </select>
    </div>

    <div class="form-group">
        <label for="user_firstname">User FirstName</label><br />
        <input type="text" class="form-control" name="user_firstname" required>
    </div>

    <div class="form-group">
        <label for="user_lastname">User LastName</label>
        <input type="text" class="form-control" name="user_lastname" required>
    </div>

    <div class="form-group">
        <label for="user_email">User Email</label>
        <input type="email" class="form-control" name="user_email" required>
    </div>

    <div class="form-group">
        <label for="user_password">User Password</label>
        <input type="password" class="form-control" name="user_password" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>
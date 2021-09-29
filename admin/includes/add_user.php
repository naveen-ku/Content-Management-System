<?php
if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = 'some random path';

    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $randSalt = 'random';



    $sql = "INSERT INTO users(username, user_firstname,user_lastname,user_email,user_image,user_password,user_role,randSalt) ";
    $sql .= "VALUES('{$username}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_password}','{$user_role}','{$randSalt}')";

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
        <input type="text" class="form-control" name="user_password" required>
    </div>



    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>
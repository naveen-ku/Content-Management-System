<?php
$message = array();
$message['username'] = "";
$message['password'] = "";
$message['msg'] = "";
if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    $username = mysqli_real_escape_string($connection, $username);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    if (empty($username)) {
        $message['username'] = "Username cannot be empty";
        $classNameUsername = "alert alert-danger";
    }
    if (empty($user_password)) {
        $message['password'] = "User password cannot be empty";
        $classNamePassword = " alert alert-danger";
    }

    if (!empty($user_password) && !empty($username)) {
        $sql = "SELECT * FROM users WHERE username='{$username}'";
        $select_user_query = mysqli_query($connection, $sql);

        confirmQuery($select_user_query);

        while ($row = mysqli_fetch_assoc($select_user_query)) {
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_password = $row['user_password'];
            $db_user_role = $row['user_role'];
            $db_randSalt = $row['randSalt'];
        }
        if (password_verify($user_password, $db_user_password) && $username === $db_username) {
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

            header("Location: admin/index.php");
        }
    }
}

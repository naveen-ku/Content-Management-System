<?php
$message = array();
$message['username'] = "";
$message['email'] = "";
$message['password'] = "";
$message['success'] = "";

function usernameExists($username)
{
    global $connection;
    $sql = "SELECT username FROM users WHERE username = '$username' ";
    $select_usernames_query = mysqli_query($connection, $sql);
    confirmQuery($select_usernames_query);
    if (mysqli_num_rows($select_usernames_query) > 0) {
        return true;
    } else {
        return false;
    }
}


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $username = mysqli_real_escape_string($connection, $username);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    if (usernameExists($username)) {
        $message['username'] = "Username already exists";
        $classNameUsername = "alert alert-danger";
    }

    if (empty($username)) {
        $message['username'] = "Username cannot be empty";
        $classNameUsername = "alert alert-danger";
    }
    if (empty($user_email)) {
        $message['email'] = "User email cannot be empty";
        $classNameEmail = "alert alert-danger";
    }
    if (empty($user_password)) {
        $message['password'] = "User password cannot be empty";
        $classNamePassword = " alert alert-danger";
    }


    if (!empty($username) && !empty($user_email) && !empty($user_password) && !usernameExists($username)) {
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10));

        $sql = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $sql .= "VALUES('{$username}','{$user_email}','{$user_password}','subscriber')";
        $registration_user_query = mysqli_query($connection, $sql);
        confirmQuery($registration_user_query);

        $message['success'] = "User has been registered successfully";
        $classNameSuccess = "alert alert-success";
    }
}

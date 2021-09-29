<?php include "../db.php" ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    $username = mysqli_real_escape_string($connection, $username);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $sql = "SELECT * FROM users WHERE username='{$username}'";
    $select_user_query = mysqli_query($connection, $sql);

    if (!$select_user_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }

    if ($username === $db_username && $user_password === $db_user_password) {

        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: ../admin/index.php");
    } else {
        header("Location: ../index.php");
    }
}

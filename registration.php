<?php include "db.php"; ?>
<?php include "admin/functions/query_fn.php"; ?>
<?php include "includes/header.php"; ?>

<?php
$message = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if (!empty($username) && !empty($user_email) && !empty($user_password)) {
        $username = mysqli_real_escape_string($connection, $username);
        $user_email = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $sql = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($connection, $sql);
        confirmQuery($select_randSalt_query);
        $row = mysqli_fetch_array($select_randSalt_query);
        $randSalt = $row['randSalt'];
        $user_password = crypt($user_password, $randSalt);

        $sql = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $sql .= "VALUES('{$username}','{$user_email}','{$user_password}','subscriber')";
        $registration_user_query = mysqli_query($connection, $sql);
        confirmQuery($registration_user_query);

        $message = "User has been registered successfully";
        $className = "alert-success";
    } else {
        $message = "Fields cannot be empty";
        $className = "alert-danger";
    }
}


?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center">Register</h1>
                        <h6 class="text-center alert <?php echo $className ?>"><?php echo $message ?></h6>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="sr-only">Email</label>
                                <input type="email" name="user_email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>

    <?php include "includes/footer.php"; ?>
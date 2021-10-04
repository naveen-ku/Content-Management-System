<!-- Database -->
<?php include "db.php"; ?>

<!-- Helpers -->
<?php include "admin/functions/query_fn.php"; ?>

<!-- Header -->
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Route Protection -->
<?php
if (isset($_SESSION['username'])) {
    header("Location:index.php");
}
?>

<!-- Login Functionality -->
<?php include "includes/login.php" ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center">Login</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <div class="form-group <?php echo $classNameUsername ?>">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Desired Username">
                                <span><?php echo $message['username'] ?></span>
                            </div>

                            <div class="form-group <?php echo $classNamePassword ?>">
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" class="form-control" placeholder="Password">
                                <span><?php echo $message['password'] ?></span>
                            </div>

                            <input type="submit" name="login_user" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Login">
                        </form>
                    </div>
                </div> <!-- /.col-xs-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
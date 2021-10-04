<!-- Database -->
<?php include "db.php"; ?>

<!-- Helper  -->
<?php include "admin/functions/query_fn.php"; ?>

<!-- Header -->
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Route Protection -->
<?php
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>

<!-- Registration Functionality -->
<?php include "includes/registration.php" ?>

<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center">Register</h1>
                        <h6 class="text-center <?php echo $classNameSuccess ?>"><?php echo $message['success'] ?></h6>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                            <div class="form-group <?php echo $classNameUsername ?>">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Desired Username" aria-describedby="error_msg">
                                <span id="error_msg"><?php echo $message['username'] ?></span>
                            </div>

                            <div class="form-group <?php echo $classNameEmail ?>">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" class="form-control" placeholder="somebody@example.com" aria-describedby="error_msg">
                                <span id="error_msg"><?php echo $message['email'] ?></span>
                            </div>

                            <div class="form-group <?php echo $classNameEmail ?>">
                                <label for="user_password">Password</label>
                                <input type="password" name="user_password" class="form-control" placeholder="Password" aria-describedby="error_msg">
                                <span id="error_msg"><?php echo $message['password'] ?></span>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                        </form>
                    </div>
                </div> <!-- /.col-xs-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
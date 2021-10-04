<?php include "db.php"; ?>
<?php include "admin/functions/query_fn.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php
if (isset($_SESSION['username'])) {
    header("Location:index.php");
}
?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center">Login</h1>
                        <form role="form" action="includes/login.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="login_user" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Login">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>

    <?php include "includes/footer.php"; ?>
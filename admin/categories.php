<?php include "includes/admin_header.php" ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php
                        if (isset($_SESSION['user_role'])) {
                            if ($_SESSION['user_role'] == 'admin') {
                                echo "Add Categories";
                            } else {
                                echo "View All Categories";
                            }
                        }
                        ?>
                    </h1>


                    <div class="col-xs-6">

                        <?php deleteCategoryFn(); ?>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <?php
                                    if (isset($_SESSION['user_role'])) {
                                        if ($_SESSION['user_role'] == 'admin') {
                                            echo "<th>Delete</th>";
                                            echo "<th>Edit</th>";
                                        }
                                    }
                                    ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php findAllCategoriesFn(); ?>
                            </tbody>
                        </table>
                    </div>


                    <div class="col-xs-6">
                        <?php insertCategoriesFn(); ?>
                        <?php
                        if (isset($_SESSION['user_role'])) {
                            if ($_SESSION['user_role'] == 'admin') {
                        ?>
                                <form action="" method="POST">
                                    <div class="form-group <?php echo $error_class ?>">
                                        <label for="cat_title">Add Category</label>
                                        <input class="form-control" name="cat_title" type="text" aria-describedby="error_msg">
                                        <span id="error_msg"><?php echo $error_msg ?></span>
                                    </div>
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </form>
                        <?php
                            }
                        } ?>
                        <?php
                        if (isset($_GET['edit'])) {
                            $cat_id = mysqli_real_escape_string($connection, $_GET['edit']);
                            include "includes/update_categories.php";
                        }
                        ?>

                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php" ?>
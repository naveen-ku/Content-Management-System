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
                        Welcome to Admin Dashboard
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $sql = "SELECT * FROM posts";
                                    $count_posts_query = mysqli_query($connection, $sql);
                                    $post_count = mysqli_num_rows($count_posts_query);
                                    confirmQuery($count_posts_query);
                                    ?>
                                    <div class='huge'><?php echo $post_count ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Posts</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $sql = "SELECT * FROM comments";
                                    $count_comments_query = mysqli_query($connection, $sql);
                                    $comments_count = mysqli_num_rows($count_comments_query);
                                    confirmQuery($count_comments_query);
                                    ?>
                                    <div class='huge'><?php echo $comments_count ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Comments</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $sql = "SELECT * FROM users";
                                    $count_users_query = mysqli_query($connection, $sql);
                                    $user_count = mysqli_num_rows($count_users_query);
                                    confirmQuery($count_users_query);
                                    ?>
                                    <div class='huge'><?php echo $user_count ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Users</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $sql = "SELECT * FROM categories";
                                    $count_categories_query = mysqli_query($connection, $sql);
                                    $categories_count = mysqli_num_rows($count_categories_query);
                                    confirmQuery($count_categories_query);
                                    ?>
                                    <div class='huge'><?php echo $categories_count ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Categories</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            $sql = "SELECT * FROM posts where post_status = 'published'";
            $count_published_posts_query = mysqli_query($connection, $sql);
            $published_post_count = mysqli_num_rows($count_published_posts_query);
            confirmQuery($count_published_posts_query);

            $sql = "SELECT * FROM posts where post_status = 'draft'";
            $count_draft_posts_query = mysqli_query($connection, $sql);
            $draft_post_count = mysqli_num_rows($count_draft_posts_query);
            confirmQuery($count_draft_posts_query);

            $sql = "SELECT * FROM comments where comment_status = 'approved'";
            $count_approved_comments_query = mysqli_query($connection, $sql);
            $approved_comment_count = mysqli_num_rows($count_approved_comments_query);
            confirmQuery($count_approved_comments_query);

            $sql = "SELECT * FROM comments where comment_status = 'unapproved'";
            $count_unapproved_comments_query = mysqli_query($connection, $sql);
            $unapproved_comment_count = mysqli_num_rows($count_unapproved_comments_query);
            confirmQuery($count_unapproved_comments_query);

            $sql = "SELECT * FROM users where user_role = 'subscriber'";
            $count_user_subscriber_query = mysqli_query($connection, $sql);
            $user_subscriber_count = mysqli_num_rows($count_user_subscriber_query);
            confirmQuery($count_user_subscriber_query);


            ?>

            <!-- row -->
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $element_text = ['Published Posts', 'Draft Posts', 'Approved Comments', 'Unapproved Comments', 'Total Users', 'Subscribers', 'Categories'];
                            $element_count = [$published_post_count, $draft_post_count, $approved_comment_count, $unapproved_comment_count, $user_count, $user_subscriber_count, $categories_count];
                            for ($i = 0; $i < 7; $i++) {
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }

                            ?>

                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php" ?>
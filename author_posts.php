<!-- Database -->
<?php include "db.php" ?>

<!-- Helpers -->
<?php include "helpers/console_log_output.php" ?>
<?php include "admin/functions/query_fn.php" ?>


<!-- Header -->
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            if (isset($_GET['author'])) {
                $posts_author = $_GET['author'];

                $sql = "SELECT * FROM posts WHERE post_author = '{$posts_author}'";
                $query = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_content = substr($row['post_content'], 0, 300);

            ?>
                    <!-- Blogs Fetch from DB -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="Error in path">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class=" glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

            <?php }
            } ?>


            <!-- Blog Comments -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->

    <!-- Footer -->
    <?php include "includes/footer.php" ?>
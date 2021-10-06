<!-- Database -->
<?php include "db.php" ?>

<!-- Helpers -->
<?php include "helpers/console_log_output.php" ?>
<?php include "admin/functions/query_fn.php" ?>

<!-- Function -->
<?php include "functions/comments.php" ?>
<?php include "functions/posts.php" ?>

<!-- Header -->
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <button onclick="history.go(-1);" class="btn btn-default">Back </button>
            <?php
            if (isset($_GET['p_id'])) {

                $single_post_id = mysqli_real_escape_string($connection, $_GET['p_id']);

                updatePostViewCount($single_post_id);
                $select_single_post_query = selectSinglePost($single_post_id);

                while ($row = mysqli_fetch_assoc($select_single_post_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
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
                    <hr>
            <?php }
            } else {
                header("Location: index.php");
            } ?>

            <!-- Blog Comments -->
            <?php
            $message = array();
            $message = createComment($message);
            ?>

            <!-- Comments Form -->
            <?php include "includes/comment_form.php" ?>

            <!-- Posted Comments -->
            <?php include "includes/posted_comments.php" ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->

    <!-- Footer -->
    <?php include "includes/footer.php" ?>
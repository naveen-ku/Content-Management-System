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
            if (isset($_GET['p_id'])) {
                $single_post_id = $_GET['p_id'];
            }

            $sql = "SELECT * FROM posts WHERE post_id = {$single_post_id}";
            $query = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>
                <!-- Blogs Fetch from DB -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="Error in path">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>

            <?php } ?>


            <!-- Blog Comments -->

            <?php
            if (isset($_POST['create_comment'])) {

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                $comment_status = "unapproved";
                $comment_post_id = $_GET['p_id'];

                $sql = "INSERT INTO comments(comment_author, comment_email, comment_content, comment_status, comment_post_id, comment_date ) ";
                $sql .= "VALUES('{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', {$comment_post_id}, now() )";
                $create_comment_query = mysqli_query($connection, $sql);
                confirmQuery($create_comment_query);

                $sql2 = "UPDATE posts SET post_comment_count=post_comment_count + 1 ";
                $sql2 .= "WHERE post_id = {$comment_post_id}";
                $update_comment_count_query = mysqli_query($connection, $sql2);
                confirmQuery($update_comment_count_query);

                header("Location: post.php");
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form method="POST" action="">

                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" name="comment_author" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="text" name="comment_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="comment_email">Content</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            $comment_post_id = $_GET['p_id'];

            $sql = "SELECT * FROM comments WHERE comment_status = 'approved' ";
            $sql .= "AND comment_post_id={$comment_post_id} ";
            $sql .= "ORDER BY comment_id DESC ";
            $fetch_comments_query = mysqli_query($connection, $sql);
            confirmQuery($fetch_comments_query);

            while ($row = mysqli_fetch_assoc($fetch_comments_query)) {
                $comment_author = $row['comment_author'];
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
            ?>
                <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading'><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>

            <?php } ?>

            <!-- Comment -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->

    <!-- Footer -->
    <?php include "includes/footer.php" ?>
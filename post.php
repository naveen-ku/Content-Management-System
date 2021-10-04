<!-- Database -->
<?php include "db.php" ?>

<!-- Helpers -->
<?php include "helpers/console_log_output.php" ?>
<?php include "admin/functions/query_fn.php" ?>

<?php include "functions/comments.php" ?>

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
                $single_post_id = $_GET['p_id'];

                $sql = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$single_post_id}";
                $update_post_view_count = mysqli_query($connection, $sql);
                confirmQuery($update_post_view_count);


                $sql = "SELECT * FROM posts WHERE post_id = {$single_post_id}";
                $query = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($query)) {
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
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form method="POST" action="">
                    <div class="form-group  <?php echo $message['authorClass'] ?>">
                        <label for="comment_author">Author</label>
                        <input type="text" name="comment_author" class="form-control">
                        <?php if ($message != null) {
                            echo "<span> {$message['author']} </span>";
                        }
                        ?>
                    </div>

                    <div class="form-group  <?php echo $message['emailClass'] ?>">
                        <label for="comment_email">Email</label>
                        <input type="text" name="comment_email" class="form-control">
                        <?php if ($message != null) {
                            echo "<span> {$message['email']} </span>";
                        }
                        ?>
                    </div>

                    <div class="form-group <?php echo $message['contentClass'] ?>">
                        <label for="comment_email">Content</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        <?php if ($message != null) {
                            echo "<span> {$message['content']} </span>";
                        }
                        ?>
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
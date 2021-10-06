<!-- Database -->
<?php include "db.php" ?>

<!-- Helpers -->
<?php include "helpers/console_log_output.php" ?>
<?php include "admin/functions/query_fn.php" ?>

<!-- Functions -->
<?php include "functions/posts.php" ?>
<?php include "functions/pager.php" ?>

<!-- Header -->
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php

            $count_published_posts = countPublishedPosts();

            if (isset($_GET['page'])) {
                $page_num = mysqli_real_escape_string($connection, $_GET['page']);
            } else {
                $page_num = "";
            }

            if ($page_num == "" || $page_num == 1) {
                $page1 = 0;
            } else {
                $page1 = ($page_num * 5) - 5;
            }

            $sql = "SELECT * FROM posts WHERE post_status = 'published'  ";
            $sql .= "ORDER BY post_id DESC LIMIT $page1 , 5";
            $query = mysqli_query($connection, $sql);

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
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
            } else {
                echo "<h1 class='text-center'>No Post found</h1>";
            }
            ?>

            <!-- Pager -->
            <ul class="pager">
                <?php
                pagerTiles($count_published_posts, $page_num);
                ?>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->

    <!-- Footer -->
    <?php include "includes/footer.php" ?>
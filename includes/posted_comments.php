  <?php
    $comment_post_id = mysqli_real_escape_string($connection, $_GET['p_id']);
    $fetch_comments_query = fetchComments($comment_post_id);

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
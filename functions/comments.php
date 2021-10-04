<?php
function createComment($message)
{
    global $connection;
    $message['author'] = "";
    $message['email'] = "";
    $message['content'] = "";
    $message['authorClass'] = "";
    $message['emailClass'] = "";
    $message['contentClass'] = "";

    if (isset($_POST['create_comment'])) {
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];
        $comment_status = "unapproved";
        $comment_post_id = $_GET['p_id'];

        $comment_author = mysqli_real_escape_string($connection, $comment_author);
        $comment_email = mysqli_real_escape_string($connection, $comment_email);
        $comment_content = mysqli_real_escape_string($connection, $comment_content);

        if (empty($comment_author)) {
            $message['authorClass'] = "alert alert-danger";
            $message['author'] = "Author field cannot be empty";
        }
        if (empty($comment_email)) {
            $message['emailClass'] = "alert alert-danger";
            $message['email'] = "Email field cannot be empty";
        }
        if (empty($comment_content)) {
            $message['contentClass'] = "alert alert-danger";
            $message['content'] = "Content field cannot be empty";
        }

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
            $sql = "INSERT INTO comments(comment_author, comment_email, comment_content, comment_status, comment_post_id, comment_date ) ";
            $sql .= "VALUES('{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', {$comment_post_id}, now() )";
            $create_comment_query = mysqli_query($connection, $sql);
            confirmQuery($create_comment_query);

            $sql2 = "UPDATE posts SET post_comment_count=post_comment_count + 1 ";
            $sql2 .= "WHERE post_id = {$comment_post_id}";
            $update_comment_count_query = mysqli_query($connection, $sql2);
            confirmQuery($update_comment_count_query);

            header("Location: post.php?p_id={$_GET['p_id']}");
        }

        return $message;
    }
}

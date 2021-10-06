<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php

        $sql = "SELECT * FROM comments ORDER BY comment_id DESC";
        $select_comments = mysqli_query($connection, $sql);
        confirmQuery($select_comments);

        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";

            echo " <td>{$comment_id}</td>";
            echo " <td>{$comment_author}</td>";
            echo " <td>{$comment_content}</td>";
            echo " <td>{$comment_email}</td>";
            echo " <td>{$comment_status}</td>";

            $sql = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
            $select_posts = mysqli_query($connection, $sql);
            confirmQuery($select_posts);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $select_post_id = $row['post_id'];
                $select_post_title = $row['post_title'];
                echo " <td><a href='../post.php?p_id={$select_post_id}'>{$select_post_title}</a></td>";
            }

            echo " <td>{$comment_date}</td>";
            echo " <td><a href='comments.php?approve={$comment_id}'>
                                    <span class='glyphicon glyphicon-ok' style='color:green' > Approve</span>
                                    </a></td>";
            echo " <td><a href='comments.php?unapprove={$comment_id}'>
                                    <span class='glyphicon glyphicon-remove' style='color:orange' > Unapprove</span>
                                    </a></td>";
            echo " <td><a href='comments.php?delete={$comment_id}&p_id={$select_post_id}'>
                                    <span class='glyphicon glyphicon-trash' style='color:red' > Delete</span>
                                    </a></td>";

            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<?php
if (isset($_GET['delete'])) {
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == 'admin') {

            $delete_comment_id = mysqli_real_escape_string($connection, $_GET['delete']);
            $comment_post_id = mysqli_real_escape_string($connection, $_GET['p_id']);

            $sql = "DELETE FROM comments WHERE comment_id = {$delete_comment_id} ";
            $delete_query = mysqli_query($connection, $sql);
            confirmQuery($delete_query);

            $sql2 = "UPDATE posts SET post_comment_count=post_comment_count - 1 ";
            $sql2 .= "WHERE post_id = {$comment_post_id}";
            $update_post_comment_query = mysqli_query($connection, $sql2);
            confirmQuery($update_post_comment_query);

            header("Location: comments.php");
        }
    }
}

if (isset($_GET['approve'])) {

    $approve_comment_id = mysqli_real_escape_string($connection, $_GET['approve']);
    $status = "approved";
    $sql = "UPDATE comments SET comment_status='{$status}' WHERE comment_id= {$approve_comment_id}";
    $approve_comment_query = mysqli_query($connection, $sql);
    confirmQuery($approve_comment_query);
    header("Location: comments.php");
}

if (isset($_GET['unapprove'])) {

    $unapprove_comment_id = mysqli_real_escape_string($connection, $_GET['unapprove']);
    $status = "unapproved";
    $sql = "UPDATE comments SET comment_status='{$status}' WHERE comment_id = {$unapprove_comment_id}";
    $unapprove_comment_query = mysqli_query($connection, $sql);
    confirmQuery($unapprove_comment_query);
    header("Location: comments.php");
}

?>
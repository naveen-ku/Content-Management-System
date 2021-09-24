<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category ID</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            echo " <td>{$post_id}</td>";
            echo " <td>{$post_title}</td>";
            echo " <td>{$post_author}</td>";
            echo " <td>{$post_category_id}</td>";
            echo " <td>{$post_status}</td>";
            echo " <td><img src='../images/{$post_image}' class='img-responsive' width='100px' alt='post_img'> </td>";
            echo " <td>{$post_tags}</td>";
            echo " <td>{$post_comment_count}</td>";
            echo " <td>{$post_date}</td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>
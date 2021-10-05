<?php

function updatePostViewCount($single_post_id)
{
    global $connection;
    $sql = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$single_post_id}";
    $update_post_view_count = mysqli_query($connection, $sql);
    confirmQuery($update_post_view_count);
}

function countPublishedPosts()
{
    global $connection;
    $sql = "SELECT * FROM posts WHERE post_status = 'published'";
    $count_published_posts_query = mysqli_query($connection, $sql);
    confirmQuery($count_published_posts_query);

    $count_published_posts = mysqli_num_rows($count_published_posts_query);
    $count_published_posts = ceil($count_published_posts / 5);
    return $count_published_posts;
}

function selectSinglePost($single_post_id)
{
    global $connection;
    $sql = "SELECT * FROM posts WHERE post_id = {$single_post_id}";
    $select_single_post_query = mysqli_query($connection, $sql);
    confirmQuery($select_single_post_query);
    return $select_single_post_query;
}

function selectPostsByCategory($cat_id)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_category_id = {$cat_id}";
    $sql = mysqli_query($connection, $query);
    confirmQuery($sql);

    return $sql;
}

function selectPostsByAuthor($posts_author)
{
    global $connection;
    $sql = "SELECT * FROM posts WHERE post_author = '{$posts_author}'";
    $get_post_author = mysqli_query($connection, $sql);
    confirmQuery($get_post_author);

    return $get_post_author;
}

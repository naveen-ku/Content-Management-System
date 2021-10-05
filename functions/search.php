<?php

function searchByTags($search)
{
    global $connection;

    $query = "SELECT * FROM posts WHERE post_Tags LIKE '%$search%' ";
    $sql = mysqli_query($connection, $query);
    confirmQuery($sql);
    return $sql;
}

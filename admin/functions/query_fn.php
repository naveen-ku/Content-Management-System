<?php


function confirmQuery($result)
{

    global $connection;
    if (!$result) {
        die("Query failed" . mysqli_error($connection));
    }
}

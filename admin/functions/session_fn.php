<?php
function users_online()
{

    if (isset($_GET['onlineusers'])) {

        global $connection;
        if (!$connection) {
            session_start();
            include("../../db.php");


            $session = session_id();
            $time = time();
            $time_out_in_seconds = 60;
            $time_out = $time - $time_out_in_seconds;

            $sql = "SELECT * FROM users_online WHERE session='$session'";
            $send_query = mysqli_query($connection, $sql);
            $count = mysqli_num_rows($send_query);
            if ($count == NULL) {
                $sql = "INSERT INTO users_online(session,time) VALUES ('$session','$time')";
                $send_query = mysqli_query($connection, $sql);
            } else {
                $sql = "UPDATE users_online SET time='$time' WHERE session = $session''";
                $send_query = mysqli_query($connection, $sql);
            }
            $sql = "SELECT * FROM users_online WHERE time >'$time_out'";
            $users_online_query = mysqli_query($connection, $sql);
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    }
}

users_online();

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change role to Admin</th>
            <th>Change role to Subscriber</th>
            <th>Delete</th>
            <th>Edit</th>

        </tr>
    </thead>
    <tbody>
        <?php

        $sql = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $sql);
        confirmQuery($select_users);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];


            echo "<tr>";
            echo " <td>{$user_id}</td>";
            echo " <td>{$username}</td>";
            echo " <td>{$user_firstname}</td>";
            echo " <td>{$user_lastname}</td>";
            echo " <td>{$user_email}</td>";
            echo " <td>{$user_role}</td>";
            echo " <td><a href='users.php?admin={$user_id}'> Admin </a></td>";
            echo " <td><a href='users.php?subscriber={$user_id}'> Subscriber </a></td>";
            echo " <td><a href='users.php?delete={$user_id}'>
                                    <span class='glyphicon glyphicon-trash' style='color:red' > Delete</span>
                                    </a></td>";
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>
                                    <span class='glyphicon glyphicon-pencil' style='color:navyblue'> Edit</span>
                                    </a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>

<?php
if (isset($_GET['admin'])) {
    $user_id = mysqli_real_escape_string($connection, $_GET['admin']);

    $sql = "UPDATE users SET user_role='admin' WHERE user_id = {$user_id} ";
    $change_role_to_admin_query = mysqli_query($connection, $sql);
    confirmQuery($change_role_to_admin_query);

    header("Location: users.php");
}

if (isset($_GET['subscriber'])) {
    $user_id = mysqli_real_escape_string($connection, $_GET['subscriber']);

    $sql = "UPDATE users SET user_role='subscriber' WHERE user_id = {$user_id} ";
    $change_role_to_subscriber_query = mysqli_query($connection, $sql);
    confirmQuery($change_role_to_subscriber_query);

    header("Location: users.php");
}

if (isset($_GET['delete'])) {

    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == 'admin') {
            $delete_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$delete_user_id} ";
            $delete_query = mysqli_query($connection, $query);
            confirmQuery($delete_query);
            header("Location: users.php");
        }
    }
}

?>
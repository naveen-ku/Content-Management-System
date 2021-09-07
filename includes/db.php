<?php include "../db_cred.php";


// Define a named constant
foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

// Connect to database
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$connection) {
    die('Error:' . mysqli_connect_error());
}

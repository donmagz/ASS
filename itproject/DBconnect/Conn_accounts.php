<?php
require("accounts.php"); // Make sure the database is created first before creating tables

$sql = "CREATE DATABASE IF NOT EXISTS accountsdb";
$query = mysqli_query($conn, $sql);

// if ($query) {
//     echo "Database is created." ;
// } else {
//     echo "Error creating database.";
// }
// ?>

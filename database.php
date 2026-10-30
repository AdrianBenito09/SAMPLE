<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "form";
$db_connection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

   

mysqli_set_charset($db_connection, "utf8mb4");
?>
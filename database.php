<?php
$servername = "sql112.infinityfree.com";
$username = "root";
$password = "";
$database = "pds_system";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


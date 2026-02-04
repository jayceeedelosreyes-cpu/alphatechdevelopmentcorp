<?php
$servername = "sql112.infinityfree.com";
$username = "if0_41058020";
$password = "alphatech2026";
$database = "pds_system";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>



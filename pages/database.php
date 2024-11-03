<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "db_ecommerce";
$conn = mysqli_connect($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}
?>
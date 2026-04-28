<?php
$host     = "localhost";
$username = "root";
$password = ""; 
$database = "learn_php";

// Connect to MySQL
$conn = mysqli_connect($host, $username, $password, $database);

// Stop everything if connection fails
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
$host     = getenv('MYSQLHOST')     ?: 'localhost';
$username = getenv('MYSQLUSER')     ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: '';
$database = getenv('MYSQLDATABASE') ?: 'learn_php';
$port     = (int)(getenv('MYSQLPORT') ?: 3306);

$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

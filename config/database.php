<?php
$host = "localhost"; 
$user = "root";
$password = "MiSQL2025+"; 
$database = "gema_db";
$port = 3307; 

$conn = mysqli_init();
if (!$conn) { die("mysqli_init failed"); }

$conn->real_connect($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
<?php
$host = "localhost";
$db   = "gema_db";        // Nombre correcto de la base de datos
$user = "root";
$pass = "MiSQL2025+";     // Tu contraseña real

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

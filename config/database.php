<?php
$host = "localhost";
$db   = "gema_db"; 
$user = "root";
$pass = "MiSQL2025+"; // Verifica que sea tu clave real

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión"]));
}
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "config/database.php";

$sql = "SELECT u.email, u.nombre, u.apellido, u.estado, r.nombre_revisor as revisor 
        FROM usuarios u 
        LEFT JOIN revisores r ON u.codigo_revisor = r.id";

$result = $conn->query($sql);
$usuarios = [];

while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);
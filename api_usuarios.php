<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "config/database.php";

$sql = "SELECT email, nombre, apellido, estado FROM usuarios";
$result = $conn->query($sql);

$usuarios = [];
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);
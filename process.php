<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $lineas = file($_FILES["archivo"]["tmp_name"]);
    
    foreach ($lineas as $linea) {
        $datos = explode(",", trim($linea));
        
        // REQUERIMIENTO: Validar que el código exista
        if (!isset($datos[3]) || empty($datos[3])) {
            echo json_encode(["status" => "error", "message" => "El archivo no tiene el formato correcto."]);
            exit;
        }

        $email = $datos[0];
        $nombre = $datos[1] ?? '';
        $apellido = $datos[2] ?? '';
        $estado = $datos[3];

        if (in_array($estado, ['1', '2', '3'])) {
            $sql = "INSERT INTO usuarios (email, nombre, apellido, estado) VALUES ('$email', '$nombre', '$apellido', '$estado')";
            $conn->query($sql);
        }
    }
    echo json_encode(["status" => "success"]);
}
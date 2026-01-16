<?php
ob_start(); 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "config/database.php";

$respuesta = ["status" => "error", "message" => "No se procesó nada"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $lineas = file($_FILES["archivo"]["tmp_name"]);
    $error_estado_4 = false;

    foreach ($lineas as $linea) {
        $datos = explode(",", trim($linea));
        if (count($datos) < 5) continue; 

        $email = $conn->real_escape_string($datos[0]);
        $nombre = $conn->real_escape_string($datos[1]);
        $apellido = $conn->real_escape_string($datos[2]);
        $estado = trim($datos[3]);
        $revisor_id = trim($datos[4]); 

        if ($estado == '4') {
            $error_estado_4 = true;
            break; 
        }

        if (in_array($estado, ['1', '2', '3'])) {
            $sql = "INSERT INTO usuarios (email, nombre, apellido, estado, codigo_revisor) 
                    VALUES ('$email', '$nombre', '$apellido', '$estado', '$revisor_id')";
            $conn->query($sql);
        }
    }

    if ($error_estado_4) {
        $respuesta = ["status" => "error", "message" => "El formato interno del archivo no es válido (Código 4 no permitido)."];
    } else {
        $respuesta = ["status" => "success"];
    }
}

ob_end_clean(); 
echo json_encode($respuesta); 
exit;
?>
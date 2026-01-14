<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $lineas = file($_FILES["archivo"]["tmp_name"]);
    $conn->begin_transaction(); 

    try {
        foreach ($lineas as $numLinea => $linea) {
            $datos = explode(",", trim($linea));
            
            if (count($datos) < 4) {
                throw new Exception("Error en línea " . ($numLinea + 1) . ": Formato incompleto.");
            }

            $email = $conn->real_escape_string($datos[0]);
            $nombre = $conn->real_escape_string($datos[1]);
            $apellido = $conn->real_escape_string($datos[2]);
            $estado = trim($datos[3]);

            // REQUERIMIENTO: Validar que el código sea solo 1, 2 o 3
            if (!in_array($estado, ['1', '2', '3'])) {
                // Si es un 4 u otro valor, lanzamos el error para el mockup
                throw new Exception("El formato interno del archivo no es válido (Código $estado no permitido).");
            }

            $sql = "INSERT INTO usuarios (email, nombre, apellido, estado) 
                    VALUES ('$email', '$nombre', '$apellido', '$estado')";
            $conn->query($sql);
        }
        
        $conn->commit();
        echo json_encode(["status" => "success"]);

    } catch (Exception $e) {
        $conn->rollback(); // Si hay un error (como el código 4), no guarda nada
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
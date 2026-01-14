<?php
require_once "config/database.php";

// 1. Verificamos que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. Verificamos que el archivo exista
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == 0) {

        // 3. Guardamos información del archivo
        $nombreArchivo = $_FILES["archivo"]["name"];
        $rutaTemporal = $_FILES["archivo"]["tmp_name"];

        // 4. Definimos la carpeta donde se guardará
        $carpetaDestino = "uploads/";

        // 5. Creamos la ruta final
        $rutaFinal = $carpetaDestino . $nombreArchivo;

        // 6. Movemos el archivo a la carpeta uploads
        if (move_uploaded_file($rutaTemporal, $rutaFinal)) {

    echo "Archivo cargado correctamente<br><br>";

    $lineas = file($rutaFinal);

  foreach ($lineas as $linea) {

    $linea = trim($linea);
    $datos = explode(",", $linea);

    $email    = $datos[0] ?? '';
    $nombre   = $datos[1] ?? '';
    $apellido = $datos[2] ?? '';
    $codigo   = $datos[3] ?? '';

    if ($codigo != '1' && $codigo != '2' && $codigo != '3') {
        echo "ERROR: código inválido en la línea → $linea <br>";
        continue;
    }

    $sql = "INSERT INTO usuarios (email, nombre, apellido, estado)
            VALUES ('$email', '$nombre', '$apellido', '$codigo')";

    $conn->query($sql);

    echo "Guardado → $email | Estado $codigo <br>";
}

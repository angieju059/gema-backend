<?php
require_once "config/database.php"; // Ajusta la ruta si es diferente

echo "Conexión exitosa a MySQL<br>";

// Mostrar tablas
$result = $conn->query("SHOW TABLES");

if ($result->num_rows > 0) {
    echo "Tablas en la base de datos '$db':<br>";
    while($row = $result->fetch_array()) {
        echo "- " . $row[0] . "<br>";
    }
} else {
    echo "No hay tablas en la base de datos.";
}
?>

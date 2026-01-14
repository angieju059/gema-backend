<?php
require_once "config/database.php";

function obtenerUsuariosPorEstado($conn, $estado) {
    $sql = "SELECT email, nombre, apellido FROM usuarios WHERE estado = $estado";
    return $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>
<body>

<h2>Usuarios Activos</h2>
<table border="1">
    <tr>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellido</th>
    </tr>
    <?php
    $activos = obtenerUsuariosPorEstado($conn, 1);
    while ($row = $activos->fetch_assoc()) {
        echo "<tr>
                <td>{$row['email']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido']}</td>
              </tr>";
    }
    ?>
</table>

<h2>Usuarios Inactivos</h2>
<table border="1">
    <tr>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellido</th>
    </tr>
    <?php
    $inactivos = obtenerUsuariosPorEstado($conn, 2);
    while ($row = $inactivos->fetch_assoc()) {
        echo "<tr>
                <td>{$row['email']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido']}</td>
              </tr>";
    }
    ?>
</table>

<h2>Usuarios en Espera</h2>
<table border="1">
    <tr>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellido</th>
    </tr>
    <?php
    $espera = obtenerUsuariosPorEstado($conn, 3);
    while ($row = $espera->fetch_assoc()) {
        echo "<tr>
                <td>{$row['email']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido']}</td>
              </tr>";
    }
    ?>
</table>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cargar archivo</title>
</head>
<body>

<h2>Cargar archivo de usuarios</h2>

<form action="process.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="archivo" accept=".txt" required>
    <br><br>
    <button type="submit">Cargar archivo</button>
</form>

</body>
</html>

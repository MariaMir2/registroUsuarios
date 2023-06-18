<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" type="text/css" href="registro.css">
</head>
<body>
<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cursosql";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Consulta de registros
$sql = "SELECT * FROM registro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Lista de usuarios registrados:</h2>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['nombre']}</td>";
        echo "<td>{$row['apellido1']}</td>";
        echo "<td>{$row['apellido2']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['login']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<script>alert('No hay usuarios registrados.');</script>";
}

// Cerrar conexión a la base de datos...
$conn->close();

?>
<br>
<form action="registro.html">
    <input class="boton" type="submit" value="Formulario de Registro">
</form>

</body>
</html>
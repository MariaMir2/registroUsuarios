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

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];

// Validación de datos
if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($login) || empty($password)) {
    die("Error: Todos los campos son obligatorios.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: El formato de email es inválido.");
}

if (strlen($password) < 4 || strlen($password) > 8) {
    die("Error: La contraseña debe tener entre 4 y 8 caracteres.");
}

// Verificar si el email ya está registrado en la base de datos
$sql = "SELECT * FROM registro WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('El email ya está registrado. Por favor, utiliza otro email.');</script>";
    echo "<script>window.location.href = 'registro.html';</script>";
    exit;
}

// Insertar datos en la base de datos
$sql = "INSERT INTO registro (nombre, apellido1, apellido2, email, login, password) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";

if ($conn->query($sql) === true) {
    echo "<script>alert('Registro completado con éxito.');</script>";
} else {
    echo "Error al registrar los datos: " . $conn->error;
}

// Cerrar conexión a la base de datos
$conn->close();

echo "<script>window.location.href = 'registro.html';</script>";
exit;

?>

<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Preparar la consulta SQL para evitar inyecciones SQL
$stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay un usuario que coincida con las credenciales
if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    echo "Inicio de sesión exitoso. ¡Bienvenido, " . htmlspecialchars($username) . "!";
} else {
    // Credenciales incorrectas
    echo "Nombre de usuario o contraseña incorrectos.";
}

// Cerrar la conexión
$stmt->close();
$mysqli->close();
?>
<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: ../inicio-sesion.html");
    exit();
}

// Incluir el archivo de conexión
include 'conexion.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Preparar la consulta SQL para insertar un nuevo usuario
$stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, apellido, correo, direccion, telefono, usuario, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nombre, $apellido, $email, $direccion, $phone, $username, $password);

// Ejecutar la consulta y verificar si se realizó correctamente
if ($stmt->execute()) {
    $message = "Usuario creado correctamente.";
} else {
    $message = "Error al crear el usuario: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$mysqli->close();

// Redirigir a la página de actualización con un mensaje de éxito o error
header("Location: actualizar.php?message=" . urlencode($message));
exit();
?>
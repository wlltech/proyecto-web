<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el ID del registro a borrar desde la URL
$id = $_GET['id'];

// Consulta SQL para borrar el registro
$query = "DELETE FROM clientes WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

// Redirigir de vuelta a la página de administración después de borrar
header("Location: administracion.php");
exit();

$stmt->close();
$mysqli->close();
?>
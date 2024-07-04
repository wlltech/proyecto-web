<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se envió el formulario por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir y limpiar los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["email"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    // Consulta preparada para insertar datos en la tabla `clientes`
    $sql = "INSERT INTO clientes (nombre, apellido, correo, direccion, telefono) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    // Verificar si la consulta preparada tiene errores
    if ($stmt === false) {
        die('Error en la consulta preparada: ' . $mysqli->error);
    }

    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param("sssss", $nombre, $apellido, $correo, $direccion, $telefono);

    if ($stmt->execute()) {
        echo "Gracias por registrarse";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

$mysqli->close();
?>
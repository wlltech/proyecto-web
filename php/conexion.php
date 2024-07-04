<?php

// Configuración de la conexión a la base de datos
$user = 'root';
$pass = '';
$server = 'localhost';
$db = 'registros';

// Crear una nueva conexión a MySQL
$mysqli = new mysqli($server, $user, $pass, $db);

// Verificar si hay errores de conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

?>
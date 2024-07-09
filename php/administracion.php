<?php
// Verificar si el usuario ha iniciado sesión
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: inicio-sesion.html");
    exit();
}

// Incluir el archivo de conexión
include 'conexion.php';

// Consulta SQL para seleccionar todos los registros de la tabla 'clientes'
$query = "SELECT * FROM clientes";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="../ css/styles.css">
    <link rel="stylesheet" href="../ css/inicio-sesion.css">
    <link rel="stylesheet" href="../ css/botones.css">
    <!-- Agrega cualquier otro CSS necesario -->
</head>
<body>
    <div id="header"></div>
    <script>
        fetch('../header-php.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header').innerHTML = data;
            })
            .catch(error => {
                console.error('Hubo un problema con la solicitud fetch:', error);
            });
    </script>
    <main>
        <h2>Administración de Usuarios</h2>
        <table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['apellido']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td><?php echo $row['telefono']; ?></td>
                <td>
                    <a href="actualizar.php?id=<?php echo $row['id']; ?>">Actualizar</a>
                    <a href="borrar.php?id=<?php echo $row['id']; ?>">Borrar</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </main>
    <div id="footer"></div>
    <script>
        fetch('../footer-php.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('footer').innerHTML = data;
            })
            .catch(error => {
                console.error('Hubo un problema con la solicitud fetch:', error);
            });
    </script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($mysqli);
?>
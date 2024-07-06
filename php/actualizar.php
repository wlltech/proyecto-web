<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario para actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Consulta SQL para actualizar el registro
    $query = "UPDATE clientes SET nombre=?, apellido=?, correo=?, direccion=?, telefono=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $direccion, $telefono, $id);
    
    if ($stmt->execute()) {
        // Redirigir de vuelta a la página de administración después de actualizar
        header("Location: administracion.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $stmt->error;
    }

    $stmt->close();
}

// Obtener el ID del registro a actualizar desde la URL
$id = $_GET['id'];

// Consulta SQL para obtener los datos del usuario con el ID proporcionado
$query = "SELECT * FROM clientes WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Mostrar el formulario con los datos actuales del registro
    // Aquí construimos el formulario con los campos y valores actuales
    // Por ejemplo:
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar Registro</title>
        <link rel="stylesheet" href="../ css/styles.css">
        <link rel="stylesheet" href="../ css/inicio-sesion.css">
        <link rel="stylesheet" href="../ css/botones.css">
        <!-- Agrega cualquier otro CSS necesario -->
    </head>
    <body>
        <div id="header"></div>
        <script>
            fetch('../header.html')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('header').innerHTML = data;
                })
                .catch(error => {
                    console.error('Hubo un problema con la solicitud fetch:', error);
                });
        </script>
        <main>
            <h2>Actualizar Registro</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>"><br>
                Apellido: <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>"><br>
                Correo: <input type="text" name="correo" value="<?php echo $row['correo']; ?>"><br>
                Dirección: <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>"><br>
                Teléfono: <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>"><br>
                <button type="submit">Actualizar</button>
            </form>
        </main>
        <div id="footer"></div>
        <script>
            fetch('footer.html')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('../footer').innerHTML = data;
                })
                .catch(error => {
                    console.error('Hubo un problema con la solicitud fetch:', error);
                });
        </script>
    </body>
    </html>
    <?php
} else {
    echo "Usuario no encontrado.";
}

$stmt->close();
$mysqli->close();
?>
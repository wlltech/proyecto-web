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
    <!-- Agrega cualquier otro CSS necesario -->
    <link href="../assets/css/normalize.css" rel="stylesheet" />
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/cabecera/header.css">
    <link rel="stylesheet" href="../assets/css/cabecera/menu.css">
    <link rel="stylesheet" href="../assets/css/banner/imagenes.css">
    <link rel="stylesheet" href="../assets/css/banner/titulo-principal.css">
    <link rel="stylesheet" href="../assets/css/info/descripcion-info.css">
    <link rel="stylesheet" href="../assets/css/info/info.css">
    <link rel="stylesheet" href="../assets/css/info/titulo-info.css">
    <link rel="stylesheet" href="../assets/css/recetas/boton-receta.css">
    <link rel="stylesheet" href="../assets/css/recetas/contenido-receta.css">
    <link rel="stylesheet" href="../assets/css/recetas/descripcion-receta.css">
    <link rel="stylesheet" href="../assets/css/recetas/imagen-receta.css">
    <link rel="stylesheet" href="../assets/css/recetas/receta.css">
    <link rel="stylesheet" href="../assets/css/recetas/titulo-receta.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/somos-descripcion.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/somos-titulo.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/somos.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/persona-imagen.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/persona-nombre.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/persona-ocupacion.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/persona.css">
    <link rel="stylesheet" href="../assets/css/quienes-somos/personas.css">
    <link rel="stylesheet" href="../assets/css/footer/descripcion-footer.css">
    <link rel="stylesheet" href="../assets/css/footer/icono-footer.css">
    <link rel="stylesheet" href="../assets/css/footer/item-footer.css">
    <link rel="stylesheet" href="../assets/css/footer/titulo-footer.css">
    <link rel="stylesheet" href="../assets/css/footer/footer.css">
    <link rel="stylesheet" href="../assets/css/formularios/formularios.css">
    <link rel="stylesheet" href="../assets/css/formularios/administracion.css">
</head>
<body>
<header class="header">
    <img class="logo" src="./assets/img/recipes-icon.png" alt="">
    <nav>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="../index.html">Inicio</a></li>
            <li class="menu__item"><a class="menu__link" href="../mision-y-vision.html">Misión y Visión</a></li>
            <li class="menu__item"><a class="menu__link" href="../productos.html">Productos</a></li>
            <li class="menu__item"><a class="menu__link" href="../historia.html">Historia</a></li>
            <li class="menu__item"><a class="menu__link" href="../contactenos.html">Contáctenos</a></li>
            <li class="menu__item"><a class="menu__link" href="../inicio-sesion.html">Inicio de Sesión</a></li>
        </ul>
    </nav>
</header>
         <h2 class="info__titulo">Módulo de administración</h2>
         <p class="parrafo__administracion">Utilice actualizar o borrar para modificar los datos de los clientes</p>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
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
    </tbody>
</table>

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
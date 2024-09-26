<?php

session_start();

// Verificamos si el usuario está autenticado, si no lo redirigimos a la página de inicio de sesión
if (!isset($_SESSION['isLogin']) || $_SESSION ['isLogin'] != true) {
    header('location:login.php');
    exit;
}

if (!isset($_SESSION['info']['Rol']) || $_SESSION['info']['Rol'] != 1) {
  echo "No puedes acceder a está página.";
  header('location: ../index.php');
  exit;
}

// Incluimos el archivo de conexión a la base de datos
include("../backend/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membresías</title>
    <link rel="stylesheet" href="css/lista.css">
    <link rel="icon" type="icon" href="imagenes/logoo.jpg">
    <link rel="stylesheet" href="./style-admin.css">
    <style>
        .content {
            margin-top: 80px;
        }
    </style>
</head>
<body>
<header>
        <h1>Listado de Membresias</h1>
        <h3>Bienvenido <?= ucfirst($_SESSION['info']['Nombre']); ?>, Puedes validar y editar la información de las Membresias registradas.</h3>
        <ul style="list-style: none; display: flex; flex-direction: column; gap: 1rem;">
            <a style='color: black; font-family: system-ui; font-weight: 600; text-decoration: none;' href="../formularios/formulario-membresias.php">Registrar una nueva membresia.</a>
            <a style='color: black; font-family: system-ui; font-weight: 600; text-decoration: none;' href="./pagina-admin.php">Volver a la página principal.</a>
        </ul>
    </header>
    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">

        <?php if (isset($_GET['idpost'])){
            include('nav.php');} ?>
    </nav>
    <section class="seccion-2">
    <main>
    <div class="container">
        <div class="content">
            <br />
            <div align="center" class="table-responsive">
                <table align="center" border="1px" class="table table-striped table-hover" style="width: 90%; border-collapse: collapse; border: 2px solid black; text-align: center;">
                    <tr style="padding: 5px;">
                        <th class="th1">Posición</th>
                        <th class="th1">Codigo de la Membresia</th>
                        <th class="th1">Nombre de la Membresia</th>
                        <th class="th1">Meses de Validez</th>
                        <th class="th1">Precio</th>
                        <th class="th1">Descripción de la Membresia</th>
                        <th class="th1">Acciones</th>
                    </tr>
                    <?php
                    // Obtenemos la lista de usuarios de la base de datos
                    $sql = mysqli_query($conexion, "SELECT * FROM membresias");
                    if (mysqli_num_rows($sql) == 0) {
                        echo '<tr><td colspan="8">No hay datos.</td></tr>';
                    } else {
                        $no = 1;
                        // Iteramos sobre cada usuario y mostramos su información en la tabla
                        while ($row = mysqli_fetch_assoc($sql)) {
                            echo '
                            <tr class="tr1">
                                <td>'.$no.'</td>
                                <td>'.$row['CodigoMembresia'].'</td>
                                <td>'.$row['NombreMembresia'].'</td>
                                <td>'.$row['MesesValidezMembresia'].'</td>
                                <td>'.$row['PrecioMembresia'].'</td>
                                <td>'.$row['DescripcionMembresia'].'</td>
                                <td style="display: flex; flex-direction: column; gap: 1rem; padding: 5px;">
                                  <a style="text-decoration: none; color: green;" href="editar-membresias.php?id='.$row['CodigoMembresia'].'">Editar</a>
                                  <a style="text-decoration: none; color: tomato;" href="eliminar-membresia.php?id='.$row['CodigoMembresia'].'">Eliminar</a>
                                </td>
                                </tr>
                                ';
                            $no++;  
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    </main>
</body>
</html>

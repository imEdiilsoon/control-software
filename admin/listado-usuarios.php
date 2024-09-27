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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de usuarios</title>
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
        <h1>Listado de Usuarios</h1>
        <h3>Bienvenido <?= ucfirst($_SESSION['info']['Nombre']); ?>, Puedes validar y editar la información de los usuarios registrados.</h3>
        
    </header>
    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">

        <?php if (isset($_GET['idpost'])){
            include('nav.php');} ?>
    </nav>
    <section class="seccion-2">

    </section>
    <div class="container">
        <div class="content">
            <br />
            <div align="center" class="table-responsive">
                <table align="center" border="1px" class="table table-striped table-hover" style="width: 90%; border-collapse: collapse; border: 2px solid black; text-align: center;">
                    <tr style="padding: 5px;">
                        <th class="th1">Posición</th>
                        <th class="th1">Cedula</th>
                        <th class="th1">Nombre de usuario</th>
                        <th class="th1">Sexo</th>
                        <th class="th1">Numero de Telefono</th>
                        <th class="th1">Correo</th>
                        <th class="th1">Membresia</th>
                        <th class="th1">Peso</th>
                        <th class="th1">Altura</th>
                        <th class="th1">Acción</th>
                    </tr>
                    <?php
                    // Obtenemos la lista de usuarios de la base de datos
                    $sql = mysqli_query($conexion, "SELECT * FROM usuarios");
                    if (mysqli_num_rows($sql) == 0) {
                        echo '<tr><td colspan="8">No hay datos.</td></tr>';
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $cedula = $row['Cedula'];
                            $membresia = mysqli_query($conexion, "SELECT membresias.NombreMembresia 
                                                                  FROM membresia_usuario 
                                                                  INNER JOIN usuarios ON membresia_usuario.CedulaUsuario = usuarios.Cedula 
                                                                  INNER JOIN membresias ON membresia_usuario.CodigoMembresia = membresias.CodigoMembresia 
                                                                  WHERE usuarios.Cedula = '$cedula';"
                                                                  );

                            if(mysqli_num_rows($membresia) == 0) {
                                $resultado = "No tiene Membresia.";
                            } else {
                                $resultado = mysqli_fetch_assoc($membresia);
                                $resultado = $resultado['NombreMembresia'];
                            }

                            if($row['Sexo'] == "F") {
                              $sexo = 'Femenino';
                            } elseif($row['Sexo'] == "M") {
                              $sexo = 'Masculino';
                            }
                            
                            echo '
                            <tr class="tr1">
                                <td>'.$no.'</td>
                                <td>'.$row['Cedula'].'</td>
                                <td>'.$row['Nombre'].'</td>
                                <td>'.$sexo.'</td>
                                <td>'.$row['NumeroTelefono'].'</td>
                                <td>'.$row['Correo'].'</td>
                                <td>'.$resultado.'</td>
                                <td>'.$row['Peso'].' kg.</td>
                                <td>'.$row['Altura'].' cm.</td>
                                <td style="display: flex; flex-direction: column; gap: 1rem; padding: 5px;">
                                  <a style="text-decoration: none; color: green;" href="editar-usuario.php?id='.$row['Cedula'].'">Editar</a>
                                  <a style="text-decoration: none; color: tomato;" href="eliminar-usuario.php?id='.$row['Cedula'].'">Eliminar</a>
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
    </body>
    </html>
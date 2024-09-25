<?php

  session_start();
  include("../backend/conexion.php");

  if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin']) {
  	header('location: index.php');
  	exit;
  }

  if (!isset($_SESSION['info']['Rol']) || $_SESSION['info']['Rol'] != 1) {
    echo "No puedes acceder a está página.";
    header('location: ../index.php');
    exit;
  }

  $id_membresia = $_GET['id'];

  $consulta = mysqli_query($conexion, "SELECT * FROM membresias WHERE CodigoMembresia='$id_membresia'");
  if (mysqli_num_rows($consulta) == 0) {
      echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
  } else {
      // Eliminamos el usuario de la base de datos
      $delete = mysqli_query($conexion, "DELETE FROM membresias WHERE CodigoMembresia='$id_membresia'");
      if ($delete) {
        header("location: membresia.php");
        echo '<div> Datos eliminados correctamente.</div>';
      } else {
        echo '<div> Error, no se pudo eliminar los datos.</div>';
      }
  }
?>
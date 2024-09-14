<?php

  $database = "localhost";
  $databaseUser = "root";
  $databasePassword = "";
  $databaseName = "control_software";

  $conexion = mysqli_connect($database, $databaseUser, $databasePassword, $databaseName);
  mysqli_set_charset($conexion, "utf8mb4");

  if(mysqli_connect_errno()){
    echo 'Error al conectar con la Base de Datos.';
  }

?>
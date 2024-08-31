<?php

  $database = "localhost";
  $databaseUser = "root";
  $databasePassword = "";
  $databaseName = "control_software";

  $conexion = mysqli_connect($database, $databaseUser, $databasePassword, $databaseName);

  if(mysqli_connect_errno()){
    echo 'Error al conectar con la Base de Datos.';
  }

?>
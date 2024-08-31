<?php
  require('../conexion.php');

  session_start();

  $usuario = $_POST['correo'];
  $contraseña = $_POST['contraseña'];

  //echo $usuario;
  //echo $contraseña;

  if (!filter_var($usuario, FILTER_VALIDATE_EMAIL)) {
    echo "El Email no es valido!";
    header('location: ../../index.php');
    exit();
  }

  // Validamos contraseña
  if(strlen($contraseña) == 0) {
    echo "La contraseña no es valida";
    header('location: ../../index.php');
    exit();
  }

  $consultaIniciarSesion = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo = '$usuario'");

  if(mysqli_num_rows($consultaIniciarSesion) == 1) {
    $datos = mysqli_fetch_assoc($consultaIniciarSesion);
    $contraseña_encriptada = $datos['Contraseña'];

    if(password_verify($contraseña, $contraseña_encriptada)) {
      //echo "Contraseña correcta.";
      unset($datos['Contraseña']);
      $_SESSION['isLogin'] = true;
      $_SESSION['info'] = $datos;
      header('location: ../../usuarios.php');
    } else {
      echo "Contraseña Incorrecta.";
    }
  } else {
    echo "Email Incorrecto";
  }
?>
<?php
  require('../backend/conexion.php');

  session_start();

  $usuario_admin = $_POST['correo_admin'];
  $contraseña_admin = $_POST['contraseña_admin'];

  //echo $usuario_admin;
  //echo $contraseña_admin;
  //exit;

  if (!filter_var($usuario_admin, FILTER_VALIDATE_EMAIL)) {
    echo "El Email no es valido!";
    header('location: ../index.php');
    exit();
  }

  // Validamos contraseña
  if(strlen($contraseña_admin) == 0) {
    echo "La contraseña no es valida";
    header('location: ../index.php');
    exit();
  }

  $consultaIniciarSesion = mysqli_query($conexion, "SELECT * FROM administrador WHERE Correo = '$usuario_admin'");

  if(mysqli_num_rows($consultaIniciarSesion) == 1) {
    $datos = mysqli_fetch_assoc($consultaIniciarSesion);
    $contraseña_encriptada = $datos['Contraseña'];

    if(password_verify($contraseña_admin, $contraseña_encriptada)) {
      //echo "Contraseña correcta.";
      unset($datos['Contraseña']);
      $_SESSION['isLogin'] = true;
      $_SESSION['info'] = $datos;
      header('location: pagina-admin.php');
    } else {
      echo "Contraseña Incorrecta.";
    }
  } else {
    echo "Email Incorrecto";
    //header('location: ../index.php');
    //exit();
  }
?>
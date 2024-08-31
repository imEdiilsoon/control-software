<?php

  session_start();

  if(isset($_SESSION['info']) && isset($_SESSION['isLogin'])) {
    unset($_SESSION['info']);
    $_SESSION['isLogin'] = false;
    header('location: ../../index.php');
  } else {
    $error = "No has iniciado sesión";
    $_SESSION['error_msg'] = $error;
    header('location: ../../index.php');
  }
  
?>
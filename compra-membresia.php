<?php
date_default_timezone_set('America/Bogota');

$id_membresia = $_GET['id'];

// -------------------------------------------------------------------------------------------------------------------
// Lógica para calcular el tiempo de validez de la membresia.
$fecha_compra = date("Y-m-d H:i:s");
// Creamos una variable de tipo objeto DateTime, si no le pasamos parámetros quiere decir que la fecha actual es hoy
$fecha_actual = date_create();
/* Añadimos el intervalo de tiempo que necesitamos. Esto se hace con el ID de la membresia ya que está contiene los meses que es valida está misma.
*/
date_add($fecha_actual, date_interval_create_from_date_string('' . $id_membresia . ' months'));
// Luego, imprimimos en el formato deseado que necesitemos
// Y-m-d H:i:s = Year-month-day Hour:m(i)nutes:seconds
// Y-m-d = Year-month-day
$fecha_fin = date_format($fecha_actual, "Y-m-d H:i:s");
//echo $fecha_fin;
//echo $fecha_compra;
//exit;
// -------------------------------------------------------------------------------------------------------------------

session_start();
include("./backend/conexion.php");

if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin']) {
  header('location: index.php');
  exit;
}

$cedula = $_SESSION['info']['Cedula'];

$id = $_SESSION['info']['Cedula'];
//echo $id;
//exit();
$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Cedula='$id'");
if (mysqli_num_rows($consulta) == 0) {
  header("location: mi_perfil.php");
} else {
  $datos = mysqli_fetch_assoc($consulta);
}

if (isset($_POST['comprar'])) {
  $agg_membresia = mysqli_query($conexion, "INSERT INTO membresia_usuario(CedulaUsuario, CodigoMembresia, FechaInicio, FechaFin)
        VALUES('$cedula', '$id_membresia', '$fecha_compra', '$fecha_fin')") or die(mysqli_error($conexion));
  if ($agg_membresia) {
    header("location: ./usuarios.php");
    echo '<div class="notificacion-exito"><p>La información se edito correctamente.</p></div>';
  } else {
    echo '<div class="notificacion-error"><p>Error. No se registrar está compra.</p></div>';
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compra de Membresia - Confirma el perfil.</title>
  <style>
    /* Estilos generales para el cuerpo */
    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-top: 20px;
      background-color: #f0f0f0;
    }

    /* Estilos para el contenedor del perfil */
    .profile-container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      text-align: center;
      position: relative;
    }

    /* Estilos para la imagen de perfil */
    .profile-container img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      cursor: pointer;
      transition: transform 0.3s;
    }

    .profile-container img:hover {
      transform: scale(1.1);
    }

    /* Estilos para el título del perfil */
    .profile-container h2 {
      margin: 10px 0;
      font-size: 24px;
    }

    /* Estilos para los párrafos del perfil */
    .profile-container p {
      margin: 5px 0;
      color: #666;
    }

    /* Ocultar el input de tipo file */
    .profile-container input[type="file"] {
      display: none;
    }

    /* Estilos para el botón de editar */
    .edit-button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .edit-button:hover {
      background-color: #0056b3;
    }

    /* Estilos para el formulario de edición */
    .edit-form {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: left;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    h2 {
      text-align: center;
    }

    .edit-form input,
    .edit-form select {
      width: calc(100% - 20px);
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .edit-form button {
      width: 100%;
      padding: 10px;
      background-color: #28a745;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .edit-form button:hover {
      background-color: #218838;
    }

    /* Estilos para el contenedor de la contraseña */
    .password-container {
      position: relative;
      width: 100%;
      /* Ajusta el ancho aquí */
      margin: 5px 0;
    }

    .password-container input {
      width: 100%;
      padding-right: 40px;
      box-sizing: border-box;
    }

    .password-container .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }

    /* Estilos para las ventanas modales */
    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0, 0, 0, 0.8);
      color: #fff;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      z-index: 1000;
    }

    .modal img {
      width: 60px;
      height: 60px;
      margin-bottom: 10px;
    }

    /* Estilos para el ícono de retroceso */
    .back-button {
      position: absolute;
      top: 10px;
      left: 5px;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }

    .back-button img {
      width: 20px;
      height: 20px;
      filter: brightness(0);
      /* Hace la imagen negra */
    }

    .back-button {
      background-color: #007bff;
      padding: 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin: 5px;
    }
  </style>
</head>

<body>
  <div class="edit-form" id="editForm">
    <h2>Confirma tú Información</h2>
    <form action="" method="post">
      <label for="cedula">Número de Cedula:</label>
      <input disabled type="number" id="cedula" name="cedula" value="<?php echo $datos['Cedula']; ?>">
      <label for="email">Correo:</label>
      <input disabled type="email" id="email" name="email" value="<?php echo $datos['Correo']; ?>">
      <button style="margin-top: 10px;" name="comprar" type="submit">Confirmar Compra</button>
      <a style="margin-top: 20px; text-decoration: none; display: flex; align-items: center; justify-content: center; color: gray; font-family: monospace; text-align: center; font-size: 16px" href="./planes.php">Cancelar</a>
      <hr>
      <p style="color: gray; font-family: monospace; text-align: center; font-size: 14px">En caso de no coincidir tú información, envía un correo a: soporte@control.com</p>
    </form>
  </div>
  </div>
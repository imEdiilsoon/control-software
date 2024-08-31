<?php 
  $id_usuario = $_GET['id'];

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

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar perfil de un usuario.</title>
  <style>
    /* Estilos generales para el cuerpo */
    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
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
      display: none;
      margin-top: 20px;
      text-align: left;
    }
    .edit-form input, .edit-form select {
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
      width: 100%; /* Ajusta el ancho aquí */
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
      filter: brightness(0); /* Hace la imagen negra */
    }
    .back-button{
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
  <?php 
    $id = $_SESSION['info']['Cedula'];
    //echo $id;
    //exit();
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Cedula='$id_usuario'");
    if(mysqli_num_rows($consulta) == 0) {
      header("location: listado_usuarios.php");
    } else {
      $datos = mysqli_fetch_assoc($consulta);
    }

    if(isset($_POST['actualizar'])){
			$nombre		     = mysqli_real_escape_string($conexion,(strip_tags($_POST["nombre"],ENT_QUOTES)));
			$num_telefono	 = mysqli_real_escape_string($conexion,(strip_tags($_POST["telefono"],ENT_QUOTES)));
			$sexo	 = mysqli_real_escape_string($conexion,(strip_tags($_POST["sexo"],ENT_QUOTES)));
			$peso	     = mysqli_real_escape_string($conexion,(strip_tags($_POST["peso"],ENT_QUOTES)));
			$altura		 = mysqli_real_escape_string($conexion,(strip_tags($_POST["altura"],ENT_QUOTES)));

      $actualizar = mysqli_query($conexion, "UPDATE usuarios SET Nombre='$nombre', Sexo='$sexo', NumeroTelefono='$num_telefono', Peso='$peso', Altura='$altura' WHERE Cedula='$id_usuario'") or die();
      if($actualizar){
        header("location: listado-usuarios.php");
        echo '<div class="notificacion-exito"><p>La información se edito correctamente.</p></div>';
      } else{
        echo '<div class="notificacion-error"><p>Error. No se pudo editar la información.</p></div>';
      }
    }

  ?>

  <div class="profile-container">
    <button class="back-button" onclick="goBack()">
        <img src="https://www.hlsholding.com/image/undo.png" alt="Retroceder">
    </button>
    <img src="../img/dafault.png" alt="Imagen de Perfil" id="profileImage">
    <input type="file" id="imageUpload" onchange="uploadProfileImage(event)">
    <h2><b><?= ucfirst($datos['Nombre']); ?></b></h2>
    <p><b>Correo:</b> <?= $datos['Correo']; ?></p>
    <p><b>Numero de Telefono:</b> <?= ucfirst($datos['NumeroTelefono']); ?></p>
    <p>
      <b>Sexo:</b> <?php 
      if($datos['Sexo'] == "M"){
        echo "Masculino.";
      }   elseif($datos['Sexo'] == "F")  {
        echo "Femenino.";
      }; ?>
    </p>
    <p><b>Peso:</b> <?= ucfirst($datos['Peso']); ?> Kg.</p>
    <p><b>Altura:</b> <?= ucfirst($datos['Altura']); ?> Cm.</p>
    <button class="edit-button" onclick="toggleEditForm()">Editar Perfil</button>
    <div class="edit-form" id="editForm">
      <h3>Editar Información</h3>
      <form action="" method="post">
        <label for="Cedula">Número de Cedula:</label>
        <input disabled type="number" id="Cedula" name="cedula" value="<?php echo $datos ['Cedula']; ?>">
        <label for="Name">Nombre:</label>
        <input type="text" id="Name" name="nombre" value="<?php echo $datos ['Nombre']; ?>">
        <label for="NumTelefono">Número de Telefono:</label>
        <input type="text" id="NumTelefono" name="telefono" value="<?php echo $datos ['NumeroTelefono']; ?>">
        <div class="mb-3">
          <label for="sexo" class="form-label">Sexo:</label>
          <select class="form-select" id="sexo" name="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
          </select>
        </div>
        <label for="email">Correo:</label>
        <input disabled type="email" id="email" name="email" value="<?php echo $datos ['Correo']; ?>">
        <label for="weight">Peso en KG:</label>
        <input type="number" id="weight" name="peso" value="<?php echo $datos ['Peso']; ?>">
        <label for="altura">Altura:</label>
        <input type="tel" id="altura" name="altura" value="<?php echo $datos ['Altura']; ?>">
        <button name="actualizar" type="submit">Guardar Cambios</button>
      </form>
    </div>
  </div>

  <div class="modal" id="loadingModal">Cargando...</div>
  <div class="modal" id="successModal">
    <img src="img/verificado.png" alt="Éxito">
    <p>¡Cambios guardados correctamente!</p>
  </div>

  <script>
    // Función para retroceder
    function goBack() {
      window.history.back();
    }
    // Evento para abrir el selector de archivos al hacer clic en la imagen de perfil
      document.getElementById('profileImage').addEventListener('click', function() {
      document.getElementById('imageUpload').click();
    });

    // Función para subir la imagen de perfil al servidor
    function uploadProfileImage(event) {
      const file = event.target.files[0];
      const formData = new FormData();
      formData.append('image', file);

      fetch('/upload-profile-image', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const img = document.getElementById('profileImage');
          img.src = data.imageUrl; // Actualiza la imagen con la URL devuelta por el servidor
          console.log('Imagen actualizada:', data.imageUrl);
        } else {
          console.error('Error en la respuesta del servidor:', data.message);
        }
      })
      .catch(error => {
        console.error('Error al subir la imagen:', error);
      });
    }

    // Función para mostrar/ocultar el formulario de edición y mostrar la ventana de carga
    function toggleEditForm() {
      const form = document.getElementById('editForm');
      const loadingModal = document.getElementById('loadingModal');
      form.style.display = form.style.display === 'none' ? 'block' : 'none';
      loadingModal.style.display = 'block';
      setTimeout(() => {
        loadingModal.style.display = 'none';
      }, 2000);
    }

    // Función para mostrar/ocultar la contraseña
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const passwordIcon = document.querySelector('.toggle-password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.textContent = '🙈';
      } else {
        passwordInput.type = 'password';
        passwordIcon.textContent = '👁️';
      }
    }

    // Función para mostrar la ventana de confirmación al guardar cambios
    function saveChanges() {
      const successModal = document.getElementById('successModal');
      successModal.style.display = 'block';
      setTimeout(() => {
        successModal.style.display = 'none';
      }, 2000);
    }
  </script>
</body>
</html>
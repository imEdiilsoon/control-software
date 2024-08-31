<?php
  session_start();
  include("../backend/conexion.php");

  if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin']) {
    header('location: ../index.php');
    exit;
  }

  // Crear validación. Si no es administrador no puede ingresar acá. (Listo)
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
    <title>Registro de Administradores</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    if (isset($_POST['crear'])) {
      $cedula = mysqli_real_escape_string($conexion, (strip_tags($_POST["cedula"], ENT_QUOTES)));
      $usuario = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
      $numero = mysqli_real_escape_string($conexion, (strip_tags($_POST["telefono"], ENT_QUOTES)));
      $rol = mysqli_real_escape_string($conexion, (strip_tags($_POST["rol"], ENT_QUOTES)));
      $email = mysqli_real_escape_string($conexion, (strip_tags($_POST["correo"], ENT_QUOTES))); 
      $password = mysqli_real_escape_string($conexion, (strip_tags($_POST["contraseña"], ENT_QUOTES)));
      $password_encriptada = password_hash($password, PASSWORD_BCRYPT); 
  
      $resultados = mysqli_query($conexion, "SELECT * FROM administrador WHERE correo='$email'");
      if (mysqli_num_rows($resultados) == 0) {
        $insert = mysqli_query($conexion, "INSERT INTO administrador(Cedula, Nombre, Correo, Contraseña, NumeroTelefono, Rol)
          VALUES('$cedula', '$usuario', '$email', '$password_encriptada', '$numero', '$rol')") or die();
        if ($insert) {
          header('location: ../admin/pagina-admin.php');
          echo '<div class="notificacion-exito"><p>Registrado con exito.</p></div>';
        } else {
          echo '<div class="notificacion-error"><p>Error al registrar el administrador.</p></div>';
        }
      } else {
        echo '<div class="notificacion-error"><p>Error. El correo ya existe.</p></div>';
      }
    }
    ?>

    <div class="container mt-5">
        <h2>Registrar un Administrador</h2>
        <form action="" method="POST" id="usuarioForm">
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="number" class="form-control" id="cedula" name="cedula" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Número de Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="1">Administrador</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <div class="password-container">
                  <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                  <button type="button" style="cursor: pointer; margin-top: 10px; border-radius: 10px; border: none;" class="toggle-password" onclick="togglePasswordVisibility()">👁️ Mostrar Contraseña</button>
                </div>
            </div>
            <div class="botones">
              <button name="crear" type="submit" class="btn btn-primary">Registrar Administrador</button>
              <hr>
              <a class="btn btn-secundary" href="../admin/pagina-admin.php">Regresar al panel Administrativo.</a>
            </div>
        </form>
    </div>
</body>
</html>

<script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('contraseña');
      const passwordIcon = document.querySelector('.toggle-password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.textContent = '🙈 Ocultar Contraseña';
      } else {
        passwordInput.type = 'password';
        passwordIcon.textContent = '👁️ Mostrar Contraseña';
      }
    }
</script>

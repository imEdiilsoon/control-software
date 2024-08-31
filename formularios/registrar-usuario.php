<?php
  include("../backend/conexion.php");

  session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    if (isset($_POST['crear'])) {
      $cedula = mysqli_real_escape_string($conexion, (strip_tags($_POST["cedula"], ENT_QUOTES)));
      $usuario = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
      $sexo = mysqli_real_escape_string($conexion, (strip_tags($_POST["sexo"], ENT_QUOTES)));
      $numero = mysqli_real_escape_string($conexion, (strip_tags($_POST["telefono"], ENT_QUOTES)));
      $email = mysqli_real_escape_string($conexion, (strip_tags($_POST["correo"], ENT_QUOTES))); 
      $password = mysqli_real_escape_string($conexion, (strip_tags($_POST["contraseña"], ENT_QUOTES)));
      $peso = mysqli_real_escape_string($conexion, (strip_tags($_POST["peso"], ENT_QUOTES)));
      $altura = mysqli_real_escape_string($conexion, (strip_tags($_POST["altura"], ENT_QUOTES)));
      $password_encriptada = password_hash($password, PASSWORD_BCRYPT); 
  
      $resultados = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$email'");
      if (mysqli_num_rows($resultados) == 0) {
        $insert = mysqli_query($conexion, "INSERT INTO usuarios(Cedula, Nombre, Sexo, NumeroTelefono, Correo, Contraseña, Peso, Altura)
          VALUES('$cedula', '$usuario', '$sexo', '$numero', '$email', '$password_encriptada', '$peso', '$altura')") or die();
        if ($insert) {
          header('location: ../index.php');
          echo '<div class="notificacion-exito"><p>Registrado con exito.</p></div>';
        } else {
          echo '<div class="notificacion-error"><p>Error al registrar el usuario.</p></div>';
        }
      } else {
        echo '<div class="notificacion-error"><p>Error. El correo ya existe.</p></div>';
      }
    }
    ?>

    <div class="container mt-5">
        <h2>Registro de Usuario</h2>
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
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Número de Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
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
            <div class="mb-3">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="number" step="0.01" class="form-control" id="peso" name="peso">
            </div>
            <div class="mb-3">
                <label for="altura" class="form-label">Altura (cm)</label>
                <input type="number" step="0.01" class="form-control" id="altura" name="altura">
            </div>
            <div class="botones">
              <button name="crear" type="submit" class="btn btn-primary">Registrarse</button>
              <hr>
              <a class="btn btn-secundary" href="../index.php">¿Ya tienes cuenta? Inicia Sesión.</a>
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./formularios/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Inicio de Sesión</h2>
        <form action="./backend/login/verificar-usuario.php" method="POST" id="loginForm">
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
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                <hr>
                <a class="btn btn-secundary" href="./formularios/registrar-usuario.php">¿No tienes una cuenta?, Registrate.</a>
            </div>
            <div>
                <hr>
            </div>
            <div style="display: flex; justify-content: center;">
                <a class="btn btn-secundary" href="./admin/login-admin.php">Panel Administrativo.</a>
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
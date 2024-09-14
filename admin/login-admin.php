<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../formularios/styles.css">
</head>
<body>
    <style>
        img{
    width: 70px;
    height: 70px;
    border-radius: 50%;
}
    </style>
    <div class="container mt-5">
        <h2>INICIAR SESION - ADMINISTRADOR</h2>
        <img src="../img/logo.jpg" alt="">
        <br>
        <form action="./verificar-admin.php" method="POST">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo_admin" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <div class="password-container">
                    <input type="password" class="form-control" id="contraseña" name="contraseña_admin" required>
                    <button type="button" style="cursor: pointer; margin-top: 10px; border-radius: 10px; border: none;" class="toggle-password" onclick="togglePasswordVisibility()">👁️ </button>
                </div>
            </div>
            <div class="botones">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
            <div>
                <hr>
            </div>
            <div style="display: flex; justify-content: center;">
                <a class="btn btn-secundary" href="../index.php">Entrar como Usuario.</a>
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
        passwordIcon.textContent = '🙈 ';
      } else {
        passwordInput.type = 'password';
        passwordIcon.textContent = '👁️ ';
      }
    }
</script>
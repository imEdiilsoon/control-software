<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <style>
        body {    
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333333;
}

.form-label {
    font-weight: bold;
    color: #555555;
}

.form-control {
    border-radius: 5px;
    margin-bottom: 15px;
}

.password-container {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    color: #007bff;
}

.btn-primary {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-secundary {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    background-color: #6c757d;
    border: none;
    color: white;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}
img{
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

.btn-secundary:hover {
    background-color: #5a6268;
}

    </style>
    <div class="container mt-5">
        <h2>INICIO DE SESION</h2>
        <img src="img/logo.jpg" alt="">
        <br>
        <form action="./backend/login/verificar-usuario.php" method="POST" id="loginForm">
            <div class="mb-3">
                <label for="correo" class="form-label">Usuario</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <div class="password-container">
                    <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">👁️ </button>
                </div>
            </div>
            <div class="botones">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                <hr>
                <a class="btn btn-secundary" href="./formularios/registrar-usuario.php">¿No tienes una cuenta? Regístrate.</a>
            </div>
            <div>
                <hr>
            </div>
            <div style="display: flex; justify-content: center;">
                <a class="btn btn-secundary" href="./admin/login-admin.php">Panel Administrativo.</a>
            </div>
        </form>
    </div>
    <script>
        function togglePasswordVisibility() {
    var passwordField = document.getElementById('contraseña');
    var toggleButton = document.querySelector('.toggle-password');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleButton.textContent = '🙈 ';
    } else {
        passwordField.type = 'password';
        toggleButton.textContent = '👁️ ';
    }
}
    </script>
</body>
</html>

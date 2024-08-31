<?php

session_start();

if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin']) {
	header('location: index.php');
	exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil Usuario: <?= ucfirst($_SESSION['info']['Nombre']); ?></title>
  <link rel="stylesheet" href="./style-user.css">
  <style>
    .grid-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px;
    }
    .grid-item {
      width: 150px;
      height: 200px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border: 1px solid #ccc;
      border-radius: 10px;
      cursor: pointer;
      transition: transform 0.3s, background-color 0.3s, box-shadow 0.3s;
      text-align: center;
    }
    .grid-item:hover {
      transform: scale(1.05);
      background-color: #0077cc;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .grid-item img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
    .grid-item h3 {
      margin: 0;
      padding: 5px 0;
      font-size: 16px;
    }

</style>
</head>
<body>
  <header>
    <h1>Bienvenido, <b><?= ucfirst($_SESSION['info']['Nombre']); ?></b></h1>
  </header>
  <main>
    <div class="grid-container">
      <div class="grid-item add-category" onclick="navigateTo('mi_perfil.php')">
        <h3>Mi perfil</h3>
        <p><img src="img/dafault.png" alt="Mi perfil" id="profileImage"></p>
        <input type="file" id="imageUpload" style="display: none;" onchange="changeProfileImage(event)">
      </div>
      <div class="grid-item add-category" onclick="navigateTo('EditarMembresia.html')">
        <h3>Mi membresía</h3>
        <p><img src="img/membresia.png" alt="Mi membresía"></p>
      </div>
      <div class="grid-item add-category" onclick="navigateTo('entrenadores.html')">
        <h3>Entrenadores</h3>
        <p><img src="img/gym.png" alt="Entrenadores"></p>
      </div>
      <div class="grid-item add-category" onclick="navigateTo('rutina.html')">
        <h3>Generar rutina</h3>
        <p><img src="img/rutinas.jpeg" alt="Generar rutina"></p>
      </div>
      <div class="grid-item add-category" onclick="navigateTo('productos.html')">
        <h3>Productos</h3>
        <p><img src="img/productos.png" alt="Productos"></p>
      </div>
      <div class="grid-item add-category" onclick="navigateTo('./backend/login/cerrar-sesion.php')">
        <h3>Cerrar Sesión</h3>
        <p><img src="img/cerrar-sesion.jpg" alt="Cerrar Sesion"></p>
      </div>
    </div>
  </main>

  <script>
    // Función para retroceder
    function goBack() {
      window.history.back();
    }
    
    function navigateTo(page) {
      window.location.href = page;
    }

    document.getElementById('profileImage').addEventListener('click', function() {
      document.getElementById('imageUpload').click();
    });

    function changeProfileImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        const img = document.getElementById('profileImage');
        img.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
   // JavaScript para manejar el evento de clic y alternar el contenido oculto
document.getElementById('avatar').addEventListener('click', function() {
  var hiddenContent = document.getElementById('hiddenContent');
  if (hiddenContent.style.display === 'none') {
    hiddenContent.style.display = 'block';
  } else {
    hiddenContent.style.display = 'none';
  }
});
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

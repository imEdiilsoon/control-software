<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generación de informes</title>
  <link rel="stylesheet" href="./style-admin.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>  
  .grid-item {
   
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 10px;
    cursor: pointer;
    transition: transform 0.3s, background-color 0.3s, box-shadow 0.3s;
    text-align: center;
  }
  .grid-item:hover {
    transform: scale(1.05);
    
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

  a {
      text-decoration: none;
      color: black;
  }
</style>
<body>
  <header>
    <h1>Generación de Informes</h1>
    <h3>Aquí podrás generar informes para evaluar posibles mejoras en el servicio.</h3>
  </header>
  <main>
    <div class="grid-container" id="grid-container">
      <a href="./informes/informe_membresia.php" class="grid-item items-click">
        <h3>MEMBRESIAS MÁS COMPRADAS.</h3>
        <p><img src="../img/membresia.png" alt="img_user"></p>
      </a>
      <a href="./informes/informe_objetivo.php" class="grid-item items-click">
        <h3>OBJETIVO DE ENTRENAMIENTO MÁS GENERADO.</h3>
        <p><img src="../img/avatar.jpeg" alt="img_user"></p>
      </a>
    </div>  
  </main>
</body>
</html>
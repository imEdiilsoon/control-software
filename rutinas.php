<?php

session_start();
include("./backend/conexion.php");

if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin']) {
  header('location: index.php');
  exit;
}

$resultado = false;

if (isset($_POST['generar'])) {
  $edad = mysqli_real_escape_string($conexion, (strip_tags($_POST["age"], ENT_QUOTES)));
  $peso = mysqli_real_escape_string($conexion, (strip_tags($_POST["weight"], ENT_QUOTES)));
  $estatura = mysqli_real_escape_string($conexion, (strip_tags($_POST["height"], ENT_QUOTES)));
  $objetivo = mysqli_real_escape_string($conexion, (strip_tags($_POST["goal"], ENT_QUOTES)));

  $resultados = mysqli_query($conexion, "SELECT * FROM rutinas WHERE razon='$objetivo' ORDER BY rand() LIMIT 1");
  if (mysqli_num_rows($resultados) != 0) {
    $datos = mysqli_fetch_assoc($resultados);
    $resultado = true;
  } else {
    echo 'error, no funciono.';
  }

  $agg_registro = mysqli_query($conexion, "INSERT INTO objetivos_generados(objetivo, generacion)
    VALUES('$objetivo', '1')") or die(mysqli_error($conexion));
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generador de Rutinas</title>
</head>

<body>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #0077cc;
      color: #fff;
      padding: 1rem 0;
      text-align: center;
    }

    #routine-generator,
    #nutrition-recommendations,
    #progress-tracking {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 2rem;
    }

    form {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      width: 300px;
      display: flex;
      flex-direction: column;
      margin-bottom: 2rem;
    }

    label {
      margin-top: 1rem;
    }

    input,
    select,
    textarea,
    button {
      margin-top: 0.5rem;
      padding: 0.5rem;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #28a745;
      color: #fff;
      cursor: pointer;
      margin-top: 1rem;
    }

    button:hover {
      background-color: #218838;
    }

    #routine-result,
    #nutrition-result,
    #progress-result {
      margin-top: 2rem;
      width: 100%;
      max-width: 600px;
      text-align: center;
    }

    #resultado {
      text-align: center;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      width: 500px;
      display: flex;
      flex-direction: column;
      margin-bottom: 2rem;
    }
  </style>
  <header>
    <h1>Generador de Rutinas Personalizadas</h1>
    <a style="color: black; text-decoration: none; font-family: system-ui; font-weight: 600;" href="./usuarios.php">Volver a la página anterior.</a>
  </header>
  <section id="routine-generator">
    <form id="routine-form" action="" method="POST">
      <label for="age">Edad:</label>
      <input type="number" id="age" name="age" required>

      <label for="weight">Peso (kg):</label>
      <input type="number" id="weight" name="weight" required>

      <label for="height">Estatura (cm):</label>
      <input type="number" id="height" name="height" required>

      <label for="goal">Objetivo:</label>
      <select id="goal" name="goal" required>
        <option value="perder_peso">Perder Peso</option>
        <option value="ganar_musculos">Ganar Músculo</option>
        <option value="resistencia">Mejorar Resistencia</option>
      </select>

      <button id="generar" name="generar" type="submit">Generar Rutina</button>
    </form>
    <?php

    if ($resultado) {
      if($datos['razon'] == 'perder_peso') {
        $objetivo_rutina = "Perder Peso";
      } elseif($datos['razon'] == 'ganar_musculos') {
        $objetivo_rutina = "Ganar Musculatura";
      } else {
        $objetivo_rutina = "Mejorar Resistencia";
      }
      
      echo '
      <div id="resultado">
        <h3>Este es el resultado de tú rutina para <span style="color: tomato;">'.$objetivo_rutina.'</span>:</h3>
        <p>'.$datos['descripcion'].'</p>
        <hr>
        <h4>Ejercicio 1</h4>
        <p>'.$datos['ejercicio_1'].'</p>
        <h4>Ejercicio 2</h4>
        <p>'.$datos['ejercicio_2'].'</p>
        <h4>Ejercicio 3</h4>
        <p>'.$datos['ejercicio_3'].'</p>
        <h4>Ejercicio 4</h4>
        <p>'.$datos['ejercicio_4'].'</p>
        <hr>
        <p>Mucha Suerte! Recuerda alimentarte bien y tomar agua para hidratarte ❤️</p>
      </div>';
    } else {
      echo '<div>Aún no has generado una rutina.</div>';
    }
    ?>
  </section>

  <!-- PROXIMAMENTE
    <section id="nutrition-recommendations">
        <h2>Recomendaciones de Nutrición</h2>
        <div id="nutrition-result"></div>
    </section>
    -->

  <!-- PROXIMAMENTE
    <section id="progress-tracking">
        <h2>Seguimiento de Progreso</h2>
        <form id="progress-form">
            <label for="date">Fecha:</label>
            <input type="date" id="date" name="date" required>

            <label for="weight-progress">Peso (kg):</label>
            <input type="number" id="weight-progress" name="weight-progress" required>

            <label for="notes">Notas:</label>
            <textarea id="notes" name="notes"></textarea>

            <button type="submit">Registrar Progreso</button>
        </form>
        <div id="progress-result"></div>
    </section>
    -->

  <footer style="text-align: center; font-family: monospace; color: gray; padding: 10px;">
    <p>© 2024 Control Fitness | Gym Software</p>
  </footer>
</body>

</html>
<?php
    $id_membresia = $_GET['id'];
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
    <title>Formulario de Membresías</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }
        .form-container h2 {
            text-align: center;
            color: #3361ff;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: none;
            height: 100px;
        }
        .form-group input[type="submit"] {
            background-color: #3361ff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-group input[type="submit"]:hover {
            background-color: #1f4bff;
        }
    </style>
</head>
<body>
<?php
    $consulta = mysqli_query($conexion, "SELECT * FROM membresias WHERE CodigoMembresia='$id_membresia'");
    if(mysqli_num_rows($consulta) == 0) {
        header("location: membresia.php");
      } else {
        $datos = mysqli_fetch_assoc($consulta);
      }

    if (isset($_POST['actualizar'])) {
      $nombre = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
      $meses = mysqli_real_escape_string($conexion, (strip_tags($_POST["tiempo"], ENT_QUOTES)));
      $descripcion = mysqli_real_escape_string($conexion, (strip_tags($_POST["descripcion"], ENT_QUOTES)));
      $precio = mysqli_real_escape_string($conexion, (strip_tags($_POST["precio"], ENT_QUOTES)));

      $actualizar = mysqli_query($conexion, "UPDATE membresias SET NombreMembresia='$nombre', MesesValidezMembresia='$meses', DescripcionMembresia='$descripcion', PrecioMembresia='$precio' WHERE CodigoMembresia = '$id_membresia'") or die();
      if($actualizar){
        header("location: membresia.php");
        echo '<div class="notificacion-exito"><p>La información se edito correctamente.</p></div>';
      } else{
        echo '<div class="notificacion-error"><p>Error. No se pudo editar la información.</p></div>';
      }
    }
    ?>

    <div class="form-container">
        <h2>Editar una Membresía</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre de la Membresia</label>
                <input type="text" id="nombre" name="nombre" required value="<?= $datos['NombreMembresia']; ?>">
            </div>
            <div class="form-group">
                <label for="precio">Precio de la Membresia</label>
                <input type="number" id="precio" name="precio" required value="<?= $datos['PrecioMembresia']; ?>">
            </div>
            <div class="form-group">
                <label for="tiempo">Tiempo de Membresía</label>
                <select id="tiempo" name="tiempo" required>
                    <option value="1">1 Mes</option>
                    <option value="3">3 Meses</option>
                    <option value="12">1 Año</option>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion"></label>
                <textarea id="descripcion" name="descripcion" required><?= $datos['DescripcionMembresia']; ?></textarea>
            </div>
            <div class="form-group">
                <button name="actualizar" type="submit" class="btn btn-primary">Actualizar</button>
                <hr>
                <a class="btn btn-secundary" href="../admin/pagina-admin.php">Regresar al panel Administrativo.</a>
            </div>
        </form>
    </div>

</body>
</html>

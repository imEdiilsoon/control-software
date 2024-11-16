<?php
  include("../../backend/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informe de membresias.</title>
    <link rel="stylesheet" href="css/lista.css">
    <link rel="icon" type="icon" href="imagenes/logoo.jpg">
    <link rel="stylesheet" href="../style-admin.css">
    <link rel="stylesheet" href="../style-admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

</head>
<body>
  <header>
    <h1 align="center">Informe de Membresias.</h1>
  </header>

  <div class="container">
    <div class="content">
    <br />
    <div align="center" class="table-responsive">
      <table align="center" border="1px" class="table table-striped table-hover" style="width: 90%; border-collapse: collapse; border: 2px solid black; text-align: center;">
        <tr style="padding: 5px;">
          <th class="th1">Membresia</th>
          <th class="th1">Compras</th>
        </tr>
        <?php
          $sql = mysqli_query($conexion, "SELECT * FROM membresias_compradas");
            if (mysqli_num_rows($sql) == 0) {
              echo '<tr><td colspan="8">No hay datos.</td></tr>';
            } else {
              $no = 1;
              $membresia = '';
              while ($row = mysqli_fetch_assoc($sql)) {
                if($row['id_membresia'] == "1") {
                  $membresia = 'Plan Básico';
                }elseif($row['id_membresia'] == "3") {
                  $membresia = 'Plan Plus';
                } elseif($row['id_membresia'] == "12") {
                  $membresia = "Plan VIP";
                }
                echo '
                  <tr class="tr1">
                    <td>'.$membresia.'</td>
                    <td>'.$row['compras'].'</td>
                    </tr>
                    ';
                $no++;  
              }
            }
?>
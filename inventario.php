<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="style-user.css">
</head>
<body>
    
    <header>
        <h1>Inventario</h1>
        
    </header>
    <main>
        <h2>Registrar Nuevo Artículo</h2>
        <form action="register_inventory.php" method="post">
            <label for="item_name">Nombre del Artículo:</label>
            <input type="text" id="item_name" name="item_name" required>
            <label for="quantity">Cantidad:</label>
            <input type="number" id="quantity" name="quantity" required>
            <button type="submit">Registrar</button>
        </form>

        <h2>Inventario Existente</h2>
        
        <div>
        <main>
        <div class="grid-container">
        <div class="grid-item add-category">
        <h3>Articulo 1</h3>
        <p><img src="" alt="articulo 1" id=""></p>
        <input type="file" id="imageUpload" style="display: none;">
      </div>
      
  </main>
        </div>
    </main>
</body>
</html>

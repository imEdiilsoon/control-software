<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Inventario</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="reserva.html">Reservas</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="membresia.php">Membresías</a></li>
            </ul>
        </nav>
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
        <div id="inventory-list">
            <?php include 'nombre del archivo'; ?>
        </div>
    </main>
</body>
</html>

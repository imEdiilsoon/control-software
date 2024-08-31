<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membresías</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Membresías</h1>
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
        <h2>Registrar Nueva Membresía</h2>
        <form action="register_membership.php" method="post">
            <label for="user_id">ID de Usuario:</label>
            <input type="text" id="user_id" name="user_id" required>
            <label for="membership_type">Tipo de Membresía:</label>
            <input type="text" id="membership_type" name="membership_type" required>
            <label for="start_date">Fecha de Inicio:</label>
            <input type="date" id="start_date" name="start_date" required>
            <label for="end_date">Fecha de Fin:</label>
            <input type="date" id="end_date" name="end_date" required>
            <button type="submit">Registrar</button>
        </form>

        <h2>Membresías Existentes</h2>
        <div id="memberships-list">
            <?php include 'nombre del archivo'; ?>
        </div>
    </main>
</body>
</html>

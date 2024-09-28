<?php
session_start();

// Inicializar el array de productos en la sesión
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

// Manejar la adición de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_producto'])) {
    $nombre_producto = trim($_POST['nombre_producto']);
    $descripcion_producto = trim($_POST['descripcion_producto']);
    $precio_producto = trim($_POST['precio_producto']);

    if (!empty($nombre_producto) && !empty($descripcion_producto) && !empty($precio_producto)) {
        $_SESSION['productos'][] = [
            'nombre' => $nombre_producto,
            'descripcion' => $descripcion_producto,
            'precio' => $precio_producto
        ];
    }
}

// Manejar la eliminación de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_producto'])) {
    $index = intval($_POST['eliminar_producto']);
    if (isset($_SESSION['productos'][$index])) {
        unset($_SESSION['productos'][$index]);
        $_SESSION['productos'] = array_values($_SESSION['productos']); // Reindexar
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gimnasio - Productos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transform: translateZ(0);
        }
        h1 {
            color: #333;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        input[type="text"], input[type="number"] {
            width: calc(100% - 22px);
            padding: 15px;
            border: 2px solid #3498db;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #1e90ff;
            outline: none;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        #guardar-producto {
            background-color: #28a745;
            color: white;
        }
        #añadir-producto {
            background-color: #007bff;
            color: white;
        }
        #volver {
            background-color: #007bff;
            color: white;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .producto-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border-radius: 8px;
            margin: 5px;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .producto-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .info-producto {
            display: none;
            margin-top: 10px;
            padding: 15px;
            background: #ecf0f1;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .eliminar-btn {
            background-color: #e74c3c;
            color: white;
            margin-left: 10px;
            transition: transform 0.2s;
        }
        .eliminar-btn:hover {
            transform: translateY(-2px);
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Productos del Gimnasio</h1>
        
        <button id="añadir-producto">Añadir Producto</button>
        
        <div id="producto-form" class="hidden">
            <form method="POST" action="">
                <input type="text" name="nombre_producto" placeholder="Nombre del producto" required>
                <input type="text" name="descripcion_producto" placeholder="Descripción del producto" required>
                <input type="number" name="precio_producto" placeholder="Precio del producto" required>
                <button type="submit" id="guardar-producto">Añadir Producto</button>
                <button type="button" id="volver">Volver</button>
            </form>
        </div>

        <div id="lista-productos">
            <?php foreach ($_SESSION['productos'] as $index => $producto): ?>
                <div>
                    <a href="#" class="producto-btn" onclick="mostrarInfo(<?php echo $index; ?>)"><?php echo htmlspecialchars($producto['nombre']); ?></a>
                    <div class="info-producto" id="info-<?php echo $index; ?>">
                        <strong>Descripción:</strong> <?php echo htmlspecialchars($producto['descripcion']); ?><br>
                        <strong>Precio:</strong> $<?php echo htmlspecialchars($producto['precio']); ?>
                    </div>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="eliminar_producto" value="<?php echo $index; ?>">
                        <button type="submit" class="eliminar-btn">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.getElementById('añadir-producto').addEventListener('click', () => {
            document.getElementById('producto-form').classList.toggle('hidden');
        });

        document.getElementById('volver').addEventListener('click', () => {
            document.getElementById('producto-form').classList.add('hidden');
        });

        function mostrarInfo(index) {
            const infoDiv = document.getElementById('info-' + index);
            infoDiv.style.display = (infoDiv.style.display === "none" || infoDiv.style.display === "") ? "block" : "none";
        }
    </script>
</body>
</html>

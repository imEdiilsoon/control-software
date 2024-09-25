<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes de Suscripción</title>
    <link rel="stylesheet" href="styles.css">
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
    text-align: center;
    padding: 20px;
    background-color: #0077cc;
    color: white;
}

.pricing {
    display: flex;
    justify-content: space-around;
    padding: 20px;
}

.card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.easy {
    border-top: 20px solid #0077cc;
}

.vip {
    border-top: 20px solid #0077cc;
}

.vip-anual {
    border-top: 20px solid #FFD700;
}

button {
    background-color: #333;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #555;
}

ul {
    list-style-type: none;
    padding: 0;
}

.testimonials {
    text-align: center;
    padding: 20px;
}

#testimonial-container {
    margin-top: 20px;
}

    </style>
    <header>
        <h1>Nuestras Membresías</h1>
        <p>Adquiere una de nuestras membresías para que puedas disfrutar de los privilegios que estas contienen y poder asistir a nuestras instalaciones.</p>
        <a style="color: black; text-decoration: none; font-family: system-ui; font-weight: 600;" href="./usuarios.php">Volver a la página anterior.</a>
    </header>
    <main>
    <div style="display: flex; align-content: center; justify-content: center;">

<?php

session_start();
include("./backend/conexion.php");

if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin']) {
	header('location: index.php');
	exit;
}

$ID = $_SESSION['info']['Cedula'];

$consulta = mysqli_query($conexion, "SELECT usuarios.Nombre, usuarios.Cedula, membresias.NombreMembresia, membresia_usuario.FechaInicio, membresia_usuario.FechaFin, DATEDIFF(membresia_usuario.FechaFin, CURRENT_DATE()) AS DiasRestantes 
FROM membresia_usuario 
INNER JOIN usuarios ON membresia_usuario.CedulaUsuario = usuarios.Cedula 
INNER JOIN membresias ON membresia_usuario.CodigoMembresia = membresias.CodigoMembresia
WHERE usuarios.Cedula = '$ID' ");

$datos = mysqli_fetch_assoc($consulta);

if($datos) {
    echo '
        <section class="pricing">
            <div class="card vip-anual">
                <h3>Hola '.$datos['Nombre'].'<h3>
                <hr>
                <h2>INFORMACIÓN DE TU MEMBRESIA</h2>
                <p><b>Nombre de la Membresia: </b>'.$datos['NombreMembresia'].'</p>
                <p><b>Fecha de la Compra: </b>'.$datos['FechaInicio'].'</p>
                <p><b>Fecha del Fin: </b>'.$datos['FechaFin'].'</p>
                <p><b>Días restantes para expirar la Membresia: </b>'.$datos['DiasRestantes'].'</p>
                <hr>
                <ul style="color: gray; font-family: monospace; font-size: 14px;">
                    <p>+ Está membresía solo es valida entre la Fecha de la Compra y la Fecha de Fin.</p>
                    <p>+ Atento a los días faltantes a expirar para hacer la renovación de tú membresia.</p>
                    <p>+ No lo olvides, los esfuerzos generán resultados.</p>
                </ul>
                <a style="color: black; font-family: system-ui; font-weight: 600; text-decoration: none;" href="./usuarios.php">Volver a la página principal.</a>
            </div>
        </section>
    ';';';
} else {
    $sql = mysqli_query($conexion, "SELECT * FROM membresias");
    if (mysqli_num_rows($sql) == 0) {
        echo '<tr><td colspan="8">No hay membresias por mostrar.</td></tr>';
    } else {
        $no = 1;
        while ($row = mysqli_fetch_assoc($sql)) {
            echo '
        <section class="pricing">
            <div style="max-width: 300px;" class="card vip-anual">
                <h2>'.$row['NombreMembresia'].'</h2>
                <p>Duración de '.$row['MesesValidezMembresia'].' Mes(es).</p>
                <p>Precio: $ '.number_format($row['PrecioMembresia']).'</p>
                <button>Adquirir está membresia</button>
                <hr>
                <ul">
                    <li>'.$row['DescripcionMembresia'].'</li>
                </ul>
            </div>
        </section>';
        $no++;
        }
    }
}
?>
</div>
<section class="testimonials">
    <h2>¡Anímate a adquirir nuestros planes!</h2>
    <div id="testimonial-container"></div>
</section>

</main>
</body>
</html>

<script src="script.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', () => {
    const testimonials = [
        "¡Excelente servicios y los mejores precios!",
        "Vas a alcanzar tus metas antes de lo esperado.",
        "No hay nada mejor que estar saludable con uno mismo.",
        "Invita a tus amigos a unirse, entrenar con un amigo es lo mejor."
    ];

    const agradecimientos = [
        "¡Gracias por adquirir nuestros planes y servicios!",
        "¡Gracias por preferirnos!",
        "Esperamos que te la pases muy bien y logres tus objetivos.",
        "Ojala sigas con nosotros mucho más tiempo."
    ];

    let currentTestimonial = 0;
    let currentAgradecimientos = 0;

    const testimonialContainer = document.getElementById('testimonial-container');
    const agradecimientosContainer = document.getElementById('agradecimientos-container');

    function showTestimonial() {
        testimonialContainer.textContent = testimonials[currentTestimonial];
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
    }

    function showAgradecimientos() {
        agradecimientosContainer.textContent = agradecimientos[currentAgradecimientos];
        currentAgradecimientos = (currentAgradecimientos + 1) % agradecimientos.length;
    }

    setInterval(showTestimonial, 3000);
    showTestimonial();

    setInterval(showAgradecimientos, 3000);
    showAgradecimientos();
});
</script>
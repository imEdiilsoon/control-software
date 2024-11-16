<?php
    session_start();
  include("../backend/conexion.php");
  if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin']) {
    header('location: ../index.php');
    exit;
  }

   //Crear validación. Si no es administrador no puede ingresar acá.
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
    <title>Gestión de Gimnasio</title>
    <link rel="stylesheet" href="./style-admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
        <h1>Gestión del Software</h1>
        <h3>Bienvenido <?= ucfirst($_SESSION['info']['Nombre']); ?>, Eres: <?php if($_SESSION['info']['Rol'] == 1){echo "Administrador.";} ?></h3>
        
    </header>
    <body>
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
    <main>
        <div class="grid-container" id="grid-container">
            <a href="./listado-usuarios.php" class="grid-item items-click">
              <h3>USUARIOS REGISTRADOS</h3>
              <p><img src="../img/dafault.png" alt="img_user"></p>
            </a>
            <a href="./listado-admin.php" class="grid-item items-click">
              <h3>ADMINISTRADORES REGISTRADOS</h3>
              <p><img src="../img/dafault.png" alt="img_user"></p>
            </a>
            <a href="../formularios/registrar-admin.php" class="grid-item items-click">
              <h3>REGISTRAR ADMINISTRADOR</h3>
              <p><img src="../img/dafault.png" alt="img_user"></p>
            </a>
            <a href="#" class="grid-item items-click">
              <h3>REGISTRAR ENTRENADOR</h3>
              <p><img src="../img/gym.png" alt="img_user"></p>
            </a>
            <a href="./informes.php" class="grid-item items-click">
              <h3>GENERACIÓN DE INFORMES</h3>
              <p><img src="../img/informes.png" alt="img_informes"></p>
            </a>
            <a href="./membresia.php" class="grid-item items-click">
              <h3>ADMINISTRAR MEMBRESIAS</h3>
              <p><img src="../img/membresia.png" alt="img_user"></p>
            </a>
            <a href="../backend/login/cerrar-sesion.php" class="grid-item items-click">
              <h3>CERRAR SESIÓN</h3>
              <p><img src="../img/cerrar-sesion.jpg" alt="img-cerrar-sesion"></p>
            </a>
        </div>  
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addCategory = document.getElementById('add-category');
            const imageInput = document.getElementById('imageInput');
            const categoryImage = document.getElementById('categoryImage');

            // Cargar la imagen guardada si existe
            const savedImage = localStorage.getItem('categoryImage');
            if (savedImage) {
                categoryImage.src = savedImage;
            }

            addCategory.addEventListener('click', function() {
                imageInput.click();
            });

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        categoryImage.src = e.target.result;
                        // Guardar la imagen en localStorage
                        localStorage.setItem('categoryImage', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    <script>
        
        // Función para cargar categorías desde localStorage
        function loadCategories() {
            let categories = JSON.parse(localStorage.getItem('categories')) || [];
            categories.forEach(category => {
                addCategoryToDOM(category.name, category.avatarUrl);
            });
        }

        // Función para guardar categorías en localStorage
        function saveCategories() {
            let categories = [];
            document.querySelectorAll('.grid-item:not(.add-category)').forEach(category => {
                categories.push({
                    name: category.querySelector('p').innerText,
                    avatarUrl: category.querySelector('img').src
                });
            });
            localStorage.setItem('categories', JSON.stringify(categories));
        }

        // Función para agregar una nueva categoría al DOM
        function addCategoryToDOM(name, avatarUrl) {
            let newCategory = document.createElement('div');
            newCategory.className = 'grid-item';
            newCategory.innerHTML = `
                <a href="pagina_destino.html">
                    <img src="${avatarUrl}" alt="${name}" class="avatar">
                    <p>${name.toUpperCase()}</p>
                </a>
                <div class="button-container">
                    <button class="edit-btn">Editar</button>
                    <button class="delete-btn">Eliminar</button>
                </div>`;
            document.getElementById('grid-container').appendChild(newCategory);
            addEditDeleteFunctionality(newCategory);
        }

        // Función para agregar una nueva categoría
        document.getElementById('add-category').addEventListener('click', function() {
            let categoryName = prompt('Ingrese el nombre de la nueva categoría:');
            if (categoryName) {
                let avatarUrl = prompt('Ingrese la URL del avatar:');
                addCategoryToDOM(categoryName, avatarUrl);
                saveCategories();
            }
        });

        // Función para agregar funcionalidad de edición y eliminación a cada categoría
        function addEditDeleteFunctionality(category) {
            category.querySelector('.delete-btn').addEventListener('click', function() {
                if (confirm('¿Estás seguro que deseas eliminar esta categoría?')) {
                    category.remove();
                    saveCategories();
                }
            });

            category.querySelector('.edit-btn').addEventListener('click', function() {
                let newCategoryName = prompt('Ingrese el nuevo nombre de la categoría:', category.querySelector('p').innerText);
                if (newCategoryName) {
                    category.querySelector('p').innerText = newCategoryName.toUpperCase();
                }
                let newAvatarUrl = prompt('Ingrese la nueva URL del avatar:', category.querySelector('img').src);
                if (newAvatarUrl) {
                    category.querySelector('img').src = newAvatarUrl;
                }
                saveCategories();
            });
        }

        // Cargar categorías al iniciar la página
        loadCategories();
        
    </script>
    <script type="text/javascript">
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdownMenu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
    
        function changeProfilePicture() {
            alert('Funcionalidad para cambiar la foto de perfil'); // Placeholder para demostración
            // Aquí puedes agregar la lógica para cambiar la foto de perfil
        }
    
        function logout() {
            alert('Sesión cerrada'); // Placeholder para demostración
            // Redirigir a la página de inicio de sesión o realizar otras acciones de cierre de sesión
        }
    
        // Cerrar el menú desplegable si se hace clic fuera de él
        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon img')) {
                var dropdown = document.getElementById('dropdownMenu');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
</body>
</html>

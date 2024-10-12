<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos del Gym</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #3399ff;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
        }

        h1 {
            margin: 0;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #3399ff;
        }

        #add-product {
            margin-top: 20px;
            display: none; /* Ocultar el formulario por defecto */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input:focus, textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #3399ff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Estilos para las tarjetas de productos */
        .products-container {
            display: flex;
            flex-wrap: wrap; /* Permitir que los productos se envuelvan */
            justify-content: space-between; /* Espacio entre productos */
        }

        .product-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px; /* Ajustar margen */
            width: calc(30% - 20px); /* Ajustar el ancho para 3 productos por fila */
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card h2 {
            margin: 10px 0;
            font-size: 1.5rem;
        }

        .product-card p {
            margin: 5px 0;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .button-container button {
            width: 48%; /* Ajustar el ancho de los botones */
        }
        .container{
            display: flex;              
            flex-direction: column;
            flex-wrap: wrap;          
        }
        
    </style>
</head>
<body>
    <header>
        <h1>Conoce Nuestros Productos</h1>
    </header>

    <section id="add-product">
        <h2 id="form-title">Agregar Producto</h2>
        <form id="product-form">
            <input type="text" id="product-name" placeholder="Nombre del Producto" required>
            <textarea id="product-description" placeholder="Descripción" required></textarea>
            <input type="number" id="product-price" placeholder="Precio" required>
            <input type="url" id="product-image" placeholder="URL de la Imagen" required>
            <button type="submit">Agregar Producto</button>
        </form>
    </section>
    
    <center><button id="toggle-form">Añadir Producto</button></center> <!-- Botón para mostrar/ocultar el formulario -->
        <div class="container">
    <section class="products-container" id="products">
        <!-- Aquí se agregarán los productos dinámicamente -->
    </section>
    </div>

    <footer>
        <p style="text-align: center;">© 2024 Control</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const products = [
                {
                    name: 'Proteína Whey',
                    description: 'Proteína de alta calidad para aumentar la masa muscular.',
                    price: 49.99,
                    image: 'https://via.placeholder.com/150'
                },
                {
                    name: 'Barras de Energía',
                    description: 'Barras nutritivas perfectas para un snack pre-entrenamiento.',
                    price: 2.99,
                    image: 'https://via.placeholder.com/150'
                },
                {
                    name: 'Botella de Agua',
                    description: 'Botella de acero inoxidable para mantener tus bebidas frías.',
                    price: 19.99,
                    image: 'https://via.placeholder.com/150'
                }
            ];

            const productsSection = document.getElementById('products');
            let editIndex = null; // Índice del producto que se está editando

            function renderProducts() {
                productsSection.innerHTML = ''; // Limpiar la sección
                products.forEach((product, index) => {
                    const productCard = document.createElement('div');
                    productCard.classList.add('product-card');

                    productCard.innerHTML = `
                        <img src="${product.image}" alt="${product.name}">
                        <h2>${product.name}</h2>
                        <p>${product.description}</p>
                        <p><strong>Precio:</strong> $${product.price.toFixed(2)}</p>
                        <div class="button-container">
                            <button class="edit-button" data-index="${index}">Editar</button>
                            <button class="delete-button" data-index="${index}">Eliminar</button>
                        </div>
                    `;

                    productsSection.appendChild(productCard);
                });

                // Añadir eventos a los botones de eliminar
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', (event) => {
                        const index = event.target.getAttribute('data-index');
                        products.splice(index, 1); // Eliminar el producto del array
                        renderProducts(); // Volver a renderizar los productos
                    });
                });

                // Añadir eventos a los botones de editar
                document.querySelectorAll('.edit-button').forEach(button => {
                    button.addEventListener('click', (event) => {
                        editIndex = event.target.getAttribute('data-index');
                        const product = products[editIndex];
                        document.getElementById('product-name').value = product.name;
                        document.getElementById('product-description').value = product.description;
                        document.getElementById('product-price').value = product.price;
                        document.getElementById('product-image').value = product.image;

                        document.getElementById('form-title').textContent = 'Editar Producto';
                        document.getElementById('add-product').style.display = 'block';
                    });
                });
            }

            renderProducts();

            document.getElementById('product-form').addEventListener('submit', (event) => {
                event.preventDefault();

                const name = document.getElementById('product-name').value;
                const description = document.getElementById('product-description').value;
                const price = parseFloat(document.getElementById('product-price').value);
                const image = document.getElementById('product-image').value;

                if (editIndex !== null) {
                    // Editar el producto existente
                    products[editIndex] = { name, description, price, image };
                    editIndex = null; // Resetear el índice de edición
                } else {
                    // Agregar un nuevo producto
                    products.push({ name, description, price, image });
                }

                renderProducts();

                // Limpiar el formulario
                event.target.reset();
                document.getElementById('form-title').textContent = 'Agregar Producto';
                // Ocultar el formulario después de agregar o editar un producto
                document.getElementById('add-product').style.display = 'none';
            });

            document.getElementById('toggle-form').addEventListener('click', () => {
                const addProductSection = document.getElementById('add-product');
                addProductSection.style.display = addProductSection.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>

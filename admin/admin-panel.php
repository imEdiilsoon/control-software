<?php
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

  session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración de Usuarios</title>
  <style>
    .admin-panel {
      display: none;
    }
    .admin-panel.active {
      display: block;
    }
  </style>
</head>
<body>
  <div id="adminPanel" class="admin-panel">
    <h1>Panel de Administración</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="userTable">
        <!-- Aquí se llenarán los usuarios -->
      </tbody>
    </table>
  </div>

  <script>
    // Simulación de autenticación y autorización
    const userRole = 'admin'; // Esto debería venir del sistema de autenticación

    if (userRole === 'admin') {
      document.getElementById('adminPanel').classList.add('active');
    }

    // Simulación de datos de usuarios
    const users = [
      { id: 1, name: 'Juan Pérez', email: 'juan@example.com' },
      { id: 2, name: 'Ana Gómez', email: 'ana@example.com' }
    ];

    const userTable = document.getElementById('userTable');
    users.forEach(user => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${user.id}</td>
        <td>${user.name}</td>
        <td>${user.email}</td>
        <td>
          <button onclick="editUser(${user.id})">Editar</button>
          <button onclick="deleteUser(${user.id})">Eliminar</button>
        </td>
      `;
      userTable.appendChild(row);
    });

    function editUser(id) {
      alert('Editar usuario ' + id);
    }

    function deleteUser(id) {
      alert('Eliminar usuario ' + id);
    }
  </script>
</body>
</html>

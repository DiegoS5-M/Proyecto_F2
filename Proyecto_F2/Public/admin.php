<?php
// Iniciar sesión
session_start();

// Validar que el usuario esté autenticado y sea administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['Rol'] !== 'Administrador') {
    echo "⚠️ Acceso denegado.";  // Si no es admin, muestra mensaje y detiene el script
    exit;
}

// Guardar nombre y rol del usuario autenticado
$nombre = $_SESSION['usuario']['Nombres_usuario'] ?? 'Admin';
$rol = $_SESSION['usuario']['Rol'] ?? 'Administrador';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de administrador</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos personalizados -->
  <style>
    body {
      background-color: #f4f6f9; /* Color de fondo del panel */
    }

    .admin-header {
      margin-top: 40px;
      text-align: center;
    }

    .admin-header h2 {
      font-weight: bold;
    }

    /* Diseño con grid adaptable para las tarjetas */
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
      padding: 40px;
    }

    .admin-card {
      padding: 20px;
      text-align: center;
    }

    .admin-card i {
      font-size: 2rem;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="admin-header">
      <!-- Muestra el nombre del usuario y el rol -->
      <h2>👑 Bienvenido, <?= htmlspecialchars($nombre) ?> (<?= htmlspecialchars($rol) ?>)</h2>
    </div>

    <!-- Tarjetas de navegación del panel admin -->
    <div class="card-grid">

      <!-- Registrar Usuario -->
      <div class="card shadow-sm admin-card">
        <i class="bi bi-person-plus-fill text-primary"></i> <!-- Ícono azul -->
        <h5 class="mt-2">Registrar usuario</h5>
        <a href="registro_Usuario.php" class="btn btn-outline-primary btn-sm">Ir</a>
      </div>

      <!-- Registrar Producto -->
      <div class="card shadow-sm admin-card">
        <i class="bi bi-box-seam-fill text-warning"></i> <!-- Ícono amarillo -->
        <h5 class="mt-2">Registrar producto</h5>
        <a href="producto.php" class="btn btn-outline-warning btn-sm">Ir</a>
      </div>

      <!-- Ver Pedidos -->
      <div class="card shadow-sm admin-card">
        <i class="bi bi-card-list text-success"></i> <!-- Ícono verde -->
        <h5 class="mt-2">Ver pedidos</h5>
        <a href="ver_Pedidos.php" class="btn btn-outline-success btn-sm">Ir</a>
      </div>

      <!-- Movimiento de Inventario -->
      <div class="card shadow-sm admin-card">
        <i class="bi bi-arrow-left-right text-danger"></i> <!-- Ícono rojo -->
        <h5 class="mt-2">Movimiento inventario</h5>
        <a href="movimientos.php" class="btn btn-outline-danger btn-sm">Ir</a>
      </div>

      <!-- Ver Reportes -->
      <div class="card shadow-sm admin-card">
        <i class="bi bi-clipboard-data-fill text-info"></i> <!-- Ícono celeste -->
        <h5 class="mt-2">Ver reportes</h5>
        <a href="reportes.php" class="btn btn-outline-info btn-sm">Ir</a>
      </div>

      <!-- Cerrar Sesión -->
      <div class="card shadow-sm admin-card">
        <i class="bi bi-box-arrow-right text-secondary"></i> <!-- Ícono gris -->
        <h5 class="mt-2">Cerrar sesión</h5>
        <a href="logout.php" class="btn btn-outline-secondary btn-sm">Salir</a>
      </div>
    </div>
  </div>

  <!-- Iconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>


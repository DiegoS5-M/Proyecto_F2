<?php
// Iniciar la sesión para acceder a los datos del usuario
session_start();

// Validar si el usuario está logueado y su rol es Estudiante o Profesor
if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario']['Rol'], ['Estudiante', 'Profesor'])) {
    echo "⚠️ Acceso denegado."; // Si no cumple, se deniega el acceso
    exit;
}

// Guardar el nombre y rol del usuario desde la sesión para mostrarlos en pantalla
$nombre = $_SESSION['usuario']['Nombres_usuario'] ?? 'Usuario';
$rol    = $_SESSION['usuario']['Rol'] ?? '';
?>

<!-- Estructura básica del documento HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Usuario</title>

  <!-- Cargar Bootstrap para diseño y estilos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos adicionales para personalizar el diseño -->
  <style>
    body {
      background-color: #f4f6f9; /* Color de fondo suave */
    }
    .card-opcion {
      transition: transform 0.2s ease; /* Suaviza el efecto al pasar el mouse */
    }
    .card-opcion:hover {
      transform: scale(1.03); /* Efecto de agrandar al pasar el mouse */
    }
  </style>
</head>

<body>
  <!-- Contenedor principal centrado -->
  <div class="container mt-5">

    <!-- Encabezado de bienvenida -->
    <div class="text-center mb-4">
      <h2>👋 Bienvenido, <?= htmlspecialchars($nombre) ?> (<?= htmlspecialchars($rol) ?>)</h2>
      <p class="text-muted">Selecciona una opción para continuar:</p>
    </div>

    <!-- Sección de opciones en tarjetas -->
    <div class="row justify-content-center">

      <!-- Tarjeta para ir al catálogo -->
      <div class="col-md-4 mb-3">
        <div class="card card-opcion shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title">🛒 Ver catálogo</h5>
            <a href="catalogo.php" class="btn btn-primary">Ir al catálogo</a>
          </div>
        </div>
      </div>

      <!-- Tarjeta para ver el carrito de compras -->
      <div class="col-md-4 mb-3">
        <div class="card card-opcion shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title">🧾 Ver carrito</h5>
            <a href="carrito.php" class="btn btn-success">Ir al carrito</a>
          </div>
        </div>
      </div>

      <!-- Tarjeta para cerrar la sesión -->
      <div class="col-md-4 mb-3">
        <div class="card card-opcion shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title">🚪 Cerrar sesión</h5>
            <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
          </div>
        </div>
      </div>

    </div> <!-- Fin de la fila -->
  </div> <!-- Fin del contenedor -->
</body>
</html>
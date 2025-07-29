<?php
// Se incluye el controlador de reportes
require_once '../App/Controlador/ReporteControlador.php';

// Se instancia el controlador para poder usar sus métodos
$controlador = new ReporteControlador();

// Variables iniciales: lista vacía de ventas y total en 0
$ventas = [];  // Lista de ventas por fecha
$total = 0;    // Total sumado

// Si se envió el formulario por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha']; // Se captura la fecha seleccionada

    // El controlador devuelve una lista de ventas y el total ganado ese día
    [$ventas, $total] = $controlador->consultarPorFecha($fecha);
}
?>

<!-- Documento HTML con Bootstrap para mostrar reportes -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes de ventas</title>
  <!-- Se incluye Bootstrap para estilos y diseño responsive -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light"> <!-- Fondo gris claro -->
  <div class="container mt-5"> <!-- Contenedor principal con margen arriba -->
    <h2 class="text-center mb-4">📊 Reportes de ventas</h2>

    <!-- Formulario para consultar por fecha -->
    <form method="POST" class="mb-4">
      <div class="row justify-content-center">
        <!-- Campo para seleccionar la fecha -->
        <div class="col-md-4">
          <input type="date" name="fecha" class="form-control" required>
        </div>
        <!-- Botón para consultar -->
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Consultar</button>
        </div>
      </div>
    </form>

    <!-- Si hay ventas para mostrar -->
    <?php if (count($ventas) > 0): ?>    
      <div class="card">
        <div class="card-header bg-success text-white">Resultados</div> <!-- Encabezado de la tarjeta -->
        <div class="card-body">
          <!-- Muestra la cantidad de ventas encontradas -->
          <p>🧾 Total de ventas realizadas: <strong><?= count($ventas) ?></strong></p>
          <!-- Muestra la suma total ganada -->
          <p>💰 Ganancia total: <strong>$<?= number_format($total, 0, ',', '.') ?></strong></p>

          <!-- Tabla con los resultados -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <!-- Recorre cada venta y la muestra en la tabla -->
              <?php foreach ($ventas as $venta): ?>
                <tr>
                  <td><?= $venta['id'] ?></td>
                  <td><?= $venta['nombre'] ?></td>
                  <td><?= $venta['fecha'] ?></td>
                  <td>$<?= number_format($venta['total'], 0, ',', '.') ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    <!-- Si se envió el formulario pero no hubo resultados -->
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <div class="alert alert-warning text-center">
        No se encontraron ventas para esa fecha.
      </div>
    <?php endif; ?>

    <!-- Botón para volver al panel del administrador -->
    <div class="mt-4">
      <a href="admin.php" class="btn btn-secondary">← Volver al panel del administrador</a>
    </div>
  </div>
</body>
</html>
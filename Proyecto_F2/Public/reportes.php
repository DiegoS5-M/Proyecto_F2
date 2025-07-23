<?php
require_once '../App/Controlador/ReporteControlador.php';
$controlador = new ReporteControlador();

$ventas = [];  // Lista de ventas por fecha
$total = 0;    // Total sumado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    
    // Ahora se devuelve una lista de ventas y el total
    [$ventas, $total] = $controlador->consultarPorFecha($fecha);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes de ventas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center mb-4">📊 Reportes de ventas</h2>

    <form method="POST" class="mb-4">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Consultar</button>
        </div>
      </div>
    </form>

    <?php if (count($ventas) > 0): ?>    
      <div class="card">
        <div class="card-header bg-success text-white">Resultados</div>
        <div class="card-body">
          <p>🧾 Total de ventas realizadas: <strong><?= count($ventas) ?></strong></p>
          <p>💰 Ganancia total: <strong>$<?= number_format($total, 0, ',', '.') ?></strong></p>

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
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <div class="alert alert-warning text-center">No se encontraron ventas para esa fecha.</div>
    <?php endif; ?>
    
    <div class="mt-4">
      <a href="admin.php" class="btn btn-secondary">← Volver al panel del administrador</a>
    </div>
  </div>
</body>
</html>
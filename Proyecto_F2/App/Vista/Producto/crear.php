<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Producto</title>

  <!-- Enlace a Bootstrap para diseño y componentes -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light"> <!-- Fondo claro -->

<div class="container mt-5"> <!-- Contenedor con margen superior -->

  <h2 class="mb-4 text-center">📦 Registrar nuevo producto</h2>

  <!-- Mensaje de éxito al registrar producto -->
  <?php if ($mensaje === 'exito'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      ✅ <strong>Producto registrado correctamente.</strong>
      <!-- Botón para cerrar alerta -->
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>

  <!-- Mensaje de error al registrar producto -->
  <?php elseif ($mensaje === 'error'): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      ❌ <strong>Error al registrar el producto.</strong> Intenta nuevamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  <?php endif; ?>

  <!-- Formulario para registrar productos -->
  <form action="producto.php" method="POST" enctype="multipart/form-data" class="row g-3 mb-4">
    
    <!-- Campo: Nombre del producto -->
    <div class="col-md-6">
      <label class="form-label">Nombre del producto</label>
      <input type="text" class="form-control" name="nombre" required>
    </div>

    <!-- Campo: Código o ID del producto -->
    <div class="col-md-6">
      <label class="form-label">Código del producto (ID)</label>
      <input type="text" class="form-control" name="id" required>
    </div>

    <!-- Campo: Precio de costo -->
    <div class="col-md-6">
      <label class="form-label">Precio de costo</label>
      <input type="number" step="0.01" class="form-control" name="precio_costo" required>
    </div>

    <!-- Campo: Precio de venta -->
    <div class="col-md-6">
      <label class="form-label">Precio de venta</label>
      <input type="number" step="0.01" class="form-control" name="precio_venta" required>
    </div>

    <!-- Campo: Cantidad en stock -->
    <div class="col-md-6">
      <label class="form-label">Cantidad en stock</label>
      <input type="number" class="form-control" name="cantidad" required>
    </div>

    <!-- Campo: Categoría (tipo de producto) -->
    <div class="col-md-6">
      <label class="form-label">Categoría</label>
      <select class="form-select" name="tipo_producto" required>
        <option value="">Seleccione</option>
        <option value="1">Bebidas</option>
        <option value="2">Comidas</option>
        <option value="3">Snacks</option>
        <option value="4">Postres</option>
        <option value="5">Otros</option>
      </select>
    </div>

    <!-- Campo: Imagen del producto -->
    <div class="col-md-12">
      <label class="form-label">Foto del producto</label>
      <input type="file" class="form-control" name="foto" accept="image/*" required>
    </div>

    <!-- Botón para guardar el producto -->
    <div class="col-12 text-center">
      <button type="submit" name="registrar" class="btn btn-success">➕ Guardar producto</button>
    </div>
  </form>

  <!-- Botones para navegar a la lista de productos o al panel -->
  <div class="text-center mb-4">
    <a href="producto.php?listar=1" class="btn btn-info">📋 Ver productos registrados</a>
    <a href="admin.php" class="btn btn-secondary">← Volver al panel del administrador</a>
  </div>

  <!-- Tabla para mostrar productos registrados si existen -->
  <?php if (!empty($productos)): ?>
    <div class="card mt-4">
      <div class="card-header bg-info text-white"> <!-- Título de la tabla -->
        Productos registrados
      </div>
      <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Precio venta</th>
              <th>Precio costo</th>
              <th>Cantidad</th>
              <th>Categoría</th>
              <th>Foto</th>
            </tr>
          </thead>
          <tbody>
            <!-- Recorrer y mostrar cada producto -->
            <?php foreach ($productos as $p): ?>
              <tr>
                <td><?= htmlspecialchars($p['Id_Producto']) ?></td>
                <td><?= htmlspecialchars($p['Nombre_Producto']) ?></td>
                <td>$<?= number_format($p['Precio_venta'], 0, ',', '.') ?></td>
                <td>$<?= number_format($p['Precio_costo'], 0, ',', '.') ?></td>
                <td><?= $p['Cantidad_en_Stock'] ?></td>
                <td><?= $p['Tipo_Producto'] ?></td>
                <td>
                  <?php if (!empty($p['Foto'])): ?>
                    <!-- Mostrar imagen en base64 -->
                    <img src="data:image/jpeg;base64,<?= base64_encode($p['Foto']) ?>" width="60" height="60" style="object-fit:cover;">
                  <?php else: ?>
                    <span class="text-muted">Sin imagen</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endif; ?>

</div>

<!-- Script de Bootstrap para funcionalidades como botones, alertas, etc. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
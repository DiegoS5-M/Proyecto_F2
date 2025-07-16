<?php
session_start();
require_once '../App/Modelo/Producto.php';

$producto = new Producto();
$productos = $producto->obtenerTodos();


$mensaje = '';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'], $_POST['cantidad'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = intval($_POST['cantidad']);

    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$id_producto] = $cantidad;
    }

    $mensaje = "✅ Producto agregado al carrito";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Catálogo de productos</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .producto-card img {
      height: 180px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
   <?php if (!empty($mensaje)): ?>
  <div id="mensaje-alerta" class="alert alert-success text-center" role="alert">
      <?= $mensaje ?>
  </div>
<?php endif; ?>
    <h2 class="text-center mb-4">🛍️ Catálogo de productos</h2>
    <div class="text-center mb-4">
  <a href="carrito.php" class="btn btn-outline-primary">
    🧾 Ver carrito de compras
  </a>
</div>
    
    <div class="row">
      <?php foreach ($productos as $p): ?>
        <div class="col-md-4 mb-4">
          <div class="card producto-card shadow-sm">
            <?php if (!empty($p['Foto'])): ?>
              <img src="data:image/jpeg;base64,<?= base64_encode($p['Foto']) ?>" class="card-img-top" alt="Foto del producto">
            <?php else: ?>
              <img src="https://via.placeholder.com/300x180?text=Sin+imagen" class="card-img-top" alt="Sin imagen">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($p['Nombre_Producto']) ?></h5>
              <p class="card-text">💲<?= number_format($p['Precio_venta'], 0, ',', '.') ?></p>
              <form method="POST" action="catalogo.php">
                <input type="hidden" name="id_producto" value="<?= $p['Id_Producto'] ?>">
                <input type="number" name="cantidad" value="1" min="1" max="<?= $p['Cantidad_en_Stock'] ?>" class="form-control mb-2" required>
                <button type="submit" class="btn btn-success w-100">➕ Agregar al carrito</button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-4">
      <a href="usuario.php" class="btn btn-secondary">← Volver al panel</a>
    </div>
  </div>
  <script>
  // Desaparecer el mensaje después de 3 segundos
  setTimeout(() => {
    const alerta = document.getElementById('mensaje-alerta');
    if (alerta) {
      alerta.style.transition = 'opacity 0.5s ease';
      alerta.style.opacity = '0';
      setTimeout(() => alerta.remove(), 500); // eliminar del DOM
    }
  }, 3000);
</script>
</body>
</html>

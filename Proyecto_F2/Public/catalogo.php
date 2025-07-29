<?php
session_start();  // Inicia sesión para acceder al carrito

require_once '../App/Modelo/Producto.php';  // Importa la clase Producto

$producto = new Producto();  // Instancia del modelo
$productos = $producto->obtenerTodos();  // Obtiene todos los productos disponibles (con stock)

// Variable para mostrar mensaje después de agregar al carrito
$mensaje = '';

// Si no existe aún el carrito, lo crea
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'], $_POST['cantidad'])) {
    $id_producto = $_POST['id_producto'];  // ID del producto recibido
    $cantidad = intval($_POST['cantidad']);  // Cantidad recibida (convertido a entero)

    // Si el producto ya estaba en el carrito, suma la cantidad
    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$id_producto] = $cantidad;
    }

    // Mensaje de confirmación
    $mensaje = "✅ Producto agregado al carrito";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Catálogo de productos</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos para imágenes de productos -->
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

  <!-- Mensaje de éxito si se agregó un producto -->
  <?php if (!empty($mensaje)): ?>
    <div id="mensaje-alerta" class="alert alert-success text-center" role="alert">
        <?= $mensaje ?>
    </div>
  <?php endif; ?>

  <h2 class="text-center mb-4">🛍️ Catálogo de productos</h2>

  <!-- Botón para ir al carrito -->
  <div class="text-center mb-4">
    <a href="carrito.php" class="btn btn-outline-primary">🧾 Ver carrito de compras</a>
  </div>
    
    <div class="row">
  <?php foreach ($productos as $p): ?>
    <div class="col-md-4 mb-4">
      <div class="card producto-card shadow-sm">

        <!-- Imagen del producto -->
        <?php if (!empty($p['Foto'])): ?>
          <img src="data:image/jpeg;base64,<?= base64_encode($p['Foto']) ?>" class="card-img-top" alt="Foto del producto">
        <?php else: ?>
          <img src="https://via.placeholder.com/300x180?text=Sin+imagen" class="card-img-top" alt="Sin imagen">
        <?php endif; ?>

        <!-- Información del producto -->
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($p['Nombre_Producto']) ?></h5>
          <p class="card-text">💲<?= number_format($p['Precio_venta'], 0, ',', '.') ?></p>

          <!-- Formulario para agregar al carrito -->
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

    <!-- Botón para volver al panel del usuario -->
<div class="text-center mt-4">
  <a href="usuario.php" class="btn btn-secondary">← Volver al panel</a>
</div>
  </div>
  <script>
// Oculta el mensaje de confirmación después de 3 segundos
setTimeout(() => {
  const alerta = document.getElementById('mensaje-alerta');
  if (alerta) {
    alerta.style.transition = 'opacity 0.5s ease';
    alerta.style.opacity = '0';
    setTimeout(() => alerta.remove(), 500);
  }
}, 3000);
</script>
</body>
</html>

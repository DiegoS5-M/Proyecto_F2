<?php
require_once '../App/Centro/DataBase.php';  // Conecta con la base de datos

// Verifica que se haya enviado el ID del pedido por la URL
if (!isset($_GET['id'])) {
    echo "❌ ID de pedido no proporcionado.";
    exit;
}

$id_pedido = $_GET['id'];  // Se almacena el ID del pedido

$db = (new DataBase())->conn;  // Se obtiene la conexión a la base de datos

// Obtener información del pedido
$stmt_pedido = $db->prepare("
    SELECT p.Id, u.Nombres_usuario AS usuario, p.Fecha_Venta, p.total 
    FROM ventas_pedidos p 
    JOIN usuarios u ON p.id_usuario = u.id_usuario 
    WHERE p.Id = ?
");
$stmt_pedido->execute([$id_pedido]);
$pedido = $stmt_pedido->fetch(PDO::FETCH_ASSOC);  // Se obtiene el pedido como array asociativo

// Obtener productos del detalle del pedido
$stmt_detalles = $db->prepare("
    SELECT d.cantidad, pr.Nombre_Producto, pr.Precio_venta 
    FROM detalles_pedido d 
    JOIN productos pr ON d.id_producto = pr.Id_Producto 
    WHERE d.id_pedido = ?
");
$stmt_detalles->execute([$id_pedido]);
$detalles = $stmt_detalles->fetchAll(PDO::FETCH_ASSOC);  // Lista de productos del pedido
?>

<!-- parte visual-->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle del Pedido</title>


   <!-- Bootstrap 5 para diseño responsivo y componentes bonitos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> <!-- Fondo claro con clase Bootstrap -->

<!-- datos del pedido-->
<div class="container mt-5"> <!-- Contenedor centrado con margen arriba -->

  <!-- Título del pedido -->
  <h2 class="mb-4">📦 Detalle del Pedido #<?= htmlspecialchars($pedido['Id']) ?></h2>

  <!-- Información del cliente y fecha -->
  <p><strong>👤 Cliente:</strong> <?= htmlspecialchars($pedido['usuario']) ?></p>
  <p><strong>🗓 Fecha:</strong> <?= htmlspecialchars($pedido['Fecha_Venta']) ?></p>
  <p><strong>💵 Total:</strong> $<?= number_format($pedido['total'], 0, ',', '.') ?></p>

 <table class="table table-bordered mt-4">
    <thead class="table-dark"> <!-- Encabezado oscuro -->
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>

    <tbody>
     <?php foreach ($detalles as $d): ?>
        <tr>
          <td><?= htmlspecialchars($d['Nombre_Producto']) ?></td>
          <td><?= $d['cantidad'] ?></td>
          <td>$<?= number_format($d['Precio_venta'], 0, ',', '.') ?></td>
          <td>$<?= number_format($d['Precio_venta'] * $d['cantidad'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

   <!-- Botón de regreso -->
  <a href="ver_Pedidos.php" class="btn btn-secondary mt-3">← Volver a la lista de pedidos</a>
</div>
</body>
</html>
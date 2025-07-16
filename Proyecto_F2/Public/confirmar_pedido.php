<?php
session_start();
require_once '../App/Modelo/Pedido.php';

$pedido = new Pedido();
$id_usuario = $_SESSION['usuario']['Id_usuario'] ?? null;
$productos = $_SESSION['carrito'] ?? [];

$mensaje = '';
if ($id_usuario && !empty($productos)) {
    $resultado = $pedido->crearPedido($id_usuario, $productos);
    if ($resultado) {
        $mensaje = '✅ Pedido confirmado correctamente.';
        unset($_SESSION['carrito']);
    } else {
        $mensaje = '❌ Error al confirmar el pedido.';
    }
} else {
    $mensaje = '⚠️ No hay productos en el carrito o no estás logueado.';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación de pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .mensaje {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container mensaje text-center">
    <div class="alert <?= str_contains($mensaje, '✅') ? 'alert-success' : 'alert-danger' ?> fw-bold" role="alert">
      <?= $mensaje ?>
    </div>

    <div class="mt-4">
      <a href="catalogo.php" class="btn btn-outline-primary me-2">← Volver al catálogo</a>
      <a href="usuario.php" class="btn btn-outline-secondary">🏠 Volver al panel del usuario</a>
    </div>
  </div>
</body>
</html>
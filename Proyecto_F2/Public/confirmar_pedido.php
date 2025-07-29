<?php
session_start();  // Inicia o reanuda la sesión para acceder al carrito y datos del usuario

require_once '../App/Modelo/Pedido.php';  // Se importa la clase Pedido

$pedido = new Pedido();  // Crea una instancia del modelo Pedido

// Se obtiene el ID del usuario desde la sesión, si está logueado
$id_usuario = $_SESSION['usuario']['Id_usuario'] ?? null;

// Se obtienen los productos agregados al carrito (si existen)
$productos = $_SESSION['carrito'] ?? [];

$mensaje = '';  // Inicializa la variable para mostrar un mensaje al usuario

// Verifica si hay un usuario logueado y si el carrito tiene productos
if ($id_usuario && !empty($productos)) {
    // Intenta crear el pedido en la base de datos
    $resultado = $pedido->crearPedido($id_usuario, $productos);

    if ($resultado) {
        $mensaje = '✅ Pedido confirmado correctamente.';  // Éxito
        unset($_SESSION['carrito']);  // Vacía el carrito después de confirmar
    } else {
        $mensaje = '❌ Error al confirmar el pedido.';  // Fallo al guardar
    }
} else {
    $mensaje = '⚠️ No hay productos en el carrito o no estás logueado.';  // No hay datos válidos
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación de pedido</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos personalizados -->
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

    <!-- Muestra el mensaje de éxito o error con color adecuado -->
    <div class="alert <?= str_contains($mensaje, '✅') ? 'alert-success' : 'alert-danger' ?> fw-bold" role="alert">
      <?= $mensaje ?>
    </div>

    <!-- Botones de navegación -->
    <div class="mt-4">
      <a href="catalogo.php" class="btn btn-outline-primary me-2">← Volver al catálogo</a>
      <a href="usuario.php" class="btn btn-outline-secondary">🏠 Volver al panel del usuario</a>
    </div>

  </div>
</body>
</html>
<?php
// Verifica si la variable $pedidos está definida; si no, la inicializa como arreglo vacío
if (!isset($pedidos)) {
    $pedidos = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos realizados</title>

    <!-- Incluye Bootstrap desde CDN para usar sus estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> <!-- Fondo claro para el cuerpo -->

<div class="container mt-5"> <!-- Contenedor con margen superior -->
    <h2 class="text-center mb-4">🧾 Pedidos realizados</h2>

    <!-- Si no hay pedidos, se muestra un mensaje -->
    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info text-center">
            No hay pedidos registrados.
        </div>

    <!-- Si hay pedidos, se muestra la tabla -->
    <?php else: ?>
        <div class="table-responsive"> <!-- Hace la tabla adaptable a pantallas pequeñas -->
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center"> <!-- Encabezado oscuro centrado -->
                    <tr>
                        <th>ID</th>
                        <th>Nombre del usuario</th>
                        <th>ID Usuario</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Detalles</th> <!-- Columna para botón de ver detalles -->
                    </tr>
                </thead>
                <tbody class="text-center">
                    <!-- Recorre cada pedido del arreglo $pedidos -->
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <!-- Cada dato del pedido mostrado en su respectiva celda -->
                            <td><?= htmlspecialchars($pedido['id']) ?></td>
                            <td><?= htmlspecialchars($pedido['nombre']) ?></td>
                            <td><?= htmlspecialchars($pedido['id_usuario']) ?></td>
                            <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                            <td><?= htmlspecialchars($pedido['estado']) ?></td>
                            <td>$<?= number_format($pedido['total'], 0, ',', '.') ?></td>

                            <!-- Botón para ver detalle del pedido (redirecciona a detalle_pedido.php) -->
                            <td> 
                                <a href="detalle_pedido.php?id=<?= $pedido['id'] ?>" class="btn btn-sm btn-info">
                                    📄 Ver detalle
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Botón para volver al panel del administrador -->
    <div class="text-center mt-4">
        <a href="/Proyecto_F2/Public/admin.php" class="btn btn-secondary">
            ← Volver al panel del administrador
        </a>
    </div>
</div>

<!-- Bootstrap Bundle (JS y funcionalidades como modales, dropdowns, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
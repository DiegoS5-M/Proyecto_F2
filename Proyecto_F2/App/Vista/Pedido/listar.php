<?php
if (!isset($pedidos)) {
    $pedidos = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos realizados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">🧾 Pedidos realizados</h2>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info text-center">
            No hay pedidos registrados.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del usuario</th>
                        <th>ID Usuario</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= htmlspecialchars($pedido['id']) ?></td>
                            <td><?= htmlspecialchars($pedido['nombre']) ?></td>
                            <td><?= htmlspecialchars($pedido['id_usuario']) ?></td>
                            <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                            <td><?= htmlspecialchars($pedido['estado']) ?></td>
                            <td>$<?= number_format($pedido['total'], 0, ',', '.') ?></td>
                            <td> 
                                <a href="detalle_pedido.php?id=<?= $pedido['id'] ?>" class="btn btn-sm btn-info">📄 Ver detalle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="/Proyecto_F2/Public/admin.php" class="btn btn-secondary">← Volver al panel del administrador</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
require_once '../App/Modelo/Producto.php';

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$productoModel = new Producto();
$productos = $productoModel->obtenerTodos();

// Agregar al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'] ?? 1;

    // Si ya está en el carrito, suma cantidad
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] += $cantidad;
    } else {
        $_SESSION['carrito'][$id] = $cantidad;
    }

    echo "<p style='color:green;'>✅ Producto agregado al carrito.</p>";
}
?>

<h2>🛍️ Catálogo de productos</h2>

<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad disponible</th>
        <th>Agregar al carrito</th>
    </tr>
    <?php foreach ($productos as $producto): ?>
    <tr>
        <td><?= htmlspecialchars($producto['Nombre_Producto']) ?></td>
        <td>$<?= number_format($producto['Precio_venta'], 0, ',', '.') ?></td>
        <td><?= $producto['Cantidad_en_Stock'] ?></td>
        <td>
            <form method="POST">
                <input type="hidden" name="id_producto" value="<?= $producto['Id_Producto'] ?>">
                <input type="number" name="cantidad" min="1" max="<?= $producto['Cantidad_en_Stock'] ?>" value="1" required>
                <button type="submit">➕ Agregar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="carrito.php">🛒 Ver carrito</a><br>
<a href="usuario.php">← Volver al panel de usuario</a>

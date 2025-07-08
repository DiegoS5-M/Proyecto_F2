<?php
session_start();
require_once '../App/Modelo/Producto.php';

$productoModel = new Producto();

// Inicializar carrito si no existe
$carrito = $_SESSION['carrito'] ?? [];

// 🗑️ Eliminar producto del carrito
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    unset($_SESSION['carrito'][$id]);
    header("Location: carrito.php");
    exit;
}

// 🚫 Vaciar todo el carrito
if (isset($_GET['vaciar'])) {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit;
}

$productosEnCarrito = [];
if (!empty($carrito)) {
    $todos = $productoModel->obtenerTodos();
    foreach ($todos as $producto) {
        $id = $producto['Id_Producto'];
        if (isset($carrito[$id])) {
            $producto['cantidad_seleccionada'] = $carrito[$id];
            $producto['subtotal'] = $carrito[$id] * $producto['Precio_venta'];
            $productosEnCarrito[] = $producto;
        }
    }
}
?>

<h2>🛒 Carrito de compras</h2>

<?php if (empty($productosEnCarrito)): ?>
    <p>No has agregado productos aún.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Quitar</th>
        </tr>
        <?php 
        $total = 0;
        foreach ($productosEnCarrito as $producto): 
            $total += $producto['subtotal'];
        ?>
        <tr>
            <td><?= htmlspecialchars($producto['Nombre_Producto']) ?></td>
            <td>$<?= number_format($producto['Precio_venta'], 0, ',', '.') ?></td>
            <td><?= $producto['cantidad_seleccionada'] ?></td>
            <td>$<?= number_format($producto['subtotal'], 0, ',', '.') ?></td>
            <td><a href="carrito.php?eliminar=<?= $producto['Id_Producto'] ?>" style="color:red;">❌</a></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td colspan="2"><strong>$<?= number_format($total, 0, ',', '.') ?></strong></td>
        </tr>
    </table>

    <br>
    <form action="confirmar_pedido.php" method="POST">
        <button type="submit">✅ Confirmar pedido</button>
    </form>

    <br>
    <a href="carrito.php?vaciar=1" style="color: red;">🚫 Vaciar carrito</a>
<?php endif; ?>

<br><br>
<a href="catalogo.php">← Volver al catálogo</a><br>
<a href="usuario.php">🏠 Volver al panel del usuario</a>
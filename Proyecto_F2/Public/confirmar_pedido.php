<?php
session_start();
require_once '../App/Centro/DataBase.php';

if (!isset($_SESSION['usuario']) || empty($_SESSION['carrito'])) {
    echo "⚠️ No hay sesión activa o el carrito está vacío.";
    exit;
}

$usuario_id = $_SESSION['usuario']['Id_usuario'];
$carrito = $_SESSION['carrito'];

try {
    $db = (new DataBase())->conn;
    $db->beginTransaction();

    // Calcular total del pedido
    $total = 0;
    foreach ($carrito as $id => $cantidad) {
        $stmt = $db->prepare("SELECT Precio_venta FROM productos WHERE Id_Producto = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($producto) {
            $total += $producto['Precio_venta'] * $cantidad;
        }
    }

    // Insertar en tabla ventas_pedidos
    $stmt = $db->prepare("INSERT INTO ventas_pedidos (id_usuario, estado, Fecha_Venta, medio_pago, total)
                          VALUES (?, 'pendiente', NOW(), 'efectivo', ?)");
    $stmt->execute([$usuario_id, $total]);
    $pedido_id = $db->lastInsertId();

    // Insertar en detalle_pedido
    foreach ($carrito as $id_producto => $cantidad) {
        $stmt = $db->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad)
                              VALUES (?, ?, ?)");
        $stmt->execute([$pedido_id, $id_producto, $cantidad]);
    }

    // Limpiar carrito
    unset($_SESSION['carrito']);
    $db->commit();

    echo "<p style='color:green;'>✅ Pedido confirmado correctamente.</p>";
} catch (PDOException $e) {
    $db->rollBack();
    echo "<p style='color:red;'>❌ Error al confirmar el pedido: " . $e->getMessage() . "</p>";
}
?>

<br>
<a href="catalogo.php">← Volver al catálogo</a><br>
<a href="usuario.php">🏠 Volver al panel del usuario</a>

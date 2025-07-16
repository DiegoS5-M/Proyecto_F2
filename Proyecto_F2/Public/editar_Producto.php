<?php
require_once '../App/Centro/DataBase.php';

$db = (new DataBase())->conn;

// Obtener ID del producto por GET
if (!isset($_GET['id'])) {
    echo "⚠️ No se especificó el ID del producto.";
    exit;
}

$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM productos WHERE Id_Producto = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    echo "❌ Producto no encontrado.";
    exit;
}
?>

<h2>✏️ Editar producto: <?= htmlspecialchars($producto['Nombre_Producto']) ?></h2>

<form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $producto['Id_Producto'] ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['Nombre_Producto']) ?>" required><br><br>

    <label>Precio de costo:</label><br>
    <input type="number" name="precio_costo" value="<?= $producto['Precio_costo'] ?>" required><br><br>

    <label>Precio de venta:</label><br>
    <input type="number" name="precio_venta" value="<?= $producto['Precio_venta'] ?>" required><br><br>

    <label>Cantidad en stock:</label><br>
    <input type="number" name="cantidad" value="<?= $producto['Cantidad_en_Stock'] ?>" required><br><br>

    <label>Categoría:</label><br>
    <input type="number" name="tipo_producto" value="<?= $producto['Tipo_Producto'] ?>" required><br><br>

    <label>Foto actual:</label><br>
    <img src="mostrar_foto.php?id=<?= $producto['Id_Producto'] ?>" width="100"><br><br>

    <label>Nueva foto (opcional):</label><br>
    <input type="file" name="foto" accept="image/*"><br><br>

    <button type="submit">💾 Actualizar producto</button>
</form>

<br>
<a href="producto.php?listar=1">← Volver al listado de productos</a>
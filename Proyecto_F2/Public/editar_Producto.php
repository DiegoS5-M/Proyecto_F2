<?php
// Importa el archivo de conexión a la base de datos
require_once '../App/Centro/DataBase.php';

// Crea una instancia de la base de datos y obtiene la conexión PDO
$db = (new DataBase())->conn;

// Verifica si se recibió un ID del producto a editar mediante la URL (GET)
if (!isset($_GET['id'])) {
    // Si no se recibe ID, muestra mensaje de advertencia y detiene el script
    echo "⚠️ No se especificó el ID del producto.";
    exit;
}

// Captura el ID enviado por la URL
$id = $_GET['id'];

// Prepara una consulta SQL para obtener los datos del producto según su ID
$stmt = $db->prepare("SELECT * FROM productos WHERE Id_Producto = ?");
$stmt->execute([$id]);

// Ejecuta la consulta y guarda el resultado en un array asociativo
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

// Si no se encuentra el producto, se muestra un mensaje de error y se detiene el script
if (!$producto) {
    echo "❌ Producto no encontrado.";
    exit;
}
?>


<!-- Título principal mostrando el nombre actual del producto -->
<h2>✏️ Editar producto: <?= htmlspecialchars($producto['Nombre_Producto']) ?></h2>

<!-- Formulario que envía los cambios al archivo actualizar_producto.php -->
<form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">

    <!-- Campo oculto con el ID del producto (para identificar qué producto actualizar) -->
    <input type="hidden" name="id" value="<?= $producto['Id_Producto'] ?>">

    <!-- Campo: Nombre del producto -->
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['Nombre_Producto']) ?>" required><br><br>

    <!-- Campo: Precio de costo -->
    <label>Precio de costo:</label><br>
    <input type="number" name="precio_costo" value="<?= $producto['Precio_costo'] ?>" required><br><br>

    <!-- Campo: Precio de venta -->
    <label>Precio de venta:</label><br>
    <input type="number" name="precio_venta" value="<?= $producto['Precio_venta'] ?>" required><br><br>

    <!-- Campo: Cantidad en stock -->
    <label>Cantidad en stock:</label><br>
    <input type="number" name="cantidad" value="<?= $producto['Cantidad_en_Stock'] ?>" required><br><br>

    <!-- Campo: Categoría del producto (ID de tipo) -->
    <label>Categoría:</label><br>
    <input type="number" name="tipo_producto" value="<?= $producto['Tipo_Producto'] ?>" required><br><br>

    <!-- Imagen actual del producto usando otro script que la muestra desde la base de datos -->
    <label>Foto actual:</label><br>
    <img src="mostrar_foto.php?id=<?= $producto['Id_Producto'] ?>" width="100"><br><br>

    <!-- Input para subir una nueva imagen (opcional) -->
    <label>Nueva foto (opcional):</label><br>
    <input type="file" name="foto" accept="image/*"><br><br>

    <!-- Botón para enviar el formulario -->
    <button type="submit">💾 Actualizar producto</button>
</form>

<!-- Enlace para regresar al listado de productos -->
<br>
<a href="producto.php?listar=1">← Volver al listado de productos</a>
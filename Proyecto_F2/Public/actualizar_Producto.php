<?php
// Se incluye el archivo de conexión a la base de datos
require_once '../App/Centro/DataBase.php';

// Se crea una instancia de conexión PDO
$db = (new DataBase())->conn;

// Se capturan los datos enviados por el formulario POST
$id           = $_POST['id'];               // ID del producto a actualizar
$nombre       = $_POST['nombre'];           // Nuevo nombre del producto
$precio_costo = $_POST['precio_costo'];     // Nuevo precio de costo
$precio_venta = $_POST['precio_venta'];     // Nuevo precio de venta
$cantidad     = $_POST['cantidad'];         // Nueva cantidad en stock
$categoria    = $_POST['tipo_producto'];    // Nueva categoría (tipo) del producto

// Verifica si se ha subido una nueva imagen
if (!empty($_FILES['foto']['tmp_name'])) {
    // Lee el contenido binario de la imagen
    $foto = file_get_contents($_FILES['foto']['tmp_name']);

    // Sentencia SQL para actualizar el producto incluyendo la imagen
    $sql = "UPDATE productos SET 
        Nombre_Producto = ?, 
        Precio_costo = ?, 
        Precio_venta = ?, 
        Cantidad_en_Stock = ?, 
        Tipo_Producto = ?, 
        Foto = ?
        WHERE Id_Producto = ?";
        
    // Prepara y ejecuta la sentencia SQL con los nuevos valores
    $stmt = $db->prepare($sql);
    $stmt->execute([$nombre, $precio_costo, $precio_venta, $cantidad, $categoria, $foto, $id]);
} else {
    // Si no se subió nueva imagen, se actualiza todo excepto la foto
    $sql = "UPDATE productos SET 
        Nombre_Producto = ?, 
        Precio_costo = ?, 
        Precio_venta = ?, 
        Cantidad_en_Stock = ?, 
        Tipo_Producto = ?
        WHERE Id_Producto = ?";
        
    // Prepara y ejecuta la sentencia sin incluir la foto
    $stmt = $db->prepare($sql);
    $stmt->execute([$nombre, $precio_costo, $precio_venta, $cantidad, $categoria, $id]);
}

// Redirige al usuario al listado de productos después de actualizar
header("Location: producto.php?listar=1");
exit;

?>

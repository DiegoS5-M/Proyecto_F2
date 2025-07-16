<?php
require_once '../App/Centro/DataBase.php';

$db = (new DataBase())->conn;

$id      = $_POST['id'];
$nombre  = $_POST['nombre'];
$precio_costo = $_POST['precio_costo'];
$precio_venta = $_POST['precio_venta'];
$cantidad     = $_POST['cantidad'];
$categoria    = $_POST['tipo_producto'];

// Si subieron una nueva imagen
if (!empty($_FILES['foto']['tmp_name'])) {
    $foto = file_get_contents($_FILES['foto']['tmp_name']);

    $sql = "UPDATE productos SET 
        Nombre_Producto = ?, 
        Precio_costo = ?, 
        Precio_venta = ?, 
        Cantidad_en_Stock = ?, 
        Tipo_Producto = ?, 
        Foto = ?
        WHERE Id_Producto = ?";
        
    $stmt = $db->prepare($sql);
    $stmt->execute([$nombre, $precio_costo, $precio_venta, $cantidad, $categoria, $foto, $id]);
} else {
    // Sin cambiar la foto
    $sql = "UPDATE productos SET 
        Nombre_Producto = ?, 
        Precio_costo = ?, 
        Precio_venta = ?, 
        Cantidad_en_Stock = ?, 
        Tipo_Producto = ?
        WHERE Id_Producto = ?";
        
    $stmt = $db->prepare($sql);
    $stmt->execute([$nombre, $precio_costo, $precio_venta, $cantidad, $categoria, $id]);
}

header("Location: producto.php?listar=1");
exit;
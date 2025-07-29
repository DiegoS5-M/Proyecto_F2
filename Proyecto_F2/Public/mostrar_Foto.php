<?php
// Incluye la clase que maneja la conexión a la base de datos
require_once '../App/Centro/DataBase.php';

// Verifica si no se ha enviado el parámetro 'id' por la URL
// Si no se proporciona, se detiene la ejecución del script
if (!isset($_GET['id'])) exit;

// Crea una instancia de la conexión y guarda el objeto PDO en $db
$db = (new DataBase())->conn;

// Prepara una consulta SQL para obtener la foto del producto con el ID proporcionado
$stmt = $db->prepare("SELECT Foto FROM productos WHERE Id_Producto = ?");
$stmt->execute([$_GET['id']]); // Ejecuta la consulta pasando el ID como parámetro

// Obtiene el contenido binario (BLOB) de la imagen de la base de datos
$foto = $stmt->fetchColumn();

// Si se encontró una imagen
if ($foto) {
    // Establece el encabezado para que el navegador sepa que se trata de una imagen JPEG
    header("Content-Type: image/jpeg");

    // Muestra directamente la imagen al navegador
    echo $foto;
}
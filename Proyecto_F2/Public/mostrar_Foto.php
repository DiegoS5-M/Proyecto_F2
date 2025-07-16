<?php
require_once '../App/Centro/DataBase.php';

if (!isset($_GET['id'])) exit;

$db = (new DataBase())->conn;

$stmt = $db->prepare("SELECT Foto FROM productos WHERE Id_Producto = ?");
$stmt->execute([$_GET['id']]);
$foto = $stmt->fetchColumn();

if ($foto) {
    header("Content-Type: image/jpeg");
    echo $foto;
}
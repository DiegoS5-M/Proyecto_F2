<?php
require_once '../App/Controlador/ProductoControlador.php';

$controlador = new ProductoControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    $controlador->guardar();
} elseif (isset($_GET['listar'])) {
    $controlador->listar();
} else {
    $controlador->crear();
}



?>

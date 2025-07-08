<?php
require_once '../App/Controlador/PedidoControlador.php';

$controlador = new PedidoControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['realizar'])) {
    $controlador->guardar();
} else {
    $controlador->crear();
}

?>
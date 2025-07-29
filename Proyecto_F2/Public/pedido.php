<?php
// Incluye el archivo del controlador de pedidos para poder usar sus métodos
require_once '../App/Controlador/PedidoControlador.php';

// Crea una instancia del controlador de pedidos
$controlador = new PedidoControlador();

// Verifica si el formulario fue enviado mediante el método POST y si se presionó el botón 'realizar'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['realizar'])) {
    // Si es así, llama al método 'guardar()' del controlador para procesar y guardar el pedido
    $controlador->guardar();
} else {
    // Si no es una solicitud POST, muestra la vista para crear un pedido
    $controlador->crear();
}
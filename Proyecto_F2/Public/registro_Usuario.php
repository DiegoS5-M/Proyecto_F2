<?php
require_once '../App/Controlador/UsuarioControlador.php';

$controlador = new UsuarioControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $controlador->guardar();
} else {
    $controlador->crear(); // muestra formulario si no viene POST
}


?>
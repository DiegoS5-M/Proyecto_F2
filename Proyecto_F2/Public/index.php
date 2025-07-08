<?php
require_once '../App/Centro/Controlador.php';

// Obtener el controlador y método por URL
$controlador = $_GET['controlador'] ?? 'UsuarioControlador';
$metodo = $_GET['metodo'] ?? 'index';

// Ruta del controlador
$archivoControlador = "../App/Controlador/" . $controlador . ".php";

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;
    $obj = new $controlador();

    if (method_exists($obj, $metodo)) {
        $obj->$metodo();
    } else {
        echo "Método '$metodo' no encontrado.";
    }
} else {
    echo "Controlador '$controlador' no encontrado.";
}

header('Location: login_form.php');
exit;
?>
<?php
// Incluye el archivo base del controlador que puede contener clases comunes o funciones compartidas
require_once '../App/Centro/Controlador.php';

// Obtiene el nombre del controlador desde la URL con ?controlador=NombreControlador
// Si no se proporciona, se usa 'UsuarioControlador' como valor por defecto
$controlador = $_GET['controlador'] ?? 'UsuarioControlador';

// Obtiene el nombre del método desde la URL con ?metodo=nombreMetodo
// Si no se proporciona, se usa 'index' como valor por defecto
$metodo = $_GET['metodo'] ?? 'index';

// Crea la ruta completa del archivo del controlador a partir del nombre recibido
$archivoControlador = "../App/Controlador/" . $controlador . ".php";

// Verifica si el archivo del controlador existe en el sistema
if (file_exists($archivoControlador)) {
    // Si existe, lo incluye en el script
    require_once $archivoControlador;

    // Crea una instancia de la clase del controlador
    $obj = new $controlador();

    // Verifica si el método especificado existe en ese objeto
    if (method_exists($obj, $metodo)) {
        // Si el método existe, lo ejecuta
        $obj->$metodo();
    } else {
        // Si el método no existe, muestra un mensaje de error
        echo "Método '$metodo' no encontrado.";
    }
} else {
    // Si el archivo del controlador no existe, muestra un mensaje de error
    echo "Controlador '$controlador' no encontrado.";
}

// Redirige al formulario de login después de procesar el controlador y método
header('Location: login_form.php');
exit; // Finaliza el script para evitar que se ejecute cualquier otra cosa
?>
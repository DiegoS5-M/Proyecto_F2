<?php
// Carga el controlador base, que tiene métodos reutilizables como 'vista'
require_once __DIR__ . '/../Centro/Controlador.php';

// Carga el modelo Usuario, que se encarga de la lógica con la base de datos
require_once __DIR__ . '/../Modelo/Usuario.php';

// Define la clase UsuarioControlador que hereda de Controlador
class UsuarioControlador extends Controlador {

    // Método por defecto, simplemente muestra un mensaje básico
    public function index(): void {
        echo "Bienvenido al módulo de Usuarios";
    }

    // Método para listar todos los usuarios registrados
    public function listar(): void {
        $usuario = new Usuario(); // Crea una instancia del modelo
        $datos = $usuario->listarUsuarios(); // Obtiene todos los usuarios
        echo json_encode($datos); // Devuelve los datos en formato JSON (útil para APIs o AJAX)
    }

    // Muestra la vista para registrar un nuevo usuario
    public function crear() {
        $this->vista('Usuario/crear'); // Carga la vista Usuario/crear.php
    }

    // Guarda el nuevo usuario en la base de datos
    public function guardar() {
        $usuario = new Usuario(); // Instancia el modelo
        $resultado = $usuario->registrar($_POST); // Intenta registrar los datos del formulario

        // Esta línea es la que devuelve true o false al archivo que llama al controlador
        return $resultado ? true : false;

        
    }
}
?>

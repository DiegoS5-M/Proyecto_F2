<?php
// Importa el modelo Producto, que maneja las operaciones con la base de datos
require_once __DIR__ . '/../Modelo/Producto.php';

// Define la clase controlador para gestionar productos
class ProductoControlador {

    // Método para guardar un producto en la base de datos
    public function guardar() {
        $producto = new Producto(); // Crea una instancia del modelo Producto
        return $producto->registrar($_POST); // Intenta registrar los datos recibidos del formulario
                                              // Retorna true si se guarda correctamente, o false si falla
    }

    // Método para obtener todos los productos registrados
    public function listar() {
        $producto = new Producto(); // Crea la instancia del modelo Producto
        return $producto->obtenerTodos(); // Retorna todos los productos como array
    }

    // Método principal que gestiona la lógica de creación y visualización
    public function crear() {
        $mensaje = '';    // Mensaje para mostrar al usuario (éxito o error)
        $productos = [];  // Arreglo para almacenar productos (si se listan)

        // Si se ha enviado el formulario con el botón "registrar"
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
            $resultado = $this->guardar();               // Intenta guardar el producto
            $mensaje = $resultado ? 'exito' : 'error';   // Asigna el mensaje dependiendo del resultado
        }

        // Si se está solicitando listar productos (por GET)
        if (isset($_GET['listar'])) {
            $productos = $this->listar(); // Llama al método listar() para obtener todos los productos
        }

        // Finalmente se carga la vista que se encarga del diseño
        include '../App/Vista/Producto/crear.php'; // Aquí se mostrará el formulario y mensajes
    }
}

?>
<?php
// Incluye el modelo Pedido que contiene la lógica de base de datos
require_once __DIR__ . '/../Modelo/Pedido.php';

// Define la clase del controlador de pedidos
class PedidoControlador {

    // Método para mostrar el formulario de creación de pedidos
    public function crear() {
        session_start(); // Inicia sesión para acceder a los datos del usuario

        $pedido = new Pedido(); // Crea una instancia del modelo Pedido
        $productos = $pedido->obtenerProductosDisponibles(); // Obtiene productos en stock

        // Carga la vista para crear un pedido, pasándole los productos
        include "../App/Vista/Pedido/crear.php";
    }

    // Método para guardar un nuevo pedido en la base de datos
    public function guardar() {
        session_start(); // Asegura que la sesión esté activa
        $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null; // Obtiene el ID del usuario logueado

        // Si no hay sesión válida, muestra mensaje y detiene la ejecución
        if (!$id_usuario) {
            echo "No estás logueado.";
            return;
        }

        // Recoge los productos enviados desde el formulario (clave = id_producto, valor = cantidad)
        $productos = $_POST['productos'] ?? [];

        $pedido = new Pedido(); // Crea el modelo Pedido
        $resultado = $pedido->crearPedido($id_usuario, $productos); // Guarda el pedido en la base de datos

        // Muestra un mensaje dependiendo si se guardó o no correctamente
        if ($resultado) {
            echo "<h3>✅ Pedido realizado correctamente.</h3>";
        } else {
            echo "<h3>❌ Error al crear pedido.</h3>";
        }
    }

    // Método para que el administrador pueda ver la lista de pedidos
    public function listar() {
        session_start(); // Inicia sesión

        // Verifica si hay un usuario logueado y si es administrador
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['Rol'] !== 'Administrador') {
            echo "⚠️ Acceso denegado."; // Acceso restringido
            return;
        }

        $pedido = new Pedido(); // Instancia del modelo Pedido
        $pedidos = $pedido->listarPedidos(); // Obtiene la lista de pedidos

        // Carga la vista para mostrar la tabla de pedidos
        include "../App/Vista/Pedido/listar.php";
    }
}
?>
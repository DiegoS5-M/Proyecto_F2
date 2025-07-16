<?php
require_once __DIR__ . '/../Modelo/Pedido.php';

class PedidoControlador {
    public function crear() {
        session_start();

        $pedido = new Pedido();
        $productos = $pedido->obtenerProductosDisponibles();

        include "../App/Vista/Pedido/crear.php";
    }

    public function guardar() {
        session_start();
        $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;

        if (!$id_usuario) {
            echo "No estás logueado.";
            return;
        }

        $productos = $_POST['productos'] ?? [];

        $pedido = new Pedido();
        $resultado = $pedido->crearPedido($id_usuario, $productos);

        if ($resultado) {
            echo "<h3>✅ Pedido realizado correctamente.</h3>";
        } else {
            echo "<h3>❌ Error al crear pedido.</h3>";
        }
    }

    public function listar() {
    session_start();

    // Validar que solo el administrador acceda (opcional)
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['Rol'] !== 'Administrador') {
        echo "⚠️ Acceso denegado.";
        return;
    }

    $pedido = new Pedido();
    $pedidos = $pedido->listarPedidos(); // este método lo agregaste en Pedido.php 

    include "../App/Vista/Pedido/listar.php"; // asegúrate de tener este archivo
}
}

?>
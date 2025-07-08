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
}

?>
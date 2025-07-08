<?php
require_once __DIR__ . '/../Centro/DataBase.php';

class Pedido {
    private $db;

    public function __construct() {
        $this->db = (new DataBase())->conn;
    }

    public function crearPedido($id_usuario, $productos) {
        $this->db->beginTransaction();

        try {
            // Insertar en pedidos
            $stmt = $this->db->prepare("INSERT INTO pedidos (id_usuario, fecha, estado) VALUES (?, NOW(), 'pendiente')");
            $stmt->execute([$id_usuario]);

            $id_pedido = $this->db->lastInsertId();

            // Insertar productos en detalle_pedido
            foreach ($productos as $id_producto => $cantidad) {
                $stmt_detalle = $this->db->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES (?, ?, ?)");
                $stmt_detalle->execute([$id_pedido, $id_producto, $cantidad]);
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerProductosDisponibles() {
        $stmt = $this->db->query("SELECT * FROM productos WHERE Cantidad_en_Stock > 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
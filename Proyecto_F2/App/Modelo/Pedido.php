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
            $stmt = $this->db->prepare("INSERT INTO ventas_pedidos (id_usuario, Fecha_Venta, estado) VALUES (?, NOW(), 'pendiente')");
            $stmt->execute([$id_usuario]);

            $id_pedido = $this->db->lastInsertId();
            $total=0;

            // Insertar productos en detalle_pedido
            foreach ($productos as $id_producto => $cantidad) {
                 $stmt_precio = $this->db->prepare("SELECT Precio_venta FROM productos WHERE Id_Producto = ?");
            $stmt_precio->execute([$id_producto]);
            $producto = $stmt_precio->fetch(PDO::FETCH_ASSOC);

            $precio = $producto['Precio_venta'];
            $subtotal = $precio * $cantidad;
            $total += $subtotal;

            // Insertar en detalle
            $stmt_detalle = $this->db->prepare("INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad) VALUES (?, ?, ?)");
            $stmt_detalle->execute([$id_pedido, $id_producto, $cantidad]);

            // Opcional: actualizar stock
            $stmt_stock = $this->db->prepare("UPDATE productos SET Cantidad_en_Stock = Cantidad_en_Stock - ? WHERE Id_Producto = ?");
            $stmt_stock->execute([$cantidad, $id_producto]);
        }

        // Actualizar total del pedido
        $stmt_total = $this->db->prepare("UPDATE ventas_pedidos SET total = ? WHERE Id = ?");
        $stmt_total->execute([$total, $id_pedido]);

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

   public function listarPedidos() {
    $stmt = $this->db->query("
        SELECT 
            p.Id AS id,
            u.Nombres_usuario AS nombre,
            p.id_usuario,
            p.Fecha_Venta AS fecha,
            p.estado,
            p.total
        FROM ventas_pedidos p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        ORDER BY p.Id DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

?>
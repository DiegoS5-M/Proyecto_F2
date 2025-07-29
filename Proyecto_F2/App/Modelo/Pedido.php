<?php
// Incluye la clase que maneja la conexión a la base de datos
require_once __DIR__ . '/../Centro/DataBase.php';

class Pedido {
    // Propiedad para almacenar la conexión PDO
    private $db;

    // Constructor: al crear el objeto, se conecta automáticamente a la base de datos
    public function __construct() {
        $this->db = (new DataBase())->conn;
    }

    /**
     * Crea un nuevo pedido con los productos seleccionados por el usuario.
     * @param int $id_usuario - ID del usuario que realiza el pedido.
     * @param array $productos - Lista de productos con sus cantidades.
     * @return bool - True si todo salió bien, False si hubo error.
     */
    public function crearPedido($id_usuario, $productos) {
        // Inicia una transacción (para asegurar que todas las operaciones se completen)
        $this->db->beginTransaction();

        try {
            // Inserta el pedido principal en la tabla ventas_pedidos
            $stmt = $this->db->prepare("INSERT INTO ventas_pedidos (id_usuario, Fecha_Venta, estado) VALUES (?, NOW(), 'pendiente')");
            $stmt->execute([$id_usuario]);

            // Recupera el ID del nuevo pedido insertado
            $id_pedido = $this->db->lastInsertId();
            $total = 0;

            // Recorre cada producto seleccionado por el usuario
            foreach ($productos as $id_producto => $cantidad) {
                // Consulta el precio del producto
                $stmt_precio = $this->db->prepare("SELECT Precio_venta FROM productos WHERE Id_Producto = ?");
                $stmt_precio->execute([$id_producto]);
                $producto = $stmt_precio->fetch(PDO::FETCH_ASSOC);

                // Calcula el subtotal por producto (precio * cantidad)
                $precio = $producto['Precio_venta'];
                $subtotal = $precio * $cantidad;
                $total += $subtotal;

                // Inserta el detalle del producto en la tabla detalles_pedido
                $stmt_detalle = $this->db->prepare("INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad) VALUES (?, ?, ?)");
                $stmt_detalle->execute([$id_pedido, $id_producto, $cantidad]);

                // (Opcional) Actualiza el stock del producto restando la cantidad comprada
                $stmt_stock = $this->db->prepare("UPDATE productos SET Cantidad_en_Stock = Cantidad_en_Stock - ? WHERE Id_Producto = ?");
                $stmt_stock->execute([$cantidad, $id_producto]);
            }

            // Después de insertar todos los productos, actualiza el total del pedido
            $stmt_total = $this->db->prepare("UPDATE ventas_pedidos SET total = ? WHERE Id = ?");
            $stmt_total->execute([$total, $id_pedido]);

            // Confirma todos los cambios en la base de datos
            $this->db->commit();
            return true;

        } catch (Exception $e) {
            // Si hubo algún error, se cancelan todos los cambios
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Devuelve todos los productos disponibles con stock mayor a 0.
     * Se usa para mostrar el catálogo en el formulario de pedido.
     */
    public function obtenerProductosDisponibles() {
        $stmt = $this->db->query("SELECT * FROM productos WHERE Cantidad_en_Stock > 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Devuelve una lista de todos los pedidos registrados, con datos del usuario.
     * Se usa para mostrar los pedidos en el panel del administrador.
     */
    public function listarPedidos() {
        $stmt = $this->db->query("
            SELECT 
                p.Id AS id,                        -- ID del pedido
                u.Nombres_usuario AS nombre,       -- Nombre del usuario que hizo el pedido
                p.id_usuario,                      -- ID del usuario
                p.Fecha_Venta AS fecha,            -- Fecha del pedido
                p.estado,                          -- Estado del pedido (pendiente, entregado, etc.)
                p.total                            -- Total en dinero del pedido
            FROM ventas_pedidos p
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            ORDER BY p.Id DESC                    -- Ordena del más reciente al más antiguo
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
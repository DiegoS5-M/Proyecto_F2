<?php
// Incluye la clase encargada de establecer la conexión a la base de datos
require_once __DIR__ . '/../Centro/DataBase.php';

class Reporte {
    // Propiedad que almacenará la conexión a la base de datos
    private $db;

    // Constructor: se ejecuta automáticamente al crear una instancia de esta clase
    public function __construct() {
        // Se obtiene la conexión PDO desde la clase DataBase
        $this->db = (new DataBase())->conn;
    }

    /**
     * Obtiene todas las ventas realizadas en una fecha específica.
     * @param string $fecha - La fecha seleccionada por el usuario (formato: 'YYYY-MM-DD')
     * @return array - Devuelve un array con dos elementos:
     *                 [0] => lista de ventas realizadas ese día
     *                 [1] => suma total de todas esas ventas
     */
    public function obtenerVentasPorFecha($fecha) {
        // Prepara una consulta SQL para seleccionar ventas de la fecha indicada
        $stmt = $this->db->prepare("
            SELECT 
                p.Id AS id,                      -- ID del pedido
                u.Nombres_usuario AS nombre,     -- Nombre del usuario que hizo el pedido
                p.Fecha_Venta AS fecha,          -- Fecha en la que se hizo el pedido
                p.total                          -- Total de la venta
            FROM ventas_pedidos p
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            WHERE DATE(p.Fecha_Venta) = ?       -- Solo ventas de la fecha consultada
        ");

        // Ejecuta la consulta con la fecha recibida
        $stmt->execute([$fecha]);

        // Obtiene todas las ventas encontradas (como arreglo asociativo)
        $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calcula la suma total de las ventas del día
        // Extrae todos los valores de la columna 'total' y los suma
        $total = array_sum(array_column($ventas, 'total'));

        // Devuelve un arreglo con:
        // - la lista completa de ventas
        // - el total sumado
        return [$ventas, $total];
    }
}
?>
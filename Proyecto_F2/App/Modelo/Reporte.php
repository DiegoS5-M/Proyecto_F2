<?php
require_once __DIR__ . '/../Centro/DataBase.php';

class Reporte {
    private $db;

    public function __construct() {
        $this->db = (new DataBase())->conn;
    }

    public function obtenerVentasPorFecha($fecha) {
    $stmt = $this->db->prepare("
        SELECT 
            p.Id AS id,
            u.Nombres_usuario AS nombre,
            p.Fecha_Venta AS fecha,
            p.total
        FROM ventas_pedidos p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        WHERE DATE(p.Fecha_Venta) = ?
    ");
    $stmt->execute([$fecha]);
    $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcular total
    $total = array_sum(array_column($ventas, 'total'));

    return [$ventas, $total];
}
}
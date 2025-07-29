<?php
// Importa el modelo Reporte, donde se encuentra la lógica para obtener los datos desde la base de datos
require_once __DIR__ . '/../Modelo/Reporte.php';

// Define la clase ReporteControlador que se encargará de controlar la lógica de los reportes
class ReporteControlador {

    // Función pública que consulta las ventas de una fecha específica
    public function consultarPorFecha($fecha) {
        $modelo = new Reporte(); // Crea una instancia del modelo Reporte

        // Llama al método del modelo para obtener las ventas de esa fecha
        return $modelo->obtenerVentasPorFecha($fecha); 
        // Este método devuelve un array con información de ventas y total del día
    }
}
?>
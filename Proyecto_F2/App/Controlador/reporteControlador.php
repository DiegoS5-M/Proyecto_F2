<?php
require_once __DIR__ . '/../Modelo/Reporte.php';

class ReporteControlador {
    public function consultarPorFecha($fecha) {
        $modelo = new Reporte();
        return $modelo->obtenerVentasPorFecha($fecha);
    }
}
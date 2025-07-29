<?php
// Definición de la clase base Controlador, común en el patrón MVC
class Controlador {

    // Método para cargar un modelo
    public function modelo($modelo) {
        // Incluye el archivo del modelo desde la carpeta /Modelo/
        require_once __DIR__ . '/../Modelo/' . $modelo . '.php';

        // Crea y retorna una nueva instancia del modelo
        return new $modelo();
    }

    // Método para cargar una vista
    public function vista($vista, $datos = []) {
        // Incluye el archivo de la vista desde la carpeta /Vista/
        // La variable $datos (opcional) se puede usar dentro de la vista para pasar información
        require_once __DIR__ . '/../Vista/' . $vista . '.php';
    }
}
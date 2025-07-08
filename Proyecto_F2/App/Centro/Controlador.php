<?php
class Controlador {
    public function modelo($modelo) {
        require_once __DIR__ . '/../Modelo/' . $modelo . '.php';
        return new $modelo();
    }

    public function vista($vista, $datos = []) {
        require_once __DIR__ . '/../Vista/' . $vista . '.php';
    }
}
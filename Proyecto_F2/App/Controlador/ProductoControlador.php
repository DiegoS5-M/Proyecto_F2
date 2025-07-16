<?php
require_once __DIR__ . '/../Modelo/Producto.php';

class ProductoControlador {

    public function guardar() {
        $producto = new Producto();
        return $producto->registrar($_POST);  // Devuelve true o false
    }

    public function listar() {
        $producto = new Producto();
        return $producto->obtenerTodos();  // Devuelve array de productos
    }

    public function crear() {
        $mensaje = '';
        $productos = [];

        // Si el formulario fue enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
            $resultado = $this->guardar();
            $mensaje = $resultado ? 'exito' : 'error';
        }

        // Si se solicitó ver la lista
        if (isset($_GET['listar'])) {
            $productos = $this->listar();
        }

        // Cargar la vista
        include '../App/Vista/Producto/crear.php';
    }
}
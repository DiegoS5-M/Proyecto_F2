<?php
require_once __DIR__ . '/../Modelo/Producto.php';

class ProductoControlador {
    public function crear() {
        include '../App/Vista/Producto/crear.php';
    }

    public function guardar() {
    $producto = new Producto();
    $resultado = $producto->registrar($_POST);

    if ($resultado) {
        echo "<p style='color: green; font-weight: bold;'>✅ Producto registrado correctamente.</p>";
        echo "<a href='/Proyecto_F2/Public/producto.php'>🔁 Volver al formulario</a><br>";
        echo "<a href='/Proyecto_F2/Public/admin.php'>🏠 Volver al panel del administrador</a>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>❌ Error al registrar el producto.</p>";
        echo "<a href='/Proyecto_F2/Public/producto.php'>🔁 Intentar de nuevo</a><br>";
        echo "<a href='/Proyecto_F2/Public/admin.php'>🏠 Volver al panel del administrador</a>";
    }
    }
    public function listar() {
        $producto = new Producto();
        $productos = $producto->obtenerTodos();

        include '../App/Vista/Producto/listar.php';
    }
}




?>
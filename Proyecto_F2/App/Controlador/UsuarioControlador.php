<?php
require_once __DIR__ . '/../Centro/Controlador.php';
require_once __DIR__ . '/../Modelo/Usuario.php';

class UsuarioControlador extends Controlador {
    public function index(): void {
        echo "Bienvenido al módulo de Usuarios";
    }

    public function listar(): void {
        $usuario = new Usuario();
        $datos = $usuario->listarUsuarios();
        echo json_encode($datos);
    }
public function crear() {
    $this->vista('Usuario/crear');
}

public function guardar() {
    $usuario = new Usuario();
    $resultado = $usuario->registrar($_POST);

    return $resultado ? true : false;


    if ($resultado) {
        echo "<h3 style='color:green'>✅ Usuario registrado correctamente</h3>";
        echo "<a href='/Proyecto_F2/Public/usuario.php'>Volver al formulario</a><br>";
        echo "<a href='/Proyecto_F2/Public/admin.php'>Volver al panel del Administrador</a>";
    } else {
        echo "<h3 style='color:red'>❌ Error al registrar usuario</h3>";
        echo "<a href='/Proyecto_F2/Public/usuario.php'>Volver al formulario</a><br>";
        echo "<a href='/Proyecto_F2/Public/admin.php'>Volver al panel del Administrador</a>";
    }
}
    }





?>

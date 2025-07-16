<?php
require_once __DIR__ . '/../Centro/Controlador.php';
require_once __DIR__ . '/../Modelo/Login.php';

class LoginControlador extends Controlador {
    public function autenticar() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
        
        $correo = $_POST['correo'] ?? '';
        $celular = $_POST['celular'] ?? '';

        $login = new Login();
        $usuario = $login->validarUsuario($correo, $celular);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            

            // Redirigir según rol
            switch ($usuario['Rol']) {
                case 'Estudiante':
                case 'Profesor':
                    header('Location: /Proyecto_F2/Public/usuario.php');
                    break;
                case 'Empleado':
                    header('Location: ../App/Vista/Pedidos/index.php');
                    break;
                case 'Administrador':
                    header('Location: /Proyecto_F2/Public/admin.php');
                    break;
            }
        } else {
            echo "Usuario no válido.";
        }

       
    }
}


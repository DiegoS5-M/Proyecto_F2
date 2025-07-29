<?php
// Requiere la clase base Controlador (ubicada en /Centro)
require_once __DIR__ . '/../Centro/Controlador.php';

// Requiere el modelo Login, que contiene la lógica para validar usuarios
require_once __DIR__ . '/../Modelo/Login.php';

// Clase LoginControlador que extiende de la clase Controlador base
class LoginControlador extends Controlador {

    // Método principal para autenticar al usuario
    public function autenticar() {
        // Inicia la sesión solo si aún no ha sido iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtiene el correo y celular desde el formulario enviado por POST
        // Si no existen, los inicializa como cadenas vacías
        $correo = $_POST['correo'] ?? '';
        $celular = $_POST['celular'] ?? '';

        // Crea una instancia del modelo Login
        $login = new Login();

        // Valida el usuario con los datos proporcionados
        $usuario = $login->validarUsuario($correo, $celular);

        // Si se encontró un usuario válido
        if ($usuario) {
            // Guarda los datos del usuario en la sesión
            $_SESSION['usuario'] = $usuario;

            // Redirige al usuario según su rol
            switch ($usuario['Rol']) {
                case 'Estudiante':
                case 'Profesor':
                    // Estudiantes y profesores van a la vista usuario
                    header('Location: /Proyecto_F2/Public/usuario.php');
                    break;
                case 'Empleado':
                    // Empleados van a la vista interna de pedidos
                    header('Location: ../App/Vista/Pedidos/index.php');
                    break;
                case 'Administrador':
                    // Administradores van al panel principal
                    header('Location: /Proyecto_F2/Public/admin.php');
                    break;
            }
        } else {
            // Si no se encuentra el usuario, muestra mensaje de error
            echo "Usuario no válido.";
        }
    }
}
?>

<?php
// Incluye la clase que conecta a la base de datos
require_once __DIR__ . '/../Centro/DataBase.php';

class Usuario {
    // Propiedad que almacena la conexión a la base de datos
    private $db;

    // Constructor: se ejecuta al crear una instancia de esta clase
    public function __construct() {
        // Se crea una nueva conexión a la base de datos usando la clase DataBase
        $this->db = (new DataBase())->conn;
    }

    /**
     * Método para obtener todos los usuarios registrados
     * @return array - Lista de usuarios en forma de arreglo asociativo
     */
    public function listarUsuarios() {
        $sql = "SELECT * FROM usuarios"; // Consulta SQL para traer todos los usuarios
        $stmt = $this->db->query($sql);  // Ejecuta la consulta directamente
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los resultados como array asociativo
    }

    /**
     * Método para registrar un nuevo usuario
     * @param array $datos - Datos recibidos del formulario ($_POST)
     * @return bool - true si se insertó correctamente, false si falló
     */
    public function registrar($datos) {
        // Consulta SQL con marcadores (placeholders) para evitar inyección SQL
        $sql = "INSERT INTO usuarios (Id_usuario, tipo_documento, Nombres_usuario, Apellidos_usuario, Rol, edad, Celular, Correo_Electronico)
                VALUES (:id, :doc, :nombres, :apellidos, :rol, :edad, :celular, :correo)";
        
        // Prepara la consulta
        $stmt = $this->db->prepare($sql);
        
        // Ejecuta la consulta con los valores recibidos del formulario
        return $stmt->execute([
            ':id' => $datos['documento'],
            ':doc' => $datos['tipo_documento'],
            ':nombres' => $datos['nombres'],
            ':apellidos' => $datos['apellidos'],
            ':rol' => $datos['rol'],
            ':edad' => $datos['edad'],
            ':celular' => $datos['celular'],
            ':correo' => $datos['correo']
        ]);

        // ⚠️ IMPORTANTE: Este bloque nunca se ejecutará porque está después de return
        // Si quieres mostrar mensajes, debes mover esto antes del return
        if ($resultado) {
            echo "✅ Usuario creado correctamente.";
            return true;
        } else {
            echo "❌ Error al registrar usuario:<br>";
            print_r($stmt->errorInfo());  // Muestra errores detallados de SQL
            return false;
        }
    }
}
?>
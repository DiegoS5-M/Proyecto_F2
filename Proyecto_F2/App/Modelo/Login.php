<?php
// Incluye el archivo que contiene la clase de conexión a la base de datos
require_once __DIR__ . '/../Centro/DataBase.php';

class Login {
    // Propiedad para almacenar la conexión a la base de datos
    private $db;

    // Constructor: se ejecuta al crear un objeto de la clase Login
    public function __construct() {
        // Se obtiene la conexión desde la clase DataBase
        $this->db = (new DataBase())->conn;
    }

    /**
     * Función para validar si un usuario existe con el correo y celular ingresado.
     * Retorna un array asociativo con los datos del usuario si existe,
     * o null si no hay coincidencia.
     */
    public function validarUsuario($correo, $celular): ?array {
        // Prepara una consulta segura 
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE Correo_Electronico = ? AND Celular = ?");

        // Ejecuta la consulta con los valores proporcionados
        $stmt->execute([$correo, $celular]);

        // Obtiene el resultado como un array asociativo
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si no encontró nada, retorna null; si encontró un usuario, retorna el array con sus datos
        return $resultado === false ? null : $resultado;
    }
}
?>
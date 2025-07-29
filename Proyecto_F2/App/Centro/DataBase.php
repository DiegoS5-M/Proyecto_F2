<?php
// Importa el archivo de configuración (donde están DB_HOST, DB_NAME, etc.)
require_once __DIR__ . '/../../config.php';

// Clase encargada de gestionar la conexión a la base de datos
class DataBase {
    // Atributo público que almacenará la conexión PDO
    public $conn;

    // Constructor de la clase, se ejecuta automáticamente al crear un objeto DataBase
    public function __construct() {
        try {
            // Intenta crear una nueva conexión PDO usando las constantes definidas en config.php
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, // Dirección del servidor y nombre de la base
                DB_USER, // Usuario de la base de datos
                DB_PASS  // Contraseña del usuario
            );

            // Configura PDO para que lance excepciones si ocurre un error (útil para detectar fallos)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            // Si ocurre un error en la conexión, muestra el mensaje y detiene el script
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
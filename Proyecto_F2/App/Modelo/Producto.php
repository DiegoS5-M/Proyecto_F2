<?php
// Incluye la clase que gestiona la conexión a la base de datos
require_once __DIR__ . '/../Centro/DataBase.php';

class Producto {
    // Propiedad para la conexión a la base de datos
    private $db;

    // Constructor: se ejecuta automáticamente al instanciar la clase
    // Establece la conexión con la base de datos
    public function __construct() {
        $this->db = (new DataBase())->conn;
    }

    /**
     * Registra un nuevo producto en la base de datos.
     * @param array $datos - Datos del producto (vienen del formulario POST).
     * @return bool - true si se guardó correctamente, false si hubo error.
     */
    public function registrar($datos) {
        // Obtiene el contenido binario de la imagen cargada desde el formulario
        $foto = file_get_contents($_FILES['foto']['tmp_name']);

        // Consulta SQL para insertar un nuevo producto en la tabla "productos"
        $sql = "INSERT INTO productos (
                    Id_Producto, 
                    Nombre_Producto, 
                    Precio_venta, 
                    Precio_costo, 
                    Cantidad_en_Stock, 
                    Tipo_Producto, 
                    Foto
                ) VALUES (
                    :id, :nombre, :venta, :costo, :cantidad, :tipo, :foto
                )";

        // Prepara la consulta para prevenir inyección SQL
        $stmt = $this->db->prepare($sql);

        // Ejecuta la consulta con los datos del formulario
        return $stmt->execute([
            'id'       => $datos['id'],                 // ID del producto (clave primaria)
            ':nombre' => $datos['nombre'],             // Nombre del producto
            ':venta'  => $datos['precio_venta'],       // Precio de venta al público
            ':costo'  => $datos['precio_costo'],       // Precio de costo (interno)
            ':cantidad'=> $datos['cantidad'],          // Cantidad en stock disponible
            ':tipo'   => $datos['tipo_producto'],      // Tipo de producto (ej: comida, bebida, etc.)
            ':foto'   => $foto                         // Imagen binaria del producto
        ]); 
    }

    /**
     * Obtiene todos los productos disponibles en stock.
     * Devuelve solo productos cuya cantidad en stock sea mayor a 0.
     * @return array - Lista de productos disponibles.
     */
    public function obtenerTodos() {
        // Ejecuta una consulta SQL para traer todos los productos con stock disponible
        $stmt = $this->db->query("SELECT * FROM productos WHERE Cantidad_en_Stock > 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>


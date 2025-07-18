<?php
require_once __DIR__ . '/../Centro/DataBase.php';

class Producto {
    private $db;

    public function __construct() {
        $this->db = (new DataBase())->conn;
    }

    public function registrar($datos) {
         $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $sql = "INSERT INTO productos (Id_Producto, Nombre_Producto, Precio_venta, Precio_costo, Cantidad_en_Stock, Tipo_Producto, Foto)
                VALUES (:id, :nombre, :venta, :costo, :cantidad, :tipo, :foto)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'=> $datos['id'],
            ':nombre' => $datos['nombre'],
            ':venta' => $datos['precio_venta'],
            ':costo'=>$datos['precio_costo'],
            ':cantidad' => $datos['cantidad'],
            ':tipo' => $datos['tipo_producto'],
            ':foto' => $foto
        ]); 
    }

    public function obtenerTodos() {
    $stmt = $this->db->query("SELECT * FROM productos WHERE Cantidad_en_Stock > 0");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

            
    }
}

?>


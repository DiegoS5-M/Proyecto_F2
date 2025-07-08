<?php
require_once __DIR__ . '/../Centro/DataBase.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = (new DataBase())->conn;
    }

    public function listarUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


public function registrar($datos) {
    $sql = "INSERT INTO usuarios (Id_usuario, tipo_documento, Nombres_usuario, Apellidos_usuario, Rol, edad, Celular, Correo_Electronico)
            VALUES (:id, :doc, :nombres, :apellidos, :rol, :edad, :celular, :correo)";
    $stmt = $this->db->prepare($sql);
    
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


    if ($resultado) {
        echo "✅ Usuario creado correctamente.";
        return true;
    } else {
        echo "❌ Error al registrar usuario:<br>";
        print_r($stmt->errorInfo());  // ⛔ Esto mostrará el error real de MySQL
        return false;
}
}
}

?>
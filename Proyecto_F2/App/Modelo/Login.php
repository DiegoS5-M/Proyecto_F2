<?php
require_once __DIR__ . '/../Centro/DataBase.php';

class Login {
    private $db;

    public function __construct() {
        $this->db = (new DataBase())->conn;
    }

    public function validarUsuario($correo, $celular): ?array {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE Correo_Electronico = ? AND Celular = ?");
        $stmt->execute([$correo, $celular]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado === false ? null : $resultado;
    }
}
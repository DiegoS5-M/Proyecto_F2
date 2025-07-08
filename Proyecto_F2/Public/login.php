<?php
require_once '../App/Controlador/LoginControlador.php';

$login = new LoginControlador();
$login->autenticar();

?>
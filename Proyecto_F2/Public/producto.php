<?php
require_once '../App/Controlador/ProductoControlador.php';

$controlador = new ProductoControlador();
$controlador->crear(); // Este método carga la vista Producto/crear.php
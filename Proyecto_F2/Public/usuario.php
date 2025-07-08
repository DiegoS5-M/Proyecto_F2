<?php
session_start();

if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['Rol'] !== 'Estudiante' && $_SESSION['usuario']['Rol'] !== 'Profesor')) {
    echo "⚠️ Acceso denegado.";
    exit;
}

$nombre = $_SESSION['usuario']['Nombres_usuario'] ?? 'Usuario';
$rol = $_SESSION['usuario']['Rol'] ?? '';
?>

<h2>👋 Bienvenido, <?= htmlspecialchars($nombre) ?> (<?= htmlspecialchars($rol) ?>)</h2>

<ul>
    <li><a href="catalogo.php">🛒 Ver catálogo de productos</a></li>
    <li><a href="carrito.php">🧾 Ver carrito</a></li>
    <li><a href="logout.php">🚪 Cerrar sesión</a></li>
</ul>
<?php


session_start();



// Verifica si hay sesión activa y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['Rol'] !== 'Administrador') {
    echo "⚠️ Acceso denegado.";
    exit;
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
</head>
<body>
    <h1>Bienvenido, <?= $_SESSION['usuario']['Nombres_usuario'] ?> (Administrador)</h1>

    <ul>
        <li><a href="registro_Usuario.php">➕ Registrar usuario</a></li>
        <li><a href="producto.php">📦 Registrar producto</a></li>
        <li><a href="pedidos_admin.php">📋 Ver pedidos</a></li>
        <li><a href="inventario.php">📈 Movimiento de inventario</a></li>
        <li><a href="reporte.php">📑 Ver reportes</a></li>
        <li><a href="logout.php">🔒 Cerrar sesión</a></li>
    </ul>
</body>
</html>


<?php
require_once '../App/Controlador/UsuarioControlador.php';
$controlador = new UsuarioControlador();

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $resultado = $controlador->guardar();
    $mensaje = $resultado ? 'exito' : 'error';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">👤 Registrar nuevo usuario</h2>

  <!-- Mensajes -->
  <?php if ($mensaje === 'exito'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      ✅ <strong>Usuario registrado correctamente.</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    <div class="d-flex justify-content-center gap-3 mb-4">
      <a href="/Proyecto_F2/Public/admin.php" class="btn btn-primary">← Volver al panel del administrador</a>
      <a href="/Proyecto_F2/Public/registro_usuario.php" class="btn btn-success">➕ Registrar otro usuario</a>
    </div>
  <?php elseif ($mensaje === 'error'): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      ❌ <strong>Error al registrar el usuario.</strong> Intenta nuevamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  <?php endif; ?>

  <!-- Formulario -->
  <form action="" method="POST" class="bg-white p-4 shadow rounded">
    <div class="row mb-3">
      <div class="col">
        <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
      </div>
      <div class="col">
        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col">
        <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
      </div>
      <div class="col">
        <input type="text" name="celular" class="form-control" placeholder="Celular" required>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col">
        <input type="number" name="edad" class="form-control" placeholder="Edad" required>
      </div>
      <div class="col">
        <select name="tipo_documento" class="form-select" required>
          <option value="">Tipo de documento</option>
          <option value="1">Cédula</option>
          <option value="2">Tarjeta de identidad</option>
        </select>
      </div>
      <div class="col">
        <input type="number" name="documento" class="form-control" placeholder="Número de documento" required>
      </div>
    </div>

    <div class="mb-3">
      <select name="rol" class="form-select" required>
        <option value="">Seleccione rol</option>
        <option value="Estudiante">Estudiante</option>
        <option value="Profesor">Profesor</option>
        <option value="Empleado">Empleado</option>
        <option value="Administrador">Administrador</option>
      </select>
    </div>

    <button type="submit" name="crear" class="btn btn-primary w-100">✅ Registrar</button>
  </form>
</div>
<div class="text-center mt-4">
<a href="admin.php" class="btn btn-secondary">← Volver al panel del administrador</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
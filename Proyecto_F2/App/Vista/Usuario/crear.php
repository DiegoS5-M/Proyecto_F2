<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Usuario</title>

  <!-- Carga Bootstrap para estilos modernos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> <!-- Fondo gris claro -->

<!-- Contenedor principal -->
<div class="container mt-5">
  <h2 class="text-center mb-4">👤 Registrar nuevo usuario</h2>

  <!-- 🔔 Mostrar mensaje si se registró correctamente -->
  <?php if ($mensaje === 'exito'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      ✅ <strong>Usuario registrado correctamente.</strong>
      <!-- Botón para cerrar la alerta -->
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>

    <!-- Botones después del éxito -->
    <div class="d-flex justify-content-center gap-3 mb-4">
      <a href="/Proyecto_F2/Public/admin.php" class="btn btn-primary">← Volver al panel del administrador</a>
      <a href="/Proyecto_F2/Public/registro_usuario.php" class="btn btn-success">➕ Registrar otro usuario</a>
    </div>

  <!-- 🔴 Mostrar mensaje si hubo error -->
  <?php elseif ($mensaje === 'error'): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      ❌ <strong>Error al registrar el usuario.</strong> Intenta nuevamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  <?php endif; ?>

  <!-- 📋 Formulario de registro de usuario -->
  <form action="" method="POST" class="bg-white p-4 shadow rounded">
    
    <!-- 🧍‍♂️ Nombre y apellido -->
    <div class="row mb-3">
      <div class="col">
        <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
      </div>
      <div class="col">
        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
      </div>
    </div>

    <!-- 📧 Correo y celular -->
    <div class="row mb-3">
      <div class="col">
        <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
      </div>
      <div class="col">
        <input type="text" name="celular" class="form-control" placeholder="Celular" required>
      </div>
    </div>

    <!-- 🧓 Edad, tipo y número de documento -->
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

    <!-- 🧑‍🏫 Rol del usuario -->
    <div class="mb-3">
      <select name="rol" class="form-select" required>
        <option value="">Seleccione rol</option>
        <option value="Estudiante">Estudiante</option>
        <option value="Profesor">Profesor</option>
        <option value="Empleado">Empleado</option>
        <option value="Administrador">Administrador</option>
      </select>
    </div>

    <!-- ✅ Botón de envío -->
    <button type="submit" name="crear" class="btn btn-primary w-100">✅ Registrar</button>
  </form>
</div>

<!-- Scripts de Bootstrap para alertas y botones -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>